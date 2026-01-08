<?php
session_start();
require '../Connexion/laConnexion.php';
require '../Connexion/noSQLConnexion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['idU']) || !isset($_GET['conv'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit();
}

$userId = $_SESSION['idU'];
$convId = $_GET['conv'];

try {
    $convObjectId = new MongoDB\BSON\ObjectId($convId);
    
    // check si l'utilisateur fait partie de la conv
    $conversation = $mongoDB->conversations->findOne([
        '_id' => $convObjectId,
        'participants' => (int)$userId
    ]);
    
    if (!$conversation) {
        echo json_encode(['error' => 'Unauthorized']);
        exit();
    }
    
    // recup des messages du plus récent au plus vieux
    $messages = $mongoDB->messages->find(
        ['conversation_id' => $convObjectId],
        ['sort' => ['created_at' => -1]]
    );
    
    $messagesArray = [];
    foreach ($messages as $msg) {
        $messagesArray[] = [
            'sender' => (int)$msg['sender'],
            'message' => $msg['message'],
            'created_at' => $msg['created_at']->toDateTime()->format('Y-m-d H:i:s')
        ];
    }
    
    echo json_encode([
        'success' => true,
        'messages' => $messagesArray,
        'currentUser' => $userId
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch messages: ' . $e->getMessage()
    ]);
}
?>