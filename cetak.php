<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
<h1>Daftar Mahasiswa</h1>
<table border="1" cellpadding="10" cellspacing="0">

<tr>
    <th>No.</th>
    <th>gambar</th>
    <th>Nama</th>
    <th>Nrp</th>
    <th>email</th>
    <th>jurusan</th>
</tr>';


$i = 1;
    foreach ($mahasiswa as $row ){
        $html .= '<tr>
        <td>'. $i++ .'</td>
        <td><img src="img/'. $row["gambar"] .'" width="55" ></td>
        <td>'. $row["Nama"] .'</td>
        <td>'. $row["Nrp"] .'</td>
        <td>'. $row["email"] .'</td>
        <td>'. $row["Jurusan"] .'</td>
        </tr>';
    }

$html .=    '</table>
    
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output("Daftar-mahasiswa.pdf", 'I');
?>
