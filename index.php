<?php
require("mysql_connection.php");
require("global_vars.php");
$conn = getDBConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Artikel | Beranda</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Daftar Artikel</h1>
    <?php
    $sql = "SELECT * FROM artikel";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <div class="article-item">
        <h3 class="article-item-title"><a href="<?php echo "show.php?id={$row['id']}"; ?>"><?php echo $row["judul"]; ?></a></h3>
        <p class="article-item-detail">
            <span>Penulis: <strong><?php echo $authors[$row["penulis"]]; ?></strong></span>
            <span style="margin-left: 10px;"><i>Dibuat: <?php echo $row["dibuat"]; ?></i></span>
            <span style="margin-left: 10px;"><i>Diupdate: <?php echo $row["diupdate"]; ?></i></span>
        </p>
    </div>
    <?php
        }
    } else {
        echo "<p>Belum ada artikel.</p>";
    }
    ?>
    <a class="btn" href="create.php">Tambah</a>
</body>
</html>

<?php closeConnection($conn); ?>
