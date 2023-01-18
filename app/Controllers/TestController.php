<?php

namespace App\Controllers;

use App\Core\Controller;

class TestController extends Controller {
    public function showList() {
        $this->twig->display('tests-list.twig');
    }
}
