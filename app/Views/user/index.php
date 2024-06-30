<?php require_once '../app/Views/templates/header.php'; ?>
<style>
    /* Tooltip container */
    .mytooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* Tooltip text */
    .tooltip-text {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        white-space: nowrap;
        opacity: 100;
        transition: opacity 0.3s;
        z-index: 9999; /* Ensure tooltip is above other elements */
    }


</style>
<div class="container my-body">
    <div class="tooltip-text">Jajang</div>
    <div class="text-right mb-3">
        <a href="<?= BASE_URL ?>user/createUser" class="btn btn-sm btn-primary" title="Daftar Baru">
            <span class="text-xs">Tambah Peserta Baru</span>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Induk Pegawai</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Nama Lengkap</th>
                    <th>KTP</th>
                    <!-- <th>Alamat</th> -->
                    <th>Kab/Kota</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['eid'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['phone_number'] ?></td>
                        <td><?= $user['fullname'] ?></td>
                        <td><?= $user['ktp'] ?></td>
                        <!-- <td><?= nl2br($user['addr']) ?></td> -->
                        <td>
                            <a href="#" class="mytooltip" data-tooltip="<?= $user['addr'] ?>"><?= $user['city_name'] ?></a>
                        </td>
                        <td><?= $user['role'] == 'admin' ? 'Admin' : ($user['role'] == 'contributor' ? 'Kontributor' : 'Peserta') ?></td>
                        <td>
                            <a href="<?= BASE_URL . "user/edit/" . $user['eid'] ?>" class="btn btn-xs btn-primary" title="Edit">
                                <span class="text-xs">Edit</span>
                            </a>
                            <a href="<?= BASE_URL ?>user/reset_password/<?= $user['eid'] ?>" class="btn btn-xs btn-warning" title="Reset Password">
                                <span class="text-xs">Reset Password</span>
                            </a>
                            <?php if ($_SESSION['eid'] != $user['eid']): ?>
                            <a href="#" class="btn btn-xs btn-danger delete-user" data-id="<?= $user['eid'] ?>" title="Delete" data-title="<?= $user['fullname'] ?>">
                                <span class="text-xs">Hapus</span>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-user').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Apakah Anda yakin ingin menghapus pengguna `" + $(this).data('title') + "`?")) {
                window.location.href = "<?= BASE_URL ?>user/delete/" + id;
            }
        });

        $('.mytooltip').hover(function() {
            // On mouse enter
            var tooltipText = $(this).attr('data-tooltip');
            var myBody = $('.my-body')
            $('<div class="tooltip-text"></div>')
                .text(tooltipText)
                .prependTo(myBody)
                .css({
                    top: $(this).offset().top + $(this).height(),
                    left: $(this).offset().left + $(this).width() / 2
                })
                .fadeIn(300);
        }, function() {
            // On mouse leave
            $('.tooltip-text').remove();
        });

        // Optional: Handle mouse move to update tooltip position
        $('.tooltip').mousemove(function(e) {
            $('.tooltip-text').css({
                top: e.pageY + 10, // 10px offset for better positioning
                left: e.pageX
            });
        });

    });

</script>

<?php require_once '../app/Views/templates/footer.php'; ?>