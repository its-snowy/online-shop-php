<?php
include_once("connect.php");
$query = mysqli_query($db, "SELECT * FROM produk");
//$data = mysqli_fetch_array($query);
//var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <style>
        tr,td{
            padding: 10px;
        }
    </style>
</head>
<body>
    <table border="1">
        <tr>
            <td>
                ID
            </td>
            <td>
                Nama
            </td>
            <td>
                Harga
            </td>
            <td>Action</td>
        </tr>
        <?php foreach($query as $d) {?>
            <tr>
                <td><?php echo $d["id"] ?></td>
                <td><?php echo $d["Nama"] ?></td>
                <td><?php echo $d["Harga"] ?></td>
                <td><a href=<?php echo "edit-buku.php?id=" . $d["id"]?>>EDIT</a> | 
                <a href=<?php echo "hapus-buku.php?id=" . $d["id"]?>>HAPUS</a>
            </td>
            </tr>
        
        <?php }    ?>
    </table>
    <br>
    <a href="tambah-data_produk.php">Tambah Data</a>
</body>
</html>