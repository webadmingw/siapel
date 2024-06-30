<?php require_once '../app/Views/templates/header.php'; ?>

<div class="container">
    <div class="news-detail">
        <div class="row justify-content-start">
            <div class="col-md-12 p-4">
                <h2>Data Peserta Pelatihan</h2>
            </div>
            <div class="col-md-7 p-4">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Peserta</th>
                            <th>KTP</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Tanggal Registrasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($par as $p): ?>
                            <tr>
                                <td><?= $p['fullname'] ?></td>
                                <td><?= $p['ktp'] ?></td>
                                <td><?= nl2br($p['addr']); ?></td>
                                <td><?= $p['cities_name'] ?></td>
                                <td><?= $p['registered_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-5 p-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <a target="_blank" href="<?= BASE_URL ?>event/download/<?= $event['id'] ?>" class="btn btn-xs btn-primary" title="Unduh Data Peserta">
                                    <span class="text-xs">Unduh Data Peserta</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pelatihan</th>
                            <td><?= $event['title'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Peserta</th>
                            <td><?= $event['t_participant'] ?></td>
                        </tr>
                        <!-- 
                        <tr>
                            <th scope="row">Kategori</th>
                            <td><?= $event['category'] ?></td>
                        </tr>
                         -->
                        <tr>
                            <th scope="row">Mulai</th>
                            <td><?= Helper::ConvertDateTime($event['start_time']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Selesai</th>
                            <td><?= Helper::ConvertDateTime($event['end_time']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat</th>
                            <td><?= nl2br($event['venue']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Zoom / Google Meet</th>
                            <td><a href="<?= $event['online_link'] ?>"><?= $event['online_link'] ?></a></td>
                        </tr>
                        <tr>
                            <th scope="row">Peta Lokasi</th>
                            <td><a href="<?= $event['map_link'] ?>"><?= $event['map_link'] ?></a></td>
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