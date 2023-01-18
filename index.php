<?php
require_once('./vendor/autoload.php');

use App\Controllers\AuthController;
use App\Controllers\TestController;
use App\Controllers\API\TestController as APITestController;

$authController = new AuthController();
$testController = new TestController();

$apiTestController = new APITestController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestString = $_SERVER['REQUEST_URI'];

// API routes
if (strpos($requestString, 'api') !== false) {
    if ($requestMethod === 'GET' && strpos($requestString, 'tests') !== false) {
        $apiTestController->getList();

        return;
    }

    return;
}


// WEB routes
if (
    $requestMethod === 'GET' &&
    (
        !isset($_COOKIE['teacher']) &&
        !isset($_COOKIE['userName'])
    )
) {
    $authController->show();

    return;
}

if ($requestMethod === 'POST' && strpos($requestString, 'login') !== false) {
    $authController->login();

    return;
}

if ($requestMethod === 'GET' && strpos($requestString, 'logout') !== false) {
    $authController->logout();

    return;
}

if ($requestMethod === 'GET' && isset($_COOKIE['userName'])) {
    $testController->showList();

    return;
}
