<?php
require("mysql_connection.php");
$conn = getConnection();

$sql_create_db = "CREATE DATABASE {$dbname}";
if ($conn->query($sql_create_db)) {
    echo "Berhasil membuat database: {$dbname}\n";
} else {
    die("Gagal membuat database: {$conn->error}\n");
}
$conn->select_db($dbname);

$sql_create_table = "CREATE TABLE artikel(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    subjudul VARCHAR(150),
    ringkasan TINYTEXT,
    isi TEXT NOT NULL,
    penulis VARCHAR(20) NOT NULL,
    gambar VARCHAR(50),
    dibuat TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    diupdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql_create_table)) {
    echo "Berhasil membuat tabel artikel\n";
} else {
    die("Gagal membuat tabel: {$conn->error}\n");
}
closeConnection($conn);
