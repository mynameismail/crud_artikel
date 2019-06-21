<?php
require("mysql_connection.php");
require("global_vars.php");
$conn = getDBConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $subjudul = $_POST["subjudul"];
    $ringkasan = $_POST["ringkasan"];
    $isi = $_POST["isi"];
    $penulis = $_POST["penulis"];
    $gambar = "";

    if ($_FILES["gambar"]["name"] != "") {
        $temp = explode(".", basename($_FILES["gambar"]["name"]));
        $newfilename = date('dmYHis') . "." . $temp[count($temp) - 1];
        $target_file = $images_dir . $newfilename;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        $gambar = $newfilename;
    }
    
    $sql = "INSERT INTO artikel (judul, subjudul, ringkasan, isi, penulis, gambar)
        VALUES ('{$judul}', '{$subjudul}', '{$ringkasan}', '{$isi}', '{$penulis}', '{$gambar}')";
    if ($conn->query($sql)) {
        echo "<script>window.alert('Berhasil menambahkan artikel.');
            window.location.href='/';</script>";
    } else {
        echo "Gagal menambahkan artikel: {$conn->error}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Artikel | Tambah</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Tambah Artikel</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <label>Judul</label>
        <input type="text" name="judul" size="100" maxlength="200" required>
        <label>Subjudul</label>
        <input type="text" name="subjudul" size="100" maxlength="150">
        <label>Ringkasan</label>
        <textarea name="ringkasan" rows="5" cols="100"></textarea>
        <label>Isi</label>
        <textarea name="isi" rows="15" cols="100" required></textarea>
        <label>Penulis</label>
        <select name="penulis" required>
        <?php
        foreach ($authors as $key => $value) {
            echo "<option value='{$key}'>{$value}</option>";
        }
        ?>
        </select>
        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*">
        <button class="btn" type="submit">Tambah</button>
    </form>
</body>
</html>

<?php closeConnection($conn); ?>
