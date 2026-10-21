<?php
require_once __DIR__ . '/includes/functions.php';
$catalog = require __DIR__ . '/config/read_views.php';

$section = (string) ($_GET['section'] ?? '');
$name = (string) ($_GET['name'] ?? '');
$items = $section === 'view' ? $catalog['views'] : $catalog['tables'];
$isListing = in_array($section, ['table', 'view'], true) && isset($items[$name]);
$title = $isListing ? $items[$name]['label'] : 'Dashboard';
$rows = [];
$error = '';

if ($isListing) {
    try {
        // Query dibatasi pada daftar SELECT yang ada di config/read_views.php.
        $rows = db()->query($items[$name]['sql'])->fetchAll();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $error = 'Data belum bisa ditampilkan. Pastikan tabel/VIEW tersedia dan berhasil dibuat dari elkap.sql.';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($title) ?> — Elkap Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="index.php"><span class="brand-mark">E</span><span>Elkap Admin<small>Database viewer</small></span></a>
        <div class="nav-label">OVERVIEW</div>
        <a class="side-link <?= !$isListing ? 'active' : '' ?>" href="index.php"><span class="nav-icon">⌂</span> Dashboard</a>
        <div class="nav-label">TABEL MASTER</div>
        <?php foreach ($catalog['tables'] as $key => $item): ?>
            <a class="side-link <?= $section === 'table' && $name === $key ? 'active' : '' ?>" href="?section=table&amp;name=<?= urlencode($key) ?>">
                <span class="nav-icon">▦</span><?= h($item['label']) ?>
            </a>
        <?php endforeach; ?>
        <div class="nav-label">VIEW DATABASE</div>
        <?php foreach ($catalog['views'] as $key => $item): ?>
            <a class="side-link <?= $section === 'view' && $name === $key ? 'active' : '' ?>" href="?section=view&amp;name=<?= urlencode($key) ?>">
                <span class="nav-icon">◫</span><?= h($item['label']) ?>
            </a>
        <?php endforeach; ?>
        <div class="sidebar-foot"><span class="status-dot"></span> Mode baca saja</div>
    </aside>

    <main class="main-area">
        <header class="topbar">
            <div><span class="text-secondary small">DATABASE / ELKAP</span><div class="fw-semibold">Admin Panel</div></div>
            <span class="badge rounded-pill text-bg-light border px-3 py-2">READ ONLY</span>
        </header>
        <div class="content">
            <?php if (!$isListing): ?>
                <div class="page-heading">
                    <div><div class="eyebrow">OVERVIEW</div><h1>Dashboard</h1><p class="text-secondary mb-0">Lihat data tabel master dan VIEW yang tersedia di database.</p></div>
                </div>
                <div class="alert alert-info border-0 shadow-sm"><strong>Mode read-only.</strong> Interface ini hanya menampilkan data. Tidak ada formulir tambah, edit, atau hapus.</div>
                <div class="section-heading"><h2>Tabel master</h2><span><?= count($catalog['tables']) ?> objek</span></div>
                <div class="row g-3 mb-4">
                    <?php foreach ($catalog['tables'] as $key => $item): ?>
                    <div class="col-12 col-sm-6 col-xl-4">
                        <a class="object-card" href="?section=table&amp;name=<?= urlencode($key) ?>">
                            <span class="object-icon">▦</span><span class="object-text"><strong><?= h($item['label']) ?></strong><small><?= h($key) ?></small></span><span class="object-arrow">↗</span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="section-heading"><h2>VIEW database</h2><span><?= count($catalog['views']) ?> objek</span></div>
                <div class="row g-3">
                    <?php foreach ($catalog['views'] as $key => $item): ?>
                    <div class="col-12 col-sm-6 col-xl-4">
                        <a class="object-card" href="?section=view&amp;name=<?= urlencode($key) ?>">
                            <span class="object-icon view-icon">◫</span><span class="object-text"><strong><?= h($item['label']) ?></strong><small><?= h($key) ?></small></span><span class="object-arrow">↗</span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="small text-secondary mt-4">Catatan: daftar VIEW di atas hanya dapat dibuka jika definisinya berhasil dijalankan pada database MySQL.</div>
            <?php else: ?>
                <div class="page-heading">
                    <div><div class="eyebrow"><?= $section === 'view' ? 'VIEW DATABASE' : 'TABEL MASTER' ?></div><h1><?= h($title) ?></h1><p class="text-secondary mb-0">Data ditampilkan tanpa operasi perubahan.</p></div>
                    <a class="btn btn-outline-secondary" href="index.php">← Dashboard</a>
                </div>
                <?php if ($section === 'view' && !empty($items[$name]['note'])): ?>
                    <div class="alert alert-light border"><?= h($items[$name]['note']) ?></div>
                <?php endif; ?>
                <?php if ($error !== ''): ?>
                    <div class="alert alert-warning"><strong>Belum dapat ditampilkan.</strong> <?= h($error) ?><div class="small mt-2">Periksa sendiri apakah CREATE VIEW terkait berhasil dijalankan di MySQL. Interface ini tidak membuat atau memperbaiki VIEW.</div></div>
                <?php else: ?>
                    <div class="data-panel">
                        <div class="data-panel-head"><div><strong><?= h($title) ?></strong><div class="small text-secondary">Hasil SELECT dari database</div></div><span class="badge text-bg-light border"><?= count($rows) ?> baris</span></div>
                        <?php render_table($rows); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <footer class="page-footer">Elkap Admin <span>•</span> Interface baca saja untuk proyek PBD</footer>
        </div>
    </main>
</div>
</body>
</html>
