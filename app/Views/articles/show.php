<div class="article-view">
    <h2>
        <?php echo htmlspecialchars($article['title']); ?>
    </h2>
    <div class="meta">Автор:
        <?php echo htmlspecialchars($article['author']); ?> | Опубликовано:
        <?php echo $article['created_at']; ?>
    </div>
    <div class="content">
        <?php echo nl2br(htmlspecialchars($article['content'])); ?>
    </div>
    <div class="actions">
        <a href="/article/<?php echo $article['id']; ?>/edit">Редактировать</a>
        <form action="/article/<?php echo $article['id']; ?>/delete" method="POST" style="display:inline;">
            <button type="submit" onclick="return confirm('Удалить статью?')">Удалить</button>
        </form>
        <a href="/articles">← Назад к списку</a>
    </div>
</div>