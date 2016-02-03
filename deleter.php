<?php
require_once 'db_connect.php';
use DataBase\Connect as db;
$connect = new db('Test');
if($_GET['pass']='123465')
	echo $connect->deleteRow('resultats', "id=$_GET[rid]");
?>