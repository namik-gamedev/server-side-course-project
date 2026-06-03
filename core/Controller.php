<?php
abstract class Controller
{
    protected function render($view, $data = [])
    {
        $viewObj = new View($view, $data);
        $viewObj->render();
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}