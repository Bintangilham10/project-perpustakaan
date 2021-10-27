<?php
/*
include "koneksi.php";
$cart = $_SESSION['cart'];

if(count($cart) > 0){
    //menentukan tanggal lama pinjam
    $lamapinjam = 5;

    //membuat waktu tanggal kembali
    $tgl_harus_kembali = date('Y-m-d',mktime(0,0,0,date('m'),(date('d')+$lama_pinjam),date('Y')));
    $tgl_pinjam = date("Y-m-d");
    //menentukan kaplpan dipinjam dan kapan harus dikembalikan setiap buku
    foreach($cart as $cartc){
        $nmbuku = $cartc['nama_buku'];

        //mengquery tabel history
        //status > 1 artinya masih dipinjam
        mysqli_query($conn, "INSERT INTO history VALUES 
        ('', '$nmbuku', '$tgl_pinjam', '$tgl_harus_kembali', 1)");
    }

    if(mysql_affected_rows($conn) > 0){
        echo"<script>alert('data berhasil dimasukan')</script>";
    }else{
        echo"<script>alert('data gagal dimasukan')</script>";
    }

    unset($_SESSION['cart']);
}
*/
?>

<?php

session_start();
include "koneksi.php";
$cart = $_SESSION['cart'];

    if(count($cart)>0){
    $lama_pinjam = 5; //satuan hari

    //membuat hari kembali
    $tgl_harus_kembali = date('Y-m-d',mktime(0,0,0,date('m'),(date('d')+$lama_pinjam),date('Y')));

    
    //menginset data ke tabel peminjamn_buku => untuk id peminjaman dan tanggal
    mysqli_query($conn,"INSERT INTO peminjaman_buku(id_siswa,tanggal_pinjam,tanggal_kembali)
    VALUES('".$_SESSION['id_siswa']."','".date('Y-m-d')."','".$tgl_harus_kembali."')");
    

    //menginsert data ke tabel detail_peminjaman_buku => untuk detail peminjaman
    $id = mysqli_insert_id($conn);
    

    foreach ($cart as $key_produk => $val_produk) {

        // var_dump($val_produk['qty']);

        //memasukan setiap array ke variabel suapay lebih mudah digunakan
        $id_buku = $val_produk['id_buku'];
        $jml_buku = $val_produk['qty'];

        //melakukan query ke db
        mysqli_query($conn, "INSERT INTO detail_peminjaman_buku(id_peminjaman, id_buku, qty)
        VALUES('$id','$id_buku','$jml_buku')");

        //cek keberhasilan query
        if (mysqli_affected_rows($conn) < 1){
            echo '<script>
            alert("Anda gagal meminjam buku");
            </script>';
        }
    }
    unset($_SESSION['cart']);



    
    echo '<script>
    alert("Anda berhasil meminjam buku");
    location.href="history_peminjaman.php"
    </script>';
    }
    
?>

<?php
/* == membuat tabel untuk history peminjaman ==
CREATE TABLE peminjaman_buku(
    id_peminjaman int(11),
    id_siswa int(11),
    tanggal_pinjam varchar(30),
    tanggal_kembali varchar(30),
    primary key(id_peminjaman)
);

CREATE TABLE detail_peminjaman_buku(
    id_peminjaman int(11),
    id_buku int(11),
    qty int(30)
);
*/
?>