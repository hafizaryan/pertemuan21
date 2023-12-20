<?php 
//cara ambil data mahasiswa dari object result
// mysqli_fetch_row = mengembalikan array numerik
// mysqli_fetch_assoc = mengembalikan array asosiatif
// mysqli_fetch_array = mengembalikan array asosiatif dan numerik
// mysqli_fetch_object = = mengembalikan dengan nama objek

// koneksi ke database
$conn=mysqli_connect("localhost","root","","phpdasar");

function query ($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows=[];
    while ($row= mysqli_fetch_assoc($result) ){ 
        $rows[]=$row;
    } 
    return $rows;
}

function tambah ($data){
    global $conn;
    //ambil data dari setiap form
    $nama = htmlspecialchars($data["Nama"]);
    $nrp = htmlspecialchars($data["Nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["Jurusan"]);


    // $gambar = htmlspecialchars($data["gambar"]);
  
    // upload gambar
    $gambar = upload();
    if( !$gambar ){
        return false;
    }
    
    //query insert data
    $query = "INSERT INTO mahasiswa
                VALUES
                ('','$nama','$nrp','$email','$jurusan', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yang di upload
    if ( $error === 4 ) {
        echo "<script>
            alert('Pilih Gambar Terlebih Dahulu');
            </script>";

        return false;
    }

    // cek apakah yang di upload adalah gambar
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if ( !in_array($ekstensigambar, $ekstensigambarvalid) ) {
        echo "<script>
                alert('Yang Anda Upload Bukan Gambar');
            </script>";
        return false;
    }
    if ($ukuranfile > 10000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar');
            </script>";
        return false;
    }

    $namafilebaru = uniqid();
    $namafilebaru .='.';
    $namafilebaru .= $ekstensigambar;

    //lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmpname, 'img/' .$namafilebaru);
    return $namafilebaru;

}

function hapus ($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM  mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah ($data){
    global $conn;
    //ambil data dari setiap form
    $id = $data["id"];
    $nama = htmlspecialchars($data["Nama"]);
    $nrp = htmlspecialchars($data["Nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["Jurusan"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gambar baru atau lama
    if( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarlama;
    }else{
        $gambar = upload();
    }
    

    $query = "UPDATE mahasiswa SET 
                Nama = '$nama',
                Nrp = '$nrp',
                email = '$email',
                Jurusan = '$jurusan',
                gambar = '$gambar'
            WHERE id = $id
                ";
    
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function cari ($keyword){
    $query = "SELECT * FROM mahasiswa 
                WHERE 
            Nama LIKE '%$keyword%' OR
            Nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            Jurusan LIKE '%$keyword%'
            ";
    return query($query);        
}


function registrasi($data){
    global $conn;
    
    $username = strtolower (stripslashes($data ["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE
    username = '$username'");

    if (mysqli_fetch_assoc($result)){
        echo "<script>
        alert('username yang dipilih sudah terdaftar!')
        </script>";

        return false;
    }

    //cek konfirmasi password
    if( $password !== $password2){
        echo "<script>
        alert('konfirmasi password tidak sesuai!')
        </script>";
        return false;
    }
    //return 1;

    //enkripsi password
    $password = password_hash ($password, PASSWORD_DEFAULT);
    //$password = md5($password);
    //var_dump($password);die;

    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', 
    '$username', '$password')");

    return mysqli_affected_rows($conn);
}

?>