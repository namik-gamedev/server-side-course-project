<div class="form-page">
    <h2>Редактировать статью</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <form action="/article/<?php echo $article['id']; ?>/update" method="POST">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($article['title']); ?>"
                required>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" value="<?php echo htmlspecialchars($article['author']); ?>"
                required>
        </div>
        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea name="content" id="content" rows="10"
                required><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>
        <button type="submit">Обновить</button>
    </form>
</div>