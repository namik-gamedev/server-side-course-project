<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';

class ArticleController extends Controller
{
    private $articleModel;

    public function __construct()
    {
        global $dbConnection;
        $this->articleModel = new Article($dbConnection);
    }

    // Список статей
    public function index()
    {
        $articles = $this->articleModel->all();
        $this->render('articles.index', [
            'articles' => $articles,
            'pageTitle' => 'Все статьи'
        ]);
    }

    // Просмотр одной статьи
    public function show($params)
    {
        $id = $params['id'];
        $article = $this->articleModel->find($id);
        if (!$article) {
            $this->redirect('/articles');
        }
        $this->render('articles.show', [
            'article' => $article,
            'pageTitle' => $article['title']
        ]);
    }

    // Форма создания
    public function create()
    {
        $this->render('articles.create', [
            'pageTitle' => 'Добавить статью'
        ]);
    }

    // Сохранение новой статьи
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/articles/create');
        }
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $author = trim($_POST['author'] ?? '');

        if (empty($title) || empty($content) || empty($author)) {
            // Простая валидация – можно вернуться с ошибкой
            $_SESSION['error'] = 'Заполните все поля';
            $this->redirect('/articles/create');
        }

        $this->articleModel->create([
            'title' => $title,
            'content' => $content,
            'author' => $author
        ]);

        $this->redirect('/articles');
    }

    // Форма редактирования
    public function edit($params)
    {
        $id = $params['id'];
        $article = $this->articleModel->find($id);
        if (!$article) {
            $this->redirect('/articles');
        }
        $this->render('articles.edit', [
            'article' => $article,
            'pageTitle' => 'Редактировать статью'
        ]);
    }

    // Обновление статьи
    public function update($params)
    {
        $id = $params['id'];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect("/article/{$id}/edit");
        }
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $author = trim($_POST['author'] ?? '');

        if (empty($title) || empty($content) || empty($author)) {
            $_SESSION['error'] = 'Заполните все поля';
            $this->redirect("/article/{$id}/edit");
        }

        $this->articleModel->update($id, [
            'title' => $title,
            'content' => $content,
            'author' => $author
        ]);

        $this->redirect('/articles');
    }

    // Удаление статьи
    public function delete($params)
    {
        $id = $params['id'];
        $this->articleModel->delete($id);
        $this->redirect('/articles');
    }
}