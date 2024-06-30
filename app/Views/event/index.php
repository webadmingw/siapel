<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="text-right mb-3">
        <a href="<?= BASE_URL ?>event/create" class="btn btn-sm btn-primary" title="Buat Baru">
            <span class="text-xs">Buat Baru</span>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Pelatihan</th>
                    <!-- <th>Kategori</th> -->
                    <th>Jumlah Peserta</th>
                    <th>Tanggal Mulai</th>
                    <!-- <th>Status Publikasi</th> -->
                    <th>Dibuat Oleh</th>
                    <th>Dibuat Pada</th>
                    <th>Diupdate Oleh</th>
                    <th>Diupdate Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= $event['title'] ?></td>
                        <!-- <td><?= $event['category'] ?></td> -->
                        <td>
                            <?= $event['t_participant'] ?>
                            <?php if($event["t_participant"] > 0): ?>
                            <a href="<?= BASE_URL ?>event/participant/<?= $event['id'] ?>" title="Lihat Peserta">
                                (<span class="text-xs">Lihat Peserta</span>)
                            </a>
                            <?php endif; ?>
                        </td>
                        <td><?= $event['start_time'] ?></td>
                        <!-- <td><?= $event['published'] ? 'Published' : 'Unpublished' ?></td> -->
                        <td><?= $event['created_by'] ?></td>
                        <td><?= $event['created_at'] ?></td>
                        <td><?= $event['updated_by'] ?></td>
                        <td><?= $event['updated_at'] ?></td>
                        <td style="width: 230px;">
                            <a href="<?= BASE_URL ?>event/edit/<?= $event['id'] ?>" class="btn btn-xs btn-primary" title="Edit">
                                <span class="text-xs">Edit</span>
                            </a>
                            <a href="<?= BASE_URL ?>event/view/<?= $event['id'] ?>" class="btn btn-xs btn-success" title="View">
                                <span class="text-xs">Lihat</span>
                            </a>
                            <a href="#" class="btn btn-xs btn-danger delete-event" data-id="<?= $event['id'] ?>" title="Delete" data-title="<?= $event['title'] ?>">
                                <span class="text-xs">Hapus</span>
                            </a>
                            <?php if(isset($event["published"]) && $event["published"] == "1"): ?>
                                <a href="#" class="btn btn-xs btn-warning close-event" data-id="<?= $event['id'] ?>" title="Tutup Pelatihan" data-title="<?= $event['title'] ?>">
                                    <span class="text-xs">Tutup Pelatihan</span>
                                </a>
                            <?php else: ?>
                                <a href="#" class="btn btn-xs btn-warning open-event" data-id="<?= $event['id'] ?>" title="Buka Pelatihan" data-title="<?= $event['title'] ?>">
                                    <span class="text-xs">Buka Pelatihan</span>
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
        $('.delete-event').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Apakah Anda yakin ingin menghapus pelatihan `" + $(this).data('title') + "`?")) {
                window.location.href = "<?= BASE_URL ?>event/delete/" + id;
            }
        });

        $('.close-event').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Apakah Anda yakin ingin menutup pelatihan `" + $(this).data('title') + "`?")) {
                window.location.href = "<?= BASE_URL ?>event/close/" + id;
            }
        });

        $('.open-event').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Apakah Anda yakin ingin Membuka pelatihan `" + $(this).data('title') + "`?")) {
                window.location.href = "<?= BASE_URL ?>event/open/" + id;
            }
        });

    });
</script>

<?php require_once '../app/Views/templates/footer.php'; ?>