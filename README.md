# Elkap Admin — Read-only

Interface PHP + MySQL/PDO untuk melihat data dari database `elkap`. Desain admin Bootstrap-inspired menggunakan Bootstrap 5 CDN.

## Batasan yang disengaja

- Tidak ada fitur tambah, edit, atau hapus.
- Tidak ada query `INSERT`, `UPDATE`, atau `DELETE` di kode interface.
- Query di `config/read_views.php` dibatasi pada `SELECT * FROM` untuk tabel dan VIEW yang sudah tertulis dalam `elkap.sql` yang dikirim pengguna.
- Interface tidak membuat, mengubah, atau memperbaiki tabel maupun VIEW.
- `V_PRODUK` tidak ditampilkan karena definisinya pada sumber SQL belum lengkap (`CREATE VIEW V_PRODUK` tanpa `AS SELECT ...`).
- Jika sebuah VIEW gagal dibuat saat impor SQL, halaman VIEW tersebut akan menampilkan pesan bahwa objek belum tersedia.

## Menjalankan

1. Pastikan MySQL aktif dan database `elkap` sudah dibuat.
2. Impor file `elkap.sql` milikmu sendiri melalui phpMyAdmin atau alat MySQL yang biasa kamu pakai. Interface ini tidak menyertakan atau mengubah file SQL tersebut.
3. Sesuaikan `config/database.php` jika username/password MySQL-mu berbeda.
4. Letakkan folder ini di document root web server, atau jalankan dari folder proyek:
   `php -S localhost:8000`
5. Buka `http://localhost:8000`.

## Tabel master yang ditampilkan

`PRODUK`, `SATUAN`, `VENDOR`, `ROLE`, `USER`, `MARGIN_PENJUALAN`.

## VIEW yang ditampilkan

`Product`, `stokproduk`, `pengadaanDetail`, `V_USER`, `V_VENDOR`, `V_satuan`.

Daftar ini mengikuti nama VIEW yang tertulis di `elkap.sql`. Keberhasilan menampilkan data bergantung pada apakah definisi VIEW terkait berhasil dijalankan di database.

## Bagian yang perlu kamu lengkapi/periksa sendiri

- Periksa hasil impor `elkap.sql` dan pastikan tabel/VIEW yang ingin ditampilkan benar-benar ada.
- Beberapa statement dalam SQL sumber terlihat belum lengkap atau mungkin gagal, jadi jangan menganggap semua VIEW otomatis berhasil dibuat.
- Query yang dipakai untuk menampilkan tabel adalah bentuk `SELECT * FROM ...` yang sudah ada pada SQL sumber. Jika kamu ingin menambah halaman atau mengubah query, tulis query itu sendiri sesuai aturan dosen.
