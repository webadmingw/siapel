<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$base_url = $protocol . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
 
define('BASE_URL', str_replace("public/", "", $base_url));
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', 'admins');
define('DB_NAME', 'siapel');
