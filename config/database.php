<?php
// config/database.php
// Satu-satunya tempat koneksi database. Semua halaman memanggil db() untuk mendapat objek PDO.

const DB_HOST = '127.0.0.1';
const DB_PORT = '3306';
const DB_NAME = 'elkap';
const DB_USER = 'root';
const DB_PASS = '';

function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false, // prepared statement asli dari MySQL
                ]
            );
        } catch (PDOException $e) {
            error_log($e->getMessage());
            http_response_code(500);
            exit('Koneksi database gagal. Pastikan MySQL berjalan dan periksa pengaturan di config/database.php.');
        }
    }
    return $pdo;
}
