<?php
session_start();
require '../Connexion/laConnexion.php';
require '../Connexion/noSQLConnexion.php';


$data = json_decode(file_get_contents("php://input"), true);

$mongoDB->messages->insertOne([
    'conversation_id' => new MongoDB\BSON\ObjectId($data['conversation_id']),
    'sender' => (int)$_SESSION['idU'],
    'message' => trim($data['message']),
    'created_at' => new MongoDB\BSON\UTCDateTime()
]);

$mongoDB->conversations->updateOne(
    ['_id' => new MongoDB\BSON\ObjectId($data['conversation_id'])],
    [
        '$set' => [
            'last_message' => $data['message'],
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ]
    ]
);