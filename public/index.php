<?php
session_start();

// 1. Подключаем все классы по порядку
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../core/Router.php';

// 2. Подключаем модели и контроллеры
require_once __DIR__ . '/../app/Models/Article.php';
require_once __DIR__ . '/../app/Controllers/PageController.php';
require_once __DIR__ . '/../app/Controllers/ArticleController.php';
require_once __DIR__ . '/../app/Controllers/CalculatorController.php';

// Подключение конфигурации
$config = require __DIR__ . '/../config/config.php';

// Инициализация БД
$dbInstance = Database::getInstance($config['db']);
$dbConnection = $dbInstance->getConnection();
$dbInstance->createTables();

// Глобальная переменная для моделей
global $dbConnection;

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../app/Controllers/PageController.php';
require_once __DIR__ . '/../app/Controllers/ArticleController.php';
require_once __DIR__ . '/../app/Controllers/CalculatorController.php';

$router = new Router();

// Маршруты
$router->addRoute('GET', '/', function () {
    $controller = new PageController();
    $controller->home();
});

// Статьи
$router->addRoute('GET', '/articles', function () {
    $controller = new ArticleController();
    $controller->index();
});
$router->addRoute('GET', '/article/create', function () {
    $controller = new ArticleController();
    $controller->create();
});
$router->addRoute('POST', '/article/store', function () {
    $controller = new ArticleController();
    $controller->store();
});
$router->addRoute('GET', '/article/{id}', function ($params) {
    $controller = new ArticleController();
    $controller->show($params);
});
$router->addRoute('GET', '/article/{id}/edit', function ($params) {
    $controller = new ArticleController();
    $controller->edit($params);
});
$router->addRoute('POST', '/article/{id}/update', function ($params) {
    $controller = new ArticleController();
    $controller->update($params);
});
$router->addRoute('POST', '/article/{id}/delete', function ($params) {
    $controller = new ArticleController();
    $controller->delete($params);
});

// Калькулятор
$router->addRoute('GET', '/calculator', function () {
    $controller = new CalculatorController();
    if (!empty($_GET['height']) && !empty($_GET['weight'])) {
        $controller->calculate();
    } else {
        $controller->index();
    }
});

// 404
$router->setNotFound(function () {
    http_response_code(404);
    echo '<div style="display:flex;justify-content:center;"><h1>404 - Страница не найдена</h1></div>';
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);