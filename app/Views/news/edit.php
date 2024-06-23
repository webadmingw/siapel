<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
<form id="login-news" method="post" action="<?= BASE_URL ?>news/edit/<?= $news['id'] ?>" enctype="multipart/form-data">
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <div class="form-group mb-4">
                    <input type="text" class="form-control form-control-md shadow-none" id="title" name="title" value="<?= $news['title'] ?>" placeholder="Masukkan Judul Pelatihan" style="font-size: small; color: #666;" required>
                </div>
                <p>Oleh: <?= $news['fullname'] ?> | <?= $news['created_at'] ?></p>
            </div>
            <div class="col-md-7 p-4">
                <textarea class="form-control" style="width: 100%; min-height: 450px;" name="content"><?= $news['content'] ?></textarea> 
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
                            <th scope="row">Gambar</th>
                            <td>
                                <img id="show-room" src="<?= BASE_URL . "upload/" . $news['image'] ?>" alt="<?= $news['title'] ?>" style="width:150px;"><br>
                                <input type="file" id="image" name="image" class="form-control" placeholder="Pilih berkas">
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

    $('#image').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#show-room').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    });
</script>

<?php require_once '../app/Views/templates/footer.php'; ?>

