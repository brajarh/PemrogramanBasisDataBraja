<?php
// config/entities.php
// Definisi tabel master: nama tabel, primary key, query daftar, dan field formulir.
// Nama tabel/kolom di sini mengikuti elkap.sql. Jika SQL berubah, cukup sesuaikan file ini.

$aktif = ['1' => 'Aktif', '0' => 'Nonaktif'];

return [

    'satuan' => [
        'judul'  => 'Satuan',
        'tabel'  => 'SATUAN',
        'pk'     => 'idsatuan',
        'daftar' => 'SELECT idsatuan, namaSatuan, status FROM SATUAN ORDER BY idsatuan',
        'kolom'  => [['idsatuan', 'ID'], ['namaSatuan', 'Nama satuan'], ['status', 'Status', 'status']],
        'field'  => [
            'namaSatuan' => ['label' => 'Nama satuan', 'tipe' => 'text', 'wajib' => true, 'panjang' => 45],
            'status'     => ['label' => 'Status', 'tipe' => 'select', 'wajib' => true, 'opsi' => $aktif],
        ],
    ],

    'produk' => [
        'judul'  => 'Produk',
        'tabel'  => 'PRODUK',
        'pk'     => 'idProduk',
        'daftar' => 'SELECT p.idProduk, p.namaProduk, p.jenis, s.namaSatuan, p.harga, p.status
                     FROM PRODUK p JOIN SATUAN s ON p.idsatuan = s.idsatuan ORDER BY p.idProduk',
        'kolom'  => [['idProduk', 'ID'], ['namaProduk', 'Nama produk'], ['jenis', 'Jenis'],
                     ['namaSatuan', 'Satuan'], ['harga', 'Harga', 'rupiah'], ['status', 'Status', 'status']],
        'field'  => [
            'namaProduk' => ['label' => 'Nama produk', 'tipe' => 'text', 'wajib' => true, 'panjang' => 45],
            'jenis'      => ['label' => 'Jenis (1 karakter)', 'tipe' => 'text', 'wajib' => false, 'panjang' => 1],
            'idsatuan'   => ['label' => 'Satuan', 'tipe' => 'select', 'wajib' => true,
                             'opsi' => "SELECT idsatuan, CONCAT(namaSatuan, IF(status = 1, '', ' (nonaktif)'))
                                        FROM SATUAN ORDER BY namaSatuan"],
            'harga'      => ['label' => 'Harga (Rp)', 'tipe' => 'number', 'wajib' => true, 'bulat' => true, 'min' => 0],
            'status'     => ['label' => 'Status', 'tipe' => 'select', 'wajib' => true, 'opsi' => $aktif],
        ],
    ],

    'vendor' => [
        'judul'  => 'Vendor',
        'tabel'  => 'VENDOR',
        'pk'     => 'idvendor',
        'daftar' => "SELECT idvendor, nama_vendor, IF(badan_hukum = '1', 'Badan hukum', 'Non badan hukum') AS bentuk, status
                     FROM VENDOR ORDER BY idvendor",
        'kolom'  => [['idvendor', 'ID'], ['nama_vendor', 'Nama vendor'], ['bentuk', 'Bentuk usaha'], ['status', 'Status', 'status']],
        'field'  => [
            'nama_vendor' => ['label' => 'Nama vendor', 'tipe' => 'text', 'wajib' => true, 'panjang' => 100],
            'badan_hukum' => ['label' => 'Bentuk usaha', 'tipe' => 'select', 'wajib' => true,
                              'opsi' => ['1' => 'Badan hukum', '0' => 'Non badan hukum']],
            'status'      => ['label' => 'Status', 'tipe' => 'select', 'wajib' => true, 'opsi' => $aktif],
        ],
    ],

    'role' => [
        'judul'  => 'Role',
        'tabel'  => 'ROLE',
        'pk'     => 'idrole',
        'daftar' => 'SELECT idrole, nama_role FROM `ROLE` ORDER BY idrole',
        'kolom'  => [['idrole', 'ID'], ['nama_role', 'Nama role']],
        'field'  => [
            'nama_role' => ['label' => 'Nama role', 'tipe' => 'text', 'wajib' => true, 'panjang' => 100],
        ],
    ],

    'user' => [
        'judul'  => 'User',
        'tabel'  => 'USER',
        'pk'     => 'iduser',
        'daftar' => 'SELECT u.iduser, u.username, r.nama_role
                     FROM `USER` u LEFT JOIN `ROLE` r ON u.idrole = r.idrole ORDER BY u.iduser',
        'kolom'  => [['iduser', 'ID'], ['username', 'Username'], ['nama_role', 'Role']],
        'field'  => [
            'username' => ['label' => 'Username', 'tipe' => 'text', 'wajib' => true, 'panjang' => 45, 'unik' => true],
            'password' => ['label' => 'Password (saat ubah, kosongkan jika tidak diganti)', 'tipe' => 'password'],
            'idrole'   => ['label' => 'Role', 'tipe' => 'select', 'wajib' => true,
                           'opsi' => 'SELECT idrole, nama_role FROM `ROLE` ORDER BY nama_role'],
        ],
    ],

    'margin' => [
        'judul'       => 'Margin Penjualan',
        'tabel'       => 'MARGIN_PENJUALAN',
        'pk'          => 'idmargin_penjualan',
        'daftar'      => 'SELECT m.idmargin_penjualan, m.persen, u.username, m.status, m.created_at, m.updated_at
                          FROM MARGIN_PENJUALAN m LEFT JOIN `USER` u ON m.iduser = u.iduser
                          ORDER BY m.idmargin_penjualan',
        'kolom'       => [['idmargin_penjualan', 'ID'], ['persen', 'Margin', 'persen'], ['username', 'Dibuat oleh'],
                          ['status', 'Status', 'status'], ['created_at', 'Dibuat'], ['updated_at', 'Diubah']],
        'field'       => [
            'persen' => ['label' => 'Margin (%)', 'tipe' => 'number', 'wajib' => true, 'min' => 0, 'maks' => 100],
            'iduser' => ['label' => 'Dibuat oleh', 'tipe' => 'select', 'wajib' => true,
                         'opsi' => 'SELECT iduser, username FROM `USER` ORDER BY username'],
            'status' => ['label' => 'Status', 'tipe' => 'select', 'wajib' => true, 'opsi' => $aktif],
        ],
        // Kolom waktu tidak punya DEFAULT di SQL, jadi diisi di sini.
        'saat_tambah' => ['created_at' => 'NOW()', 'updated_at' => 'NOW()'],
        'saat_ubah'   => ['updated_at' => 'NOW()'],
    ],
];
