<?php
class View
{
    private $view;
    private $data;

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render()
    {
        // Извлекаем данные в переменные
        extract($this->data);
        // Подключаем layout
        $content = __DIR__ . '/../app/Views/' . str_replace('.', '/', $this->view) . '.php';
        if (file_exists($content)) {
            ob_start();
            include $content;
            $contentBuffer = ob_get_clean();
            include __DIR__ . '/../app/Views/layouts/main.php';
        } else {
            die("View not found: {$this->view}");
        }
    }
}