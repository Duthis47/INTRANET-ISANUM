<?php

session_start();


$_SESSION = [];

session_destroy();

header("Location: http://10.3.17.220/SAE/Authentification/login.php"); 
exit();
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
