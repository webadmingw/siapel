
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
    <style>
        .input-search {
            background-color: #ffffff;
            font-size: small !important;
            border: none !important;
            width:80%;
            float: left;
        }
        .input-search:focus {
            background-color: #ffffff;
            box-shadow: none;
        }
        .button-search {
            padding:5px;
            background-color: #ffffff;
            border: none;
            float: left;
        }
        .svg-icon.search-icon {
            display: inline-block;
            width: 20px;
            height: 20px;

            /* On hover: blue strokes */
            &:focus,
            &:hover {
                .search-path {
                stroke: #299ecc;
                }
            }

            /* On click: thicker black strokes  */
            &:active {
                .search-path {
                stroke: #111516;
                stroke-width: 2px;
                }
            }
        }
        .row.search-form {
            /* border: 1px solid #000000; */
            background-color: #ffffff;
            height:35px;
        }
    </style>
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
                    <h1 class="site-title"><a href="<?= BASE_URL ?>" rel="home">SI APEL PAREKRAF</a></h1>
                    <p class="site-description">Sistem Aplikasi Pelatihan Pariwisata dan Ekonomi Kreatif</p>
                </div>
                <img width="150" src="<?= BASE_URL ?>images/cinta.png" class="custom-logo-bangga" alt="Bangga " decoding="async" fetchpriority="high">
            </div>
            <div class="row search-form">
                <div class="col-md-8">
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
                <div class="col-md-4">
                    <form class="form-search" action="<?= BASE_URL ?>home/search" method="GET">
                        <input type="search" class="form-control border-0 input-search" name="keyword" placeholder="Cari Pelatihan...">
                        <button type="submit" class="button-search" >
                            <svg class="svg-icon search-icon" aria-labelledby="title desc" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7"><title id="title">Search Icon</title><desc id="desc">A magnifying glass icon.</desc><g class="search-path" fill="none" stroke="#848F91"><path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4"/><circle cx="8" cy="8" r="7"/></g></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>