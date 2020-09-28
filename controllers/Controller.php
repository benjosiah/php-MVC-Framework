<?php


namespace app\controllers;


use app\core\Application;

class Controller
{
    public function render($callback, $params=[]){
        return Application::$app->router->renderView($callback, $params);
    }
}