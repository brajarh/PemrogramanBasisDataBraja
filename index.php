<?php
// index.php — beranda: tautan ke pengelolaan tiap tabel master.
require __DIR__ . '/includes/crud.php';

$judul = 'Data master';
$base  = '';

include __DIR__ . '/includes/header.php'; ?>
<div class="menu">
<?php foreach (semua_entitas() as $kode => $e):
    try {
        $jumlah = db()->query('SELECT COUNT(*) FROM ' . q($e['tabel']))->fetchColumn() . ' data';
    } catch (PDOException $ex) {
        $jumlah = 'tabel belum bisa dibaca';
    } ?>
    <a href="<?= h($kode) ?>/index.php"><b><?= h($e['judul']) ?></b><span><?= h($jumlah) ?></span></a>
<?php endforeach; ?>
</div>
<?php include __DIR__ . '/includes/footer.php';
