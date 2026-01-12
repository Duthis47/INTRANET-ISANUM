<?php
session_start();
require '../Connexion/laConnexion.php';
require '../Connexion/noSQLConnexion.php';

$me = (int)$_SESSION['idU'];
$other = (int)$_POST['receiver'];

$conv = $mongoDB->conversations->findOne([
    'participants' => ['$all' => [$me, $other]]
]);

if (!$conv) {
    $res = $mongoDB->conversations->insertOne([
        'participants' => [$me, $other],
        'last_message' => '',
        'updated_at' => new MongoDB\BSON\UTCDateTime()
    ]);
    $convId = $res->getInsertedId();
} else {
    $convId = $conv['_id'];
}


header("Location: Message.php?conv=".(string)$convId);
exit;