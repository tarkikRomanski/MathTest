<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller {
    public function show() {
        $this->twig->display('auth.twig');
    }

    public function login() {
        if(!isset($_POST['name'], $_POST['group'])){
            header('Location: /');

            return;
        }

        if($_POST['name'] === '1' && $_POST['group'] === '1') {
            setcookie('teacher', 'true', 0x6FFFFFFF);
            header('Location: /');

            return;
        }

        setcookie('userName', $_POST['name'], 0x6FFFFFFF);
        setcookie('userGroup', $_POST['group'], 0x6FFFFFFF);
        header('Location: /');
    }

    public function logout() {
        setcookie('userName', null, -10);
        setcookie('userGroup', null, -10);
        setcookie('teacher', null, -10);

        header('Location: /');
    }
}
