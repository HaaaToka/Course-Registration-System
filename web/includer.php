<?php


session_start();
#print_r($_SESSION);
if(!(isset($_SESSION['login']))){
    header("Location: login.php");
    exit;
}

include_once "base.html";
include_once "header.php";

include_once "functions.php";
include_once "database.php";
//include_once "config.php";

?>