<?php
setcookie('userName', null, -10);
setcookie('userGroup', null, -10);
header('Location: index.php');