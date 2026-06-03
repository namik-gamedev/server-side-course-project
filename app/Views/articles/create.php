<div class="form-page">
    <h2>Добавить новую статью</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <form action="/article/store" method="POST">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" required>
        </div>
        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea name="content" id="content" rows="10" required></textarea>
        </div>
        <button type="submit">Сохранить</button>
    </form>
</div>