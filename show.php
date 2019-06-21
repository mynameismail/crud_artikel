<?php
require("mysql_connection.php");
require("global_vars.php");
$conn = getDBConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["delete_id"]) {
    $id = $_POST["delete_id"];
    
    if ($_POST["gambar"] != "") unlink($images_dir . $_POST["gambar"]);
    
    $sql = "DELETE FROM artikel WHERE id = {$id}";
    if ($conn->query($sql)) {
        echo "<script>window.alert('Berhasil menghapus artikel.');
            window.location.href='/';</script>";
    } else {
        echo "Gagal menghapus artikel: {$conn->error}";
    }
}

$id = $_GET["id"] ? $_GET["id"] : 0;

$sql = "SELECT * FROM artikel WHERE id = {$id}";
$result = $conn->query($sql);
if (!$result) die("<h1>Artikel tidak ditemukan.</h1>");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Artikel | Show</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1 class="article-title"><?php echo $row["judul"]; ?></h1>
    <h3 class="article-subtitle"><?php echo $row["subjudul"]; ?></h3>
    <p class="article-detail">
        <span>Penulis: <strong><?php echo $authors[$row["penulis"]]; ?></strong></span>
        <span style="margin-left: 10px;"><i>Dibuat: <?php echo $row["dibuat"]; ?></i></span>
        <span style="margin-left: 10px;"><i>Diupdate: <?php echo $row["diupdate"]; ?></i></span>
    </p>
    <p class="article-summary"><strong>Ringkasan:</strong> <?php echo $row["ringkasan"]; ?></p>
    <img src="<?php echo "/images/{$row['gambar']}"; ?>" height="200">
    <p class="article-content"><?php echo $row["isi"]; ?></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="delete_id" value="<?php echo $row["id"]; ?>">
        <input type="hidden" name="gambar" value="<?php echo $row["gambar"]; ?>">
        <a class="btn" href="<?php echo "edit.php?id={$row['id']}"; ?>">Edit</a>
        <button class="btn-red" type="submit">Hapus</button>
    </form>
</body>
</html>

<?php closeConnection($conn); ?>
