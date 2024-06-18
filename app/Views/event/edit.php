<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
<form id="login-form" method="post" action="<?= BASE_URL ?>event/edit/<?= $news['id'] ?>" >
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <div class="form-group mb-4">
                    <input type="text" class="form-control form-control-md shadow-none" id="title" name="title" value="<?= $news['title'] ?>" placeholder="Masukkan Judul Pelatihan" style="font-size: small; color: #666;" required>
                </div>
                <p>Oleh: <?= $news['fullname'] ?> | <?= $news['created_at'] ?></p>
            </div>
            <div class="col-md-7 p-4">
                <textarea class="form-control" style="width: 100%; min-height: 450px;" name="description"><?= $news['description'] ?></textarea> 
            </div>
            <div class="col-md-5 p-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <button type="submit"class="btn btn-xs btn-primary save-button" title="Simpan Perubahan" data-title="<?= $news['title'] ?>">
                                    <span class="text-xs">Simpan Perubahan</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Peserta</th>
                            <td><?= $news['t_participant'] ?></td>
                        </tr>
<!--                         
                        <tr>
                            <th scope="row">Kategori</th>
                            <td><?= $news['category'] ?></td>
                        </tr>
 -->
                        <tr>
                            <th scope="row">Mulai</th>
                            <td><input type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($news['start_time'])); ?>" name="start_time"></td>
                        </tr>
                        <tr>
                            <th scope="row">Selesai</th>
                            <td><input type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($news['end_time'])); ?>" name="end_time"></td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat</th>
                            <td>
                                <textarea class="form-control" style="width: 100%; min-height: 150px;" name="venue"><?= $news['venue'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Zoom / Google Meet</th>
                            <td>
                                <input type="text" class="form-control" value="<?= $news['online_link'] ?>" name="online_link">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Peta Lokasi</th>
                            <td>
                                <input type="text" class="form-control" value="<?= $news['map_link'] ?>" name="map_link">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.save-button').on('click', function(e) {
            e.preventDefault();
            if (confirm("Apakah Anda yakin ingin Mengubah pelatihan `" + $(this).data('title') + "`?")) {
                $('form').submit();
            }
        });
    });
</script>

<?php require_once '../app/Views/templates/footer.php'; ?>