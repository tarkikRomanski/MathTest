<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Реєстрація</title>
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-select.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
</head>
<body>
    <center><img class="img-rounded " src="img/ico.png" width="140" height="140" ></center>
    <?php include_once "navigator.php" ?>
    <?php
        if(isset($_COOKIE['userName']) || isset($_COOKIE['teacher'])) {
            echo '
                <div class="row-fluid">
                    <div class="offset3 span6 text-center text-info">
                        <a href="exit.php">Вийти</a>
                    </div>
                </div>
            ';
        }
    ?>
</body>
</html>