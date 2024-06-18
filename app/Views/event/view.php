<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <h2><?= $news['title'] ?></h2>
                <p>Oleh: <?= $news['fullname'] ?> | <?= $news['created_at'] ?></p>
            </div>
            <div class="col-md-7 p-4">
                <p><?= nl2br($news['description']) ?></p>    
            </div>
            <div class="col-md-5 p-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <a href="<?= BASE_URL ?>event/edit/<?= $news['id'] ?>" class="btn btn-xs btn-primary" title="Edit">
                                    <span class="text-xs">Edit</span>
                                </a>
                                <a href="#" class="btn btn-xs btn-danger delete-event" data-id="<?= $news['id'] ?>" title="Delete" data-title="<?= $news['title'] ?>">
                                    <span class="text-xs">Hapus</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Peserta</th>
                            <td><?= $news['t_participant'] ?></td>
                        </tr>
                        <!-- 
                        <tr>
                            <th scope="row">Kategori</th>
                            <td><?= $news['category'] ?></td>
                        </tr>
                         -->
                        <tr>
                            <th scope="row">Mulai</th>
                            <td><?= Helper::ConvertDateTime($news['start_time']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Selesai</th>
                            <td><?= Helper::ConvertDateTime($news['end_time']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat</th>
                            <td><?= nl2br($news['venue']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Zoom / Google Meet</th>
                            <td><a href="<?= $news['online_link'] ?>"><?= $news['online_link'] ?></a></td>
                        </tr>
                        <tr>
                            <th scope="row">Peta Lokasi</th>
                            <td><a href="<?= $news['map_link'] ?>"><?= $news['map_link'] ?></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-event').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Apakah Anda yakin ingin menghapus pelatihan `" + $(this).data('title') + "`?")) {
                window.location.href = "<?= BASE_URL ?>event/delete/" + $(this).data('id');
            }
        });
    });
</script>

<?php require_once '../app/Views/templates/footer.php'; ?>