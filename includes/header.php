<?php
// includes/header.php — kerangka atas halaman. Butuh variabel: $judul, $base, $kodeAktif (opsional).
$base      = $base ?? '../';
$kodeAktif = $kodeAktif ?? '';
?><!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($judul) ?> — Toko PBD</title>
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>
<nav>
    <a class="merek" href="<?= $base ?>index.php">Toko PBD</a>
    <?php foreach (semua_entitas() as $k => $e): ?>
        <a href="<?= $base . $k ?>/index.php"<?= $k === $kodeAktif ? ' class="aktif"' : '' ?>><?= h($e['judul']) ?></a>
    <?php endforeach; ?>
</nav>
<main>
    <h1><?= h($judul) ?></h1>
    <?php tampil_flash(); ?>
