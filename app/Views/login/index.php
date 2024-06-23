<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-6 p-4">
            <h5 class="text-left mb-4" style="padding-bottom: 10px;">Masuk</h5>
            <form id="login-form" method="post" action="<?= BASE_URL ?>login/doLogin"  style="padding: 20px;">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php } ?>
                <div class="form-group mb-4">
                    <label for="nomor_eid" class="text-left">Email:</label>
                    <br>
                    <input type="text" class="form-control form-control-md shadow-none" id="nomor_eid" name="nomor_eid" placeholder="Masukkan Email" style="font-size: small; color: #666;" required>
                </div>
                <div class="form-group mb-4">
                    <label for="key" class="text-left">Kata Kunci:</label>
                    <br>
                    <input type="password" class="form-control form-control-md shadow-none" id="key" name="key" placeholder="Masukkan Kata Kunci" style="font-size: small; color: #666;" required>
                </div>
                <br>
                <button type="submit" class="btn btn-small" style="margin-top: 20px; margin-bottom: 20px; background-color: #3ba1da; color: #fff; padding: 10px 20px;">Masuk</button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>