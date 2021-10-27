<?php
    session_start();
    if(isset($_POST)){
    include "koneksi.php";
    
    $idbuku = $_GET['id_buku'];
    $qry_get_buku = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku = '$idbuku'");

    $dt_buku = mysqli_fetch_array($qry_get_buku);

    $_SESSION['cart'][] = array(
        'id_buku'=> $dt_buku['id_buku'],
        'nama_buku'=> $dt_buku['nama_buku'],
        'qty'=> $_POST['jumlah_pinjam']
    );

    header('location: keranjang.php');
    
}

echo"<script>alert('anda gagal memasukan keranjang')</script>"

/*hanya untuk pengecekan
var_dump($_POST['jumlah_pinjam']);
var_dump($_SESSION['cart']);
session_destroy();
//
*/
?>