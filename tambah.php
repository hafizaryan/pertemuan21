<?php
session_start();

if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';
//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"]) ) { 

    //gunakan var_dump( $_FILE ); untuk melihat susunan array pada file 
    //var_dump( $_POST );  
   // var_dump( $_FILES ); 
    //die;
    
    
    //cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST)>0){
         echo "<script> 
         alert('Data Berhasil Ditambahkan'); 
         document.location.href = 'index.php'; 
         </script>"; 
        }else{ 
            echo"<script> 
            alert('Data Gagal Ditambahkan'); 
            document.location.href = 'index.php'; 
            </script>";}
        }           
?>
<!DOCTYPE html>
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah data mahasiswa</title>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>

 <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="Nama">Nama : </label>
                <input type="text" name="Nama" id="Nama" required></input>
            </li>
            <li>
                <label for="Nrp">Nrp : </label>
                <input type="text" name="Nrp" id="Nrp" required></input>
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required></input>
            </li>
            <li>
                <label for="Jurusan">Jurusan : </label>
                <input type="text" name="Jurusan" id="Jurusan" required></input>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar" required></input>
            </li>
            <li>
            <button type="submit" name="submit">SUBMIT</button>
            </li>
     </ul>
</form>
    
</body>
</html>