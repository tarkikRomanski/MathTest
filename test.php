<?php
$href = 'tests/'.$_POST['test_name'];
$test_arr = file($href);
$name = trim($test_arr[1]);
$time = trim($test_arr[2]);
$teacher = trim($test_arr[3]);
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
    <div class="row-fluid all-test">
        <div class="span6 offset3">
            <h2 class="text-center test-name"><?=$name?></h2>

            <h5 class="text-right">Дано часу - <?=$time?> секунд</h5>
            <h4 class="text-right"><span class="timer"><?=$time?></span> секунд</h4>
            <p class="text-right"> Викладач: <strong><?=$teacher?></strong></p>
        </div>
        <?php
            setcookie('test', $href);
            for($i=5; $i<count($test_arr); $i++){
                $test = split('/:i:/', $test_arr[$i]);

                $test_html = '<div class="span6 offset3 well test">';
                $test_html .= '<p class="text-left">'.($i-4).'. '.trim($test[0]).'</p>';
                $test_html .= '<div class="btn-group span12 test-group" data-toggle="buttons-radio" data-numb='.$i.'>';
                $last = count($test)-1;
                for($j=1; $j<$last; $j++) {
                    $test_html .= '<button type="button" class="btn btn-link btn-test" data-render="'.$j.'">'.$j.') '.trim($test[$j]).'</button><br>';
                }
                $test_html .= '</div>';
                $test_html .= '</div>';
                echo $test_html;
            }
        ?>
        <div class="span6 offset3">
            <button class="span12 btn btn-large btn-primary btn-send">Завершити</button>
        </div>
    </div>

    <div class="row-fluid result">
        <div class="span6 offset3">
            <h1 class="text-center">Ваш результат!</h1>
            <h4 class="text-left">Тест: <?=$name?></h4>
            <h4 class="text-right"><?=$_COOKIE['userName'] . '  ' . $_COOKIE['userGroup']?></h4>
            <h1 class="text-center"><span id="resultat"></span> балів</h1>
            <p>Потрачений час: <span class="b"></span> секунд</p>
            <a href="index.php" class="btn btn-link text-rigth" style="color: white">Далі</a>
        </div>
    </div>
    <script>

        function startTimer(timer){
            var timesToSend = +timer.html();
            var time = +timer.html();
            timer.html(0);
            var interval = setInterval(function () {
            timer.html(+timer.html()+1);
            if( Math.abs(timer.html())== timesToSend*2){
                $('.btn-send').click();
                clearInterval(interval);
}
            }, 1000);
        }

        startTimer($('.timer'));


        $('.btn-send').click(function () {
            var render = '';

            var tests = $('.test-group');

            tests.each(function(index, val) {
                rendere = $(this).find('button.active').attr('data-render');
                if(typeof rendere == "undefined")
                    rendere = "0";
                render += rendere  + ' ';
            });
            $(this).attr('disabled', 'disabled');
            $.get(
                'testResponder.php',
                {
                    render:render,
                    timer:$('.timer').html()
                },
                function(data){
                    $('.all-test').css('display', 'none');
                    $('.result').css('display', 'block');
                    $('#resultat').html(data);
                    $('.b').html($('.timer').html());
                    $('.result').addClass('bad');
                }
            );

                      });

    </script>
</body>

