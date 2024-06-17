<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <h2><?= $news['title'] ?></h2>
                <p>Oleh: <?= $news['fullname'] ?> | <?= $news['created_at'] ?></p>
            </div>
            <div class="col-md-7 p-4">
                <p><?= nl2br($news['description']) ?></p>    
            </div>
            <div class="col-md-5 p-4">
                <table class="table">
                    <tbody>
                        <?php if(isset($_SESSION["eid"])): ?>
                            <tr>
                                <td colspan="2">
                                    <?php if(!isset($registeredEvent["registered_at"])): ?>
                                        <a href="<?= BASE_URL ?>home/reg/<?= $news['id'] ?>">Ikuti pelatihan sekarang</a>
                                    <?php else: ?>
                                        <?= "Anda sudah terdaftar di pelatihan ini" ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th scope="row">Peserta</th>
                            <td><?= $news['t_participant'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Mulai</th>
                            <td><?= Helper::ConvertDateTime($news['start_time']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Selesai</th>
                            <td><?= Helper::ConvertDateTime($news['end_time']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat</th>
                            <td><?= nl2br($news['venue']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Zoom / Google Meet</th>
                            <td><a href="<?= $news['online_link'] ?>"><?= $news['online_link'] ?></a></td>
                        </tr>
                        <tr>
                            <th scope="row">Peta Lokasi</th>
                            <td><a href="<?= $news['map_link'] ?>"><?= $news['map_link'] ?></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>