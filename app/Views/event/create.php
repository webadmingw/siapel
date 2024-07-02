<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
<form id="login-form" method="post" action="<?= BASE_URL ?>event/create" enctype="multipart/form-data">
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <div class="form-group mb-4">
                    <input type="text" class="form-control form-control-md shadow-none" id="title" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>" placeholder="Masukkan Judul Pelatihan" style="font-size: small; color: #666;" required>
                    <?php if (isset($errors['title'])): ?>
                        <small class="text-danger"><?= $errors['title']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-7 p-4">
                <textarea class="form-control" style="width: 100%; min-height: 450px;" name="description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea> 
                <?php if (isset($errors['description'])): ?>
                    <small class="text-danger"><?= $errors['description']; ?></small>
                <?php endif; ?>
            </div>
            <div class="col-md-5 p-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <button type="submit"class="btn btn-xs btn-primary save-button" title="Simpan Perubahan">
                                    <span class="text-xs">Simpan pelatihan baru</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Peserta</th>
                            <td></td>
                        </tr>
<!--                         
                        <tr>
                            <th scope="row">Kategori</th>
                            <td></td>
                        </tr>
 -->
                        <tr>
                            <th scope="row">Mulai</th>
                            <td>
                                <input type="datetime-local" name="start_time" value="<?php echo isset($_POST['start_time']) ? $_POST['start_time'] : ''; ?>">
                                <?php if (isset($errors['start_time'])): ?>
                                    <small class="text-danger"><?= $errors['start_time']; ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Selesai</th>
                            <td>
                                <input type="datetime-local" name="end_time" value="<?php echo isset($_POST['end_time']) ? $_POST['end_time'] : ''; ?>">
                                <?php if (isset($errors['end_time'])): ?>
                                    <small class="text-danger"><?= $errors['end_time']; ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat</th>
                            <td>
                                <textarea class="form-control" style="width: 100%; min-height: 150px;" name="venue"><?php echo isset($_POST['venue']) ? $_POST['venue'] : ''; ?></textarea>
                                <?php if (isset($errors['venue'])): ?>
                                    <small class="text-danger"><?= $errors['venue']; ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Zoom / Google Meet</th>
                            <td>
                                <input type="text" class="form-control" name="online_link" value="<?php echo isset($_POST['online_link']) ? $_POST['online_link'] : ''; ?>">
                                <?php if (isset($errors['online_link'])): ?>
                                    <small class="text-danger"><?= $errors['online_link']; ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Peta Lokasi</th>
                            <td>
                                <input type="text" class="form-control" name="map_link" value="<?php echo isset($_POST['map_link']) ? $_POST['map_link'] : ''; ?>">
                                <?php if (isset($errors['map_link'])): ?>
                                    <small class="text-danger"><?= $errors['map_link']; ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Materi Pelatihan</th>
                            <td>
                                <img id="show-room" alt="" style="width:150px;font-size: small; color: #666;"><br>
                                <input type="file" id="attachment" name="attachment" class="form-control" placeholder="Pilih berkas" required>
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
            if (confirm("Apakah Anda yakin ingin membuat pelatihan baru?")) {
                $('form').submit();
            }
        });
    });
</script>

<?php require_once '../app/Views/templates/footer.php'; ?>