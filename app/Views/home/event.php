<?php require_once '../app/Views/templates/header.php'; ?>
<?php require_once '../app/helpers/Helper.php'; ?>

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
    <div class="row justify-content-start">
        <div class="col-md-6 p-4">
            <h5 class="text-left mb-4" style="padding-bottom: 10px;">Komentar</h5>
            <div class="comment-list" style="padding: 0px;">
                <?php foreach ($comments as $comment): ?>
                    <?php 
                        // Mengambil inisial dari fullname
                        $initials = '';
                        $name_parts = explode(' ', $comment['fullname']);
                        foreach ($name_parts as $part) {
                            $initials .= strtoupper($part[0]);
                        }
                    ?>
                    <div class="comment-box" style="">
                        <div class="initials-circle">
                            <?= $initials ?>
                        </div>
                        <div class="comment-content">
                            <p class="text-muted comment-user"><?= $comment['fullname'] ?> <span  class="comment-date"><?= $comment['created_at'] ?></span></p>
                            <p ><?= $comment['comment'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (isset($_SESSION['eid'])): ?>
            <br>
            <div class="comment-form form-group mb-4" style="margin: 5px 0;">
                <textarea class="form-control form-control-md shadow-none" id="comment" name="comment" placeholder="Masukkan Komentar" style="font-size: small; color: #666;" required></textarea>
                <button type="button" id="btn-comment" class="btn btn-small" style="margin-top: 20px; margin-bottom: 20px; background-color: #3ba1da; color: #fff; padding: 10px 20px;">Kirim</button>
            </div>
            <?php else: ?>
                <br><br>
                <p>Anda harus login untuk mengirim komentar.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-comment').on('click', function(e) {
            e.preventDefault();
            if ($('#comment').val() === '') {
                alert('Komentar tidak boleh kosong');
                return;
            }
            $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL ?>home/addComment', // Replace with your comment submission URL
                data: { comment: $('#comment').val(), event: <?= $id ?> },
                success: function(data) {
                    window.location.reload();
                }
            });
        });
    });
</script>


<?php require_once '../app/Views/templates/footer.php'; ?>