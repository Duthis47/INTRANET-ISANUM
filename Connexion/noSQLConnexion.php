<?php
require __DIR__ . '/../vendor/autoload.php';
$mongo = new MongoDB\Client("mongodb://localhost:27017");
$mongoDB = $mongo->ISANET;
?>