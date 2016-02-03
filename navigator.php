<?php
if(isset($_COOKIE['teacher']))
	include_once 'resultat.php';
else
	if(isset($_COOKIE['userName'])) 
	    include_once 'selected.php';
	else 
	    include_once 'reg.php';
?>