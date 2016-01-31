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
    <div class="row-fluid">
        <div class="span6 offset3">
            <h2 class="text-center"><?=$name?></h2>
            <h4 class="text-right"><span class="timer"><?=$time?></span> секунд</h4>
            <p class="text-right"> Викладач: <strong><?=$teacher?></strong></p>
        </div>
        <?php
            setcookie('test', $href);
            for($i=5; $i<count($test_arr); $i++){
                $test = split('\\', $test_arr[$i]);

                $test_html = '<div class="span6 offset3 well test">';
                $test_html .= '<p class="text-left">'.trim($test[0]).'</p>';
                $test_html .= '<div class="btn-group span12" data-toggle="buttons-radio">';
                $last = count($test)-1;
                for($j=1; $j<$last; $j++) {
                    $test_html .= '<button type="button" class="btn btn-link btn-test" data-numb='.$i.' data-render="'.$j.'">'.$j.') '.trim($test[$j]).'</button><br>';
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
    <script>
        function startTimer(timer){
            var times = +timer.html();
            var interval = setInterval(function () {
            timer.html(timer.html()-1);
            if( Math.abs(timer.html())== times){
                $('.btn-send').click();
                clearInterval(interval);
}
            }, 1000);
        }

        startTimer($('.timer'));

        var renders = new Array($('.btn-group').size());

           $('.btn-test').click(function(){
              $(this).parent().find('.btn-test').removeClass('select');
               $(this).addClass('select');
               renders[$(this).attr('data-numb')] = $(this).attr('data-render');
           });

        $('.btn-send').click(function () {
            var render = '';
            for(var i=0;i<renders.length; i++){
                render += renders[i]+'\\';
            }
            $.get(
                'testResponder.php',
                {
                    render:render,
                    timer:$('.timer').html()
                },
                function(data){
                    alert(data);
                }
            )
        });
    </script>
</body>

