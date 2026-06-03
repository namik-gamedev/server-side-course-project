<?php
require_once __DIR__ . '/../../core/Controller.php';

class PageController extends Controller
{
    public function home()
    {
        $this->render('pages.home', [
            'pageTitle' => 'Главная'
        ]);
    }
}