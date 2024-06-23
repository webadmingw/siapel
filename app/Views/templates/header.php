
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAPEL - Sistem Informasi Pelatihan</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <script src="<?= BASE_URL ?>js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= BASE_URL ?>images/sultra-32x32.png" sizes="32x32">
</head>
<body>
    <header>
        <div class="top-header">
            <div class="container">
                <span id="clock">
                    03/03/93 14:00:00
                </span>
                <span id="weather">
                </span>
            </div>
        </div>
        <div class="container">
            <div class="site-branding-container">
                <div class="site-logo">
					<a href="<?= BASE_URL ?>" class="custom-logo-link" rel="home" aria-current="page">
                        <img width="90" src="<?= BASE_URL ?>images/sultra.png" class="custom-logo" alt="SIAPEL" decoding="async" fetchpriority="high">
                    </a>
                </div>
                <div class="site-branding">
                    <h1 class="site-title"><a href="<?= BASE_URL ?>" rel="home">SI APEL</a></h1>
                    <p class="site-description">Sistem Informasi Aplikasi Pelatihan</p>
                </div>
                <img width="150" src="<?= BASE_URL ?>images/cinta.png" class="custom-logo-bangga" alt="Bangga " decoding="async" fetchpriority="high">
            </div>
            <nav>
                <ul>
                    <li><a href="<?= BASE_URL ?>">Beranda</a></li>
                    <?php if(isset($_SESSION["eid"])): ?>
                        <?php if($_SESSION["role"] === "admin" || $_SESSION["role"] === "contributor"): ?>
                            <li><a href="<?= BASE_URL ?>event">Pelatihan</a></li>
                            <li><a href="<?= BASE_URL ?>news">Berita</a></li>
                        <?php endif; ?>
                        <?php if($_SESSION["role"] === "admin"): ?>
                            <li><a href="<?= BASE_URL ?>user">Pengguna</a></li>
                        <?php endif; ?>
                        <li><a href="<?= BASE_URL ?>logout">Keluar</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>login">Masuk</a></li>
                        <li><a href="<?= BASE_URL ?>user/reg">Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>