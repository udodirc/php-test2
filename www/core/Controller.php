<?php

namespace core;

use JetBrains\PhpStorm\NoReturn;

class Controller
{
    private string $url = 'http://php.local/';
    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            extract($data);
            require_once '../app/views/' . $view . '.php';
        }
    }

    #[NoReturn] public function redirect($url): void
    {
        header("Location: ".$this->url.$url, true, 301);
        exit();
    }

    #[NoReturn] public function json(array $response): void
    {
        // Возвращаем ответ в формате JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}