<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-6 p-4">
            <h5 class="text-left mb-4" style="padding-bottom: 10px;">Reset Password</h5>
            <form id="register-form" method="post" action="<?= BASE_URL ?>user/reset_password/<?= $eid ?>"  style="padding: 20px;">
                <?php if (isset($error) && $error !== "") { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php } ?>
                <div class="form-group mb-4">
                    <label for="password" class="text-left">Kata Kunci:</label>
                    <br>
                    <input type="password" class="form-control form-control-md shadow-none" id="password" name="password" placeholder="Masukkan Kata Kunci" style="font-size: small; color: #666;" required>
                </div>
                <div class="form-group mb-4">
                    <label for="confirm_password" class="text-left">Konfirmasi Kata Kunci:</label>
                    <br>
                    <input type="password" class="form-control form-control-md shadow-none" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Kata Kunci" style="font-size: small; color: #666;" required>
                </div>
                <br>
                <button type="submit" class="btn btn-small" style="margin-top: 20px; margin-bottom: 20px; background-color: #3ba1da; color: #fff; padding: 10px 20px;">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>