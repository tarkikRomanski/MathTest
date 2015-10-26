<?php
if(isset($_COOKIE['userName'])) {
    include_once 'selected.php';
} else {
    include_once 'reg.php';
}
?>