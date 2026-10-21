<?php
/*
 * READ-ONLY: query di bawah dibatasi pada SELECT * FROM yang sudah tertulis
 * di elkap.sql milik pengguna. Jangan menambah query tanpa menulisnya sendiri
 * dan mengikuti aturan dosen.
 */
return [
    'tables' => [
        'PRODUK' => ['label' => 'Produk', 'sql' => 'SELECT * FROM PRODUK'],
        'SATUAN' => ['label' => 'Satuan', 'sql' => 'SELECT * FROM SATUAN'],
        'VENDOR' => ['label' => 'Vendor', 'sql' => 'SELECT * FROM VENDOR'],
        'ROLE' => ['label' => 'Role', 'sql' => 'SELECT * FROM `ROLE`'],
        'USER' => ['label' => 'User', 'sql' => 'SELECT * FROM USER'],
        'MARGIN_PENJUALAN' => ['label' => 'Margin Penjualan', 'sql' => 'SELECT * FROM MARGIN_PENJUALAN'],
    ],
    'views' => [
        'Product' => ['label' => 'Product', 'sql' => 'SELECT * FROM product', 'note' => 'VIEW dibuat pada elkap.sql.'],
        'stokproduk' => ['label' => 'Stok Produk', 'sql' => 'SELECT * FROM stokproduk', 'note' => 'Hasil dapat kosong jika KARTU_STOK belum memiliki data.'],
        'pengadaanDetail' => ['label' => 'Detail Pengadaan', 'sql' => 'SELECT * FROM pengadaanDetail', 'note' => 'Memerlukan VIEW berhasil dibuat di database.'],
        'V_USER' => ['label' => 'User (VIEW)', 'sql' => 'SELECT * FROM V_USER', 'note' => 'Definisi VIEW mengikuti elkap.sql apa adanya.'],
        'V_VENDOR' => ['label' => 'Vendor (VIEW)', 'sql' => 'SELECT * FROM V_VENDOR', 'note' => 'VIEW menampilkan kolom vendor yang ditulis pada elkap.sql.'],
        'V_satuan' => ['label' => 'Satuan (VIEW)', 'sql' => 'SELECT * FROM V_satuan', 'note' => 'VIEW menampilkan kolom satuan yang ditulis pada elkap.sql.'],
    ],
];
