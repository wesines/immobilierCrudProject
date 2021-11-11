<?php

$pdo=new PDO("mysql:host=localhost;dbname=immobilier","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
//var_dump($pdo)
$content="";
define("URL","http://".$_SERVER["HTTP_HOST"]."/project/");
define("RACINE_SITE",$_SERVER["DOCUMENT_ROOT"]."/project/");

?>