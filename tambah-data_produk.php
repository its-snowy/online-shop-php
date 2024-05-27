<?php
include_once("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form action="tambah_data_produk_proces.php" method="POST">
        <label for="">Nama Produk</label>
        <input type="text" name="nama">
        <br>
        <label for="">Harga</label>
        <input type="number" name="harga" id="harga">
        <br>
        <button name="submit" id="submit">TAMBAH</button>
    </form>
</body>
</html>