<?php 
session_start();

if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

//ambil data url
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if ( isset($_POST["submit"]) ) {
    //cek apakah data berhasil diubah atau tidak
    if (ubah($_POST)>0){
        echo "<script>
        alert('Data Berhasil Diubah');
        document.location.href = 'index.php';
        </script>";

    }else{
        echo"<script>
        alert('Data Gagal Diubah');
        document.location.href = 'index.php';
        </script>";}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="Nrp">NRP : </label>
                <input type="text" name="Nrp" id="Nrp" required
                value="<?= $mhs["Nrp"]; ?>">
            </li>
            <li>
                <label for="Nama">Nama : </label>
                <input type="text" name="Nama" id="Nama" required
                value="<?= $mhs["Nama"]; ?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required
                value="<?= $mhs["email"]; ?>">
            </li>
            <li>
                <label for="Jurusan">Jurusan : </label>
                <input type="text" name="Jurusan" id="Jurusan" required
                value="<?= $mhs["Jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $mhs['gambar']; ?>"width="50"><br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">SUBMIT</button>
            </li>
        </ul>
    </form>
</body>
</html>