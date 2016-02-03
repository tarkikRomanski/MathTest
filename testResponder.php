<?php
require_once 'db_connect.php';
use DataBase\Connect as db;

$db_connect = new db('Test');

if(isset($_GET['render'])) {
    $href =$_COOKIE['test'];
    $test_arr = file($href);

    $c = trim($test_arr[2])+0;
    $b = $_GET['timer']+0;

    $renders = $_GET['render'];
    $render = split(' ', $renders);
    unset($render[count($render)-1]);
    $s = trim($test_arr[4]);
    $x = count($render);
    $a = 0;
    $z = 0;
    $k = 1;
    // перевіряємо вірність тестів
    for ($i=5, $j=0; $i<count($test_arr); $i++, $j++){ 
        $test = split('//',$test_arr[$i]);
        $lastid = count($test)-1;
        $last = $test[$lastid];
       
        if(trim($last) == trim($render[$j])) 
            $a++;
    }
 
 if($b > $c) 
        $k = abs($c / $b - 1);


$zp = ((100*$k)*$a)/$x;
$z = ($s * $zp) / 100*$k;
$z = round($z);
echo $z;
/*Записуємо результат в db*/
$value_arr = array($_COOKIE[userName], $_COOKIE[userGroup], $_COOKIE[test], $b, $z, $test_arr[3], date('j.n.Y G:i:s'));
$column_arr = array('userName', 'userGroup', 'test', 'time', 'mark', 'teacher', 'date');
$db_connect->insertDataTable('resultats', $value_arr, $column_arr);
}