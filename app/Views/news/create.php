<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
<form id="login-news" method="post" action="<?= BASE_URL ?>news/create" enctype="multipart/form-data">
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <div class="form-group mb-4">
                    <input type="text" class="form-control form-control-md shadow-none" id="titles" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : '' ?>" placeholder="Masukan Judul Berita" style="font-size: small; color: #666;" required>
                </div>
            </div>
            <div class="col-md-7 p-4">
                <textarea class="form-control" placeholder="Masukan Isi Berita" style="width: 100%; min-height: 450px;" name="content" required id="content"><?= isset($_POST['content']) ? $_POST['content'] : '' ?></textarea> 
            </div>
            <div class="col-md-5 p-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <button type="submit"class="btn btn-xs btn-primary save-button" title="Simpan Berita">
                                    <span class="text-xs">Simpan Berita</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Image</th>
                            <td>
                                <img id="show-room" alt="" style="width:150px;"><br>
                                <input type="file" id="image" name="image" class="form-control" placeholder="Pilih berkas" required>
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
            var titles = $('#titles').val();
            var content = $('#content').val();
            var image = $('#image').val();
            
            if (titles == '' || content == '' || image == '') {
                alert('Harap isi semua data.');
            } else {
                if (confirm("Anda yakin akan menambah berita?")) {
                    $('form').submit();
                }
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

