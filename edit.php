<?php
require("mysql_connection.php");
require("global_vars.php");
$conn = getDBConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $judul = $_POST["judul"];
    $subjudul = $_POST["subjudul"];
    $ringkasan = $_POST["ringkasan"];
    $isi = $_POST["isi"];
    $penulis = $_POST["penulis"];
    $gambar = "";

    if ($_FILES["gambar"]["name"] != "") {
        if ($_POST["gambar_lama"] != "") unlink($images_dir . $_POST["gambar_lama"]);
        
        $temp = explode(".", basename($_FILES["gambar"]["name"]));
        $newfilename = date('dmYHis') . "." . $temp[count($temp) - 1];
        $target_file = $images_dir . $newfilename;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        $gambar = $newfilename;
    }
    
    $sql_insert = "UPDATE artikel SET 
        judul = '{$judul}',
        subjudul = '{$subjudul}',
        ringkasan = '{$ringkasan}',
        isi = '{$isi}',
        penulis = '{$penulis}'";
    if ($gambar != "") $sql_insert .= ", gambar = '{$gambar}'";

    $sql_insert .= " WHERE id = {$id}";
    // echo $sql_insert;
    if ($conn->query($sql_insert)) {
        echo "<script>window.alert('Berhasil mengedit artikel.');</script>";
    } else {
        echo "Gagal mengedit artikel: {$conn->error}";
    }
}

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$sql_select = "SELECT * FROM artikel WHERE id = {$id}";
$result = $conn->query($sql_select);
if (!$result) die("<h1>Artikel tidak ditemukan.</h1>");
$row = $result->fetch_assoc();
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
    <h1>Edit Artikel</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id={$row['id']}"; ?>" enctype="multipart/form-data">
        <label>Judul</label>
        <input type="text" name="judul" size="100" maxlength="200" value="<?php echo $row["judul"]; ?>" required>
        <label>Subjudul</label>
        <input type="text" name="subjudul" size="100" maxlength="150" value="<?php echo $row["subjudul"]; ?>">
        <label>Ringkasan</label>
        <textarea name="ringkasan" rows="5" cols="100"><?php echo $row["ringkasan"]; ?></textarea>
        <label>Isi</label>
        <textarea name="isi" rows="15" cols="100" required><?php echo $row["isi"]; ?></textarea>
        <label>Penulis</label>
        <select name="penulis" required>
        <?php
        foreach ($authors as $key => $value) {
            $selected = $key == $row["penulis"] ? "selected" : "";
            echo "<option value='{$key}' {$selected}>{$value}</option>";
        }
        ?>
        </select>
        <img src="<?php echo "/images/{$row['gambar']}"; ?>" height="200">
        <label><?php echo $row["gambar"] ? "Ganti" : "Pilih"; ?> Gambar:</label>
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo $row["gambar"] ? $row['gambar'] : ""; ?>">
        <input type="file" name="gambar" accept="image/*">
        <button class="btn" type="submit">Edit</button>
    </form>
</body>
</html>

<?php closeConnection($conn); ?>
