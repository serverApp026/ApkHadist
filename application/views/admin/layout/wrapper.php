<?php
//proteksi halaman admin dengan fungsi cek login yang ada di simple login
$this->simple_pelanggan->cek_loginAdmin();
//menggabungkan semua bagian layout menjadi satu
require_once('head.php');
require_once('header.php');
require_once('nav.php');
require_once('content.php');
require_once('footer.php');

?>