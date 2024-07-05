<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <section class="hero">
        <div class="carousel">
            <?php foreach ($news as $newsItem) { ?>
            <div class="carousel-item <?php if ($newsItem === reset($news)) echo 'active'; ?>">
                <img src="<?= BASE_URL; ?>upload/<?php echo $newsItem['image']; ?>" alt="<?php echo $newsItem['title']; ?>">
                <div class="carousel-content">
                    <h2><a href="<?= BASE_URL; ?>home/news/<?= $newsItem['id']; ?>"><?= $newsItem['title']; ?></a></h2>
                    <p class="info-time" data-datetime="<?= strtotime($newsItem['updated_at']); ?>">oleh: <?= $newsItem['fullname'] ?> <?= $newsItem['updated_at']; ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="carousel-controls">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
    </section>

    <section class="articles">
        <?php if (empty($event)) { ?>
            <div class="empty">Saat ini belum tersedia pelatihan</div>
        <?php } else { ?>
            <?php foreach ($event as $eventItem) { ?>
                <article>
                    <h5>
                        <a href="<?= BASE_URL; ?>home/event/<?= $eventItem['id']; ?>"><?= $eventItem['title']; ?>
                            <?= $eventItem['title']; ?>
                            <?php if($eventItem['completed']): ?>
                                <span style="font-size:15px;color:red;">(Selesai)</span>
                            <?php elseif($eventItem['ongoing'] && !$eventItem['completed']): ?>
                                <span style="font-size:15px;color:red;">(Sedang Berlangsung)</span>
                            <?php endif; ?>
                        </a>
                    </h5>
                    <p><small style="color: #bbb;">
                        <?= Helper::ConvertDateTime($eventItem['start_time']); ?>
                    </small></p>
                    <p><?= substr(strip_tags($eventItem['description']), 0, 300); ?>...</p>
                </article>
            <?php } ?>
        <?php } ?>
    </section>
</div>

<script src="<?= BASE_URL ?>js/carousel.js"></script>

<?php require_once '../app/Views/templates/footer.php'; ?>