<?php foreach ($news as $newsItem): ?>
    <div class="news-item">
        <h2><a href="/news/view/<?= $newsItem['id'] ?>"><?= $newsItem['title'] ?></a></h2>
        <p><?= substr($newsItem['content'], 0, 100) ?>...</p>
    </div>
<?php endforeach; ?>
