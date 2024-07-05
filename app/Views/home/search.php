<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <h2>Hasil Pencarian:</h2>
    <br>    
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