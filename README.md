Aplikasi web sederhana untuk mencatat tanggal, kategori, keterangan, dan nominal pengeluaran mahasiswa. Dibangun dengan CodeIgniter 4, PHP, MySQL/MariaDB, dan Bootstrap 5 menggunakan pola MVC.
Pengembang: Kurrotul A'yun | NIM: 240631100018 | Kelas: Pendidikan Informatika
Fitur utama:
Halaman utama (identitas aplikasi)
Daftar data dari MySQL
Tambah, ubah, dan hapus data (dengan konfirmasi hapus)
Validasi kolom wajib
Pesan notifikasi berhasil tambah / ubah / hapus
Tampilan responsif (Bootstrap 5)

Fitur tambahan:
Dashboard bulanan + grafik donat per kategori
Anggaran bulanan dengan progress bar dan peringatan otomatis
Pencarian, filter kategori/bulan, dan pagination
Ekspor CSV (mengikuti filter)
Proteksi CSRF

Kebutuhan Sistem
PHP 8.1 atau lebih baru, dengan ekstensi intl, mbstring, mysqlnd/mysqli
MySQL atau MariaDB (disarankan XAMPP: Apache + MySQL + phpMyAdmin)
Composer
Koneksi internet (Bootstrap, Bootstrap Icons, dan Chart.js dimuat lewat CDN)

Instalasi:
1. Ekstrak proyek ke C:\xampp\htdocs\dompetku (atau folder lain).
2. Pasang dependensi: 
    cd dompetku
    composer install
3. Nyalakan MySQL di XAMPP Control Panel.
4. Impor database:
    Buka http://localhost/phpmyadmin
    Tab Import -> pilih db_pengeluaran.sql -> Go
    Database db_pengeluaran beserta tabel dan data contoh akan terbentuk.
5. Konfigurasi .env: salin file env menjadi .env, lalu pastikan baris berikut aktif (tanpa #):
    CI_ENVIRONMENT = development
    app.baseURL = 'http://localhost:8080/'
    database.default.hostname = localhost
    database.default.database = db_pengeluaran
    database.default.username = root
    database.default.password =
    database.default.DBDriver = MySQLi
    database.default.port = 3306
6. Sesuaikan username dan password jika MySQL Anda memakai kredensial lain.
7. Jalankan aplikasi: ke terminal kemudian ketik "php spark serve"
