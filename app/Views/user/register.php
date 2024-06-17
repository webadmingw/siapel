<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-6 p-4">
            <h5 class="text-left mb-4" style="padding-bottom: 10px;">Daftar</h5>
            <form id="register-form" method="post" action="<?= BASE_URL ?>user/reg"  style="padding: 20px;">
                <?php if (isset($error) && $error !== "") { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php } ?>
                <div class="form-group mb-4">
                    <label for="nomor_eid" class="text-left">Induk Pegawai:</label>
                    <br>
                    <input type="text" class="form-control form-control-md shadow-none" id="nomor_eid" name="nomor_eid" placeholder="Masukkan Induk Pegawai" style="font-size: small; color: #666;" value="<?= isset($post['nomor_eid']) ? $post['nomor_eid'] : ''; ?>" required>
                </div>
                <div class="form-group mb-4">
                    <label for="email" class="text-left">Email:</label>
                    <br>
                    <input type="email" class="form-control form-control-md shadow-none" id="email" name="email" placeholder="Masukkan Email" style="font-size: small; color: #666;" value="<?= isset($post['email']) ? $post['email'] : ''; ?>" required>
                </div>
                <div class="form-group mb-4">
                    <label for="phone_number" class="text-left">Nomor Telepon:</label>
                    <br>
                    <input type="tel" class="form-control form-control-md shadow-none" id="phone_number" name="phone_number" placeholder="Masukkan Nomor Telepon" style="font-size: small; color: #666;" value="<?= isset($post['phone_number']) ? $post['phone_number'] : ''; ?>" required>
                </div>
                <div class="form-group mb-4">
                    <label for="fullname" class="text-left">Nama Lengkap:</label>
                    <br>
                    <input type="text" class="form-control form-control-md shadow-none" id="fullname" name="fullname" placeholder="Masukkan Nama Lengkap" style="font-size: small; color: #666;" value="<?= isset($post['fullname']) ? $post['fullname'] : ''; ?>" required>
                </div>
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
                <button type="submit" class="btn btn-small" style="margin-top: 20px; margin-bottom: 20px; background-color: #3ba1da; color: #fff; padding: 10px 20px;">Daftar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>