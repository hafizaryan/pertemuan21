<?php
session_start();


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
//$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id ASC"); 
//ASC dari kecil ke besar sedangkan DECS dari besar ke kecil
$mahasiswa = query("SELECT * FROM mahasiswa ");

//tombol cari ditekan 
if (isset($_POST["cari"])) {
    $mahasiswa = $mahasiswa = cari($_POST["keyword"]);
} else {
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Halaman Admin</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 140px;
            left: 250px;
            z-index: -1;
            display: none;
        }
        @media print {
            .logout,
            .tambah,
            .form-cari,
            .aksi {
                display: none;
            }
            @media print {}
        }
    </style>
</head>

<body>
    <a href="logout.php" class="logout"> logout </a> | <a href="cetak.php" target="_blank">Cetak</a>
    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php" class="tambah">Tambah data mahasiswa </a>
    <br><br>
    <form action="" method="post" class="form-cari">
        <input type="text" name="keyword" size="35" autofocus placeholder="Masukkan keyword pencarian" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>
        <img src="img/loader.gif" class="loader">
    </form>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th class="aksi">Aksi</th>
                <th>gambar</th>
                <th>Nama</th>
                <th>Nrp</th>
                <th>email</th>
                <th>jurusan</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td class="aksi">
                        <a href="ubah.php?id=<?= $row["id"]; ?>" onclick=" return confirm('yakin?');">Ubah</a> ||
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick=" return confirm('yakin?');">Hapus</a>
                    </td>
                    <td><img src="img/<?= $row["gambar"]; ?>" width="80"></td>
                    <td><?= $row["Nama"]; ?> </td>
                    <td><?= $row["Nrp"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["Jurusan"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>