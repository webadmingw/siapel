<div class="news-detail">
    <h1><?= $news['title'] ?></h1>
    <p><?= $news['content'] ?></p>
    <img src="<?= BASE_URL . $news['image'] ?>" alt="<?= $news['title'] ?>">
    <p>Contributor: <?= $news['contributor_id'] ?></p>
    <p>Published on: <?= $news['created_at'] ?></p>
</div>
