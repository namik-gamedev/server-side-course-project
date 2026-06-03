<div class="articles-list">
    <h2>Все статьи</h2>
    <?php if (empty($articles)): ?>
        <p>Пока нет статей. Будьте первым, кто <a href="/article/create">добавит статью</a>!</p>
    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <div class="article-card">
                <h3><a href="/article/<?php echo $article['id']; ?>">
                        <?php echo htmlspecialchars($article['title']); ?>
                    </a></h3>
                <div class="author">
                    <?php echo htmlspecialchars($article['author']); ?>
                </div>
                <div class="content">
                    <?php echo $article['content']; ?>
                </div>
                <div class="actions">
                    <a href="/article/<?php echo $article['id']; ?>/edit">Редактировать</a>
                    <form action="/article/<?php echo $article['id']; ?>/delete" method="POST" style="display:inline;">
                        <button type="submit" onclick="return confirm('Удалить статью?')">Удалить</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>