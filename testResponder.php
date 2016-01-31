<?php
if(isset($_GET['render'])) {
    $href =$_COOKIE['test'];
    $test_arr = file($href);
    $seting_time = trim($test_arr[2]);
    $test_time = $_GET['timer'];
    $renders = $_GET['render'];
    $render = split('\\', $renders);
    $so = trim($test_arr[4]);
    $o = 0;
    $k = 1;
    $all = 0;
    echo split('/', $test_arr[$i])[5];
    for($i=5; $i<count($test_arr); $i++){
        $test = split('/', $test_arr[$i]);
        $last = count($test)-1;
        $true = trim($test[$last]);
        echo strcmp($true, $render[$i]);
        echo $true;
        echo '<br>';
        if(strcmp($true, $render[$i])==0) {
            $o++;
        }
        $all++;
    }

    if($test_time > 0){
        $k =1;
    } else {
        if(abs($test_time)>$seting_time){
            $k=2;
        } else {
            $k = (($seting_time + abs($test_time))/$seting_time) - 1;
        }
    }

    $res = ($so * (((100/$k)*$o)/$all))/100/$k;

    echo $res;
    echo $k;
    echo $all;
    echo $o;
    echo $renders;
}