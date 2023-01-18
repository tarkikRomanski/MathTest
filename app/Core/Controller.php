<?php

namespace App\Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class Controller {
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('resources/views');

        $this->twig = new Environment($loader, [
            'cache' => false,
            'debug' => true,
//            'cache' => 'vendor/cache',
        ]);

        $this->twig->addGlobal('userName', $_COOKIE['userName']);
        $this->twig->addGlobal('userGroup', $_COOKIE['userGroup']);
        $this->twig->addGlobal('teacher', $_COOKIE['teacher']);

        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }
}
