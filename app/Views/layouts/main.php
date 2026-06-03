<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Фитнес-блог'); ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <h1><a href="/">Фитнес-блог</a></h1>
                <nav>
                    <a href="/">Главная</a>
                    <a href="/articles">Статьи</a>
                    <a href="/article/create">Добавить статью</a>
                    <a href="/calculator">Калькулятор ИМТ</a>
                </nav>
            </div>
        </header>
        <main class="container">
            <?php echo $contentBuffer; ?>
        </main>
        <footer>
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> Фитнес-блог. Все права защищены.</p>
            </div>
        </footer>
    </div>
</body>

</html>