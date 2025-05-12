<?php require_once '../app/Core/security.php'; ?>
<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="news-detail">
        <img src="<?= BASE_URL . "upload/" . $news['image'] ?>" alt="<?= $news['title'] ?>">
        <h2><?= Security::sanitizeOutput($news['title']) ?></h2>
        <p>Oleh: <?= $news['fullname'] ?> | <?= $news['created_at'] ?></p>
        <p><?= Security::sanitizeOutput($news['content']) ?></p>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>