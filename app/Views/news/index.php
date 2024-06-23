<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="text-right mb-3">
        <a href="<?= BASE_URL ?>news/create" class="btn btn-sm btn-primary" title="Buat Baru">
            <span class="text-xs">Buat Baru</span>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Judul Berita</th>
                    <th>Status Publikasi</th>
                    <th>Dibuat Oleh</th>
                    <th>Dibuat Pada</th>
                    <th>Diupdate Oleh</th>
                    <th>Diupdate Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $event): ?>
                    <tr>
                        <td><?= $event['title'] ?></td>
                        <td><?= $event['published'] ? 'Published' : 'Unpublished' ?></td>
                        <td><?= $event['created_by'] ?></td>
                        <td><?= $event['created_at'] ?></td>
                        <td><?= $event['updated_by'] ?></td>
                        <td><?= $event['updated_at'] ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>news/edit/<?= $event['id'] ?>" class="btn btn-xs btn-primary" title="Edit">
                                <span class="text-xs">Edit</span>
                            </a>
                            <a href="<?= BASE_URL ?>news/view/<?= $event['id'] ?>" class="btn btn-xs btn-success" title="View">
                                <span class="text-xs">Lihat</span>
                            </a>
                            <a href="#" class="btn btn-xs btn-danger delete-event" data-id="<?= $event['id'] ?>" title="Delete" data-title="<?= $event['title'] ?>">
                                <span class="text-xs">Hapus</span>
                            </a>
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
            if (confirm("Apakah Anda yakin ingin menghapus berita `" + $(this).data('title') + "`?")) {
                window.location.href = "<?= BASE_URL ?>news/delete/" + id;
            }
        });
    });
</script>

<?php require_once '../app/Views/templates/footer.php'; ?>