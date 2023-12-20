//console.log('ok');

//ambil dulu elemen2 yang dibutuhkan
//var keyword = document.getElementById('keyword');
//var tombolcari = document.getElementById('tombol-cari');
//var container = document.getElementById('container');

///tombolcari.addEventListener('click', function() {
    //alert('berhasil !');

// tambahkan event ketika keyword ditulis
//keyword.addEventListener('keyup', function() {
    //console.log(keyword.value);

    //buat object ajax
    //var xhr = new XMLHttpRequest();

    //cek kesiapan ajax
    //xhr.onreadystatechange = function() {
        //if (xhr.readyState == 4 && xhr.status == 200) {
           //container.innerHTML = xhr.responseText;
        //}
    //}

    //eksekusi ajax
    //xhr.open('GET', 'ajax/coba.txt=', true);
    // xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
   // xhr.send();


//});

$(document).ready(function(){
    //hilangkan tombol search
    $('#tombol-cari').hide();

    //event ketika keyword di tulis
    $('#keyword').on('keyup',function(){
        //munculkan icon loading
        $('.loader').show();
        //ajax menggunakan load
        // $('#container').load('ajax/mahasiswa.php?keyword='+$('#keyword').val());

        //$.get()
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(),function(data){
            $('#container').html(data);
            $('.loader').hide();
        });

    });

});