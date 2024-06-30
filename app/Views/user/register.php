<?php require_once '../app/Views/templates/header.php'; ?>
<?php require_once '../app/helpers/Helper.php'; ?>

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
                <input type="hidden" class="form-control form-control-md shadow-none" id="nomor_eid" name="nomor_eid" style="font-size: small; color: #666;" value="<?= isset($post['nomor_eid']) ? $post['nomor_eid'] : Helper::generateRandomNumber() ?>" required>
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
                <div class="form-group mb-4">
                    <label for="ktp" class="text-left">KTP:</label>
                    <br>
                    <input type="text" class="form-control form-control-md shadow-none" id="ktp" name="ktp" placeholder="Masukkan Nomor KTP" style="font-size: small; color: #666;" value="<?= isset($_POST['ktp']) ? $_POST['ktp'] : "" ?>" required>
                </div>
                <div class="form-group mb-4">
                    <label for="addr" class="text-left">Alamat:</label>
                    <br>
                    <textarea placeholder="Masukkan Alamat" class="form-control form-control-md shadow-none" style="width: 100%; min-height: 150px;font-size: small; color: #666;" name="addr"><?= isset($_POST['addr']) ? $_POST['addr'] : "" ?></textarea> 
                </div>
                <div class="form-group mb-4">
                    <label for="cities" class="text-left">Kab/Kota:</label>
                    <br>
                    <select class="form-control form-control-md shadow-none" id="cities" name="cities" style="font-size: small; color: #666;" required>
                        <option value=""></option>
                        <?php foreach ($cities as $c): ?>
                            <option value="<?= $c['code'] ?>" <?= (isset($_POST['cities']) ? $_POST['cities'] : "") == $c['code'] ? 'selected' : ''; ?>><?= $c['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-small" style="margin-top: 20px; margin-bottom: 20px; background-color: #3ba1da; color: #fff; padding: 10px 20px;">Daftar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>