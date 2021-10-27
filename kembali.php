<?php
if($_GET['id']){
    include "koneksi.php";

    //melakukan query bedasarkan id peminjaman yang dikirim
    $id_peminjaman_buku = $_GET['id']; //jangan ubah variabel disamping karena akan digunakan untuk query di akhir
    $cek_terlambat = mysqli_query($conn, "select * from peminjaman_buku where id_peminjaman = '$id_peminjaman_buku'");
    $dt_pinjam = mysqli_fetch_array($cek_terlambat);

    var_dump($dt_pinjam);

    
    // strtotime => mengubah tipe data string ke time
    //cek apakah pengembalian terlambat
    if(strtotime($dt_pinjam['tanggal_kembali']) >= strtotime(date('Y-m-d'))){
        $denda = 0;

    } else{
        $harga_denda_perhari = 5000;
        $tanggal_kembali = new DateTime();
        $tgl_harus_kembali = new DateTime($dt_pinjam['tanggal_kembali']);
        $selisih_hari = $tanggal_kembali->diff($tgl_harus_kembali)->d;
        $denda = $selisih_hari*$harga_denda_perhari;
    }

    //melakukan qery untuk memasukan nilai denda dan tanggal pengembalian
    mysqli_query($conn, "insert into pengembalian_buku
    (id_peminjaman, tanggal_pengembalian,denda)
    value('".$id_peminjaman_buku."','".date('Y-m-d')."','".$denda."')");
    
    echo mysqli_affected_rows($conn);

    //cek keberhasilan insert data
    
    
    if(mysqli_affected_rows($conn) >= 1){
        echo "<script> alert('berhasil mengembalikan buku');
            document.location.href = 'history_peminjaman.php'
            </script>";
    }else{
        echo "<script> alert('gagal mengembalikan buku');
            document.location.href = 'history_peminjaman.php'
            </script>";
    }
    
//document.location.href = 'history_peminjaman.php'
    
}
?>