<?php
$test_arr = file('tests/'.$_POST['test_name']);
$name = trim($test_arr[1]);
$time = trim($test_arr[2]);
$teacher = trim($test_arr[3]);
$o = trim($test_arr[4]);
?>
<head>
    <meta charset="utf-8">
    <title><?=$name?></title>
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-select.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
</head>
<body>
    <div class="row-fluid">
        <div class="span6 offset3">
            <h2 class="text-center"><?=$name?></h2>
            <h4 class="text-right"><span class="timer"><?=$time?></span> секунд</h4>
            <p class="text-right"> Викладач: <strong><?=$teacher?></strong></p>
        </div>
        <?php
            for($i=5; $i<count($test_arr); $i++){
                $test = split('/', $test_arr[$i]);

                $test_html = '<div class="span6 offset3 well test">';
                $test_html .= '<p class="text-left">'.trim($test[0]).'</p>';
                $test_html .= '<div class="btn-group span12" data-toggle="buttons-radio">';
                $last = count($test)-1;
                $test_html .= '<data numb='.$i.' true="'.trim($test[$last]).'" >';
                for($j=1; $j<$last; $j++) {
                    $test_html .= '<button type="button" class="btn btn-link btn-test" data-render="'.$j.'">'.$j.') '.trim($test[$j]).'</button><br>';
                }
                $test_html .= '</div>';
                $test_html .= '</div>';
                echo $test_html;
            }
        ?>
        <div class="span6 offset3">
            <button class="span12 btn btn-large btn-primary">Завершити</button>
        </div>
    </div>
    <script>
        function startTimer(timer){
            setInterval(function () {
            timer.html(timer.html()-1);
            }, 1000);
        }

        startTimer($('.timer'));
    </script>
</body>

