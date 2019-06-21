### Setup Aplikasi
1. Ganti nama file "mysql_connection_example.php" menjadi "mysql_connection.php"
2. Pada file "mysql_connection.php", ganti isi variabel $dbhost, $dbuser, $dbpass sesuai server yang digunakan

### Migrasi database (pilih salah satu metode berikut):
- Pada terminal/command prompt, masuk ke direktori aplikasi, kemudian jalankan perintah "php migration.php"
- Buat database di MySQL dengan nama "crud", kemudian import "migration.sql"

### Run Aplikasi
1. Pada terminal/command prompt, masuk ke direktori aplikasi, kemudian jalankan perintah "php -S localhost:8000" (port 8000 dapat diganti ke port lain yang tersedia)
2. Buka browser, kunjungi url "localhost:8000" (port disesuaikan dengan port yang digunakan pada perintah no. 1)
