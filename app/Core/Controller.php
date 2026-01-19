<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        if (file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            die('View does not exist: ' . $view);
        }
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}
