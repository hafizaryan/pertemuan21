<?php 
usleep(500000);

require '../function.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa 
    WHERE 
    Nama LIKE '%$keyword%' OR
    Nrp LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    Jurusan LIKE '%$keyword%'
    ";
$mahasiswa = query($query);

?>

 <table border="1" cellpadding="10" cellspacing="0">
<tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>gambar</th>
        <th>Nama</th>
        <th>Nrp</th>
        <th>email</th>
        <th>jurusan</th>
    </tr>

<?php $i = 1; ?>
<?php foreach( $mahasiswa as $row) :?>
    <tr>
        <td><?= $i; ?></td>
        <td>
        <a href="ubah.php?id=<?= $row["id"]; ?>" onclick=" return confirm('yakin?');">Ubah</a> ||
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick=" return confirm('yakin?');">Hapus</a>
        </td>
        <td><img src="img/<?=  $row ["gambar"]; ?>" 
        width="80"></td>
        <td><?=  $row ["Nama"]; ?> </td>
        <td><?=  $row ["Nrp"]; ?></td>
        <td><?=  $row ["email"]; ?></td>
        <td><?=  $row ["Jurusan"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>