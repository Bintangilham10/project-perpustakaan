<?php
    
//tes error
// if(isset($_FILES['gambar_buku'])){
//     var_dump($_FILES);
//     die;
// }

//>>>> function untuk upload gambar <<<<
function upload(){

    $nmfile = $_FILES['gambar_buku']['name'];
    $ukuran = $_FILES['gambar_buku']['size'];
    $error = $_FILES['gambar_buku']['error'];
    $tmpname = $_FILES['gambar_buku']['tmp_name']; //<-- tempat penyimpanan sementara

    //cek apakah ada gambar yang di upload (4 = tdk ada gambar)
    if($error === 4){
        echo "<script> alert('tdk ada gambar')</script>";
        return false;
    }

    //cek apakah yang diupload gamabr dg ekstensi yg benar
    $ekstensivalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $nmfile); //<- memisahkan nama file dengan ekstensi
    $ekstensigambar = strtolower(end($ekstensigambar));
    if( !in_array($ekstensigambar, $ekstensivalid)){ //<- method untuk mencari string di array
        echo "<script> alert('bukan gambar')</script>";
        return false;
    }

    //jika lulus maka gambar siap upload (tempat_sementara, tempat_tujuan)
    move_uploaded_file($tmpname, 'buku_img/'.$nmfile);

    //mengembalikan nilai nama file
    return $nmfile;
    
    
    //ini masih sangat sederhana jadi lebih baik lihat tutorial lagi untuk sistem lebih baik
    //<!> gambar dg nama yang sama akan terjadi masalah <!>

}

//cek apakah tombol submit pernah ditekan
if(isset($_POST['tambah_buku'])){
    if(isset($_POST['nama_buku']) && isset($_POST['deskripsi_buku']) && isset($_FILES['gambar_buku'])){
        
        //membua variabel 
        $nmbuku = $_POST['nama_buku'];
        $desbuku = $_POST['deskripsi_buku'];
        //$gbbuku = $_POST['gambar_buku']; <- tdk diperlukan

        

        
        //melakukan upload gambar dan pengecekan apakah gambar sudah terupload
        $gbbuku = upload();
        if(!$gbbuku){
            echo "<script> alert('gagal menambahkan')</script>";
            die;
        }   
        

        //melakukan query untuk menambahkan data
        include "koneksi.php";
        $qry_buku = mysqli_query($conn,"INSERT INTO buku VALUES
        ('', '$nmbuku', '$desbuku', '$gbbuku')");

        //cek keberhasilan query
        if( mysqli_affected_rows($conn) > 0){
            echo "<script> alert('berhasil menambahkan'); 
            document.location.href = 'buku.php'; </script>";
        }else{
            echo "<script> alert('gagal menambahkan')</script>";
        }
        
    }

}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </link>
</head>
<body>
    <h1>Tambah Buku</h1>

    <!--fungsi dari enctype digunakan untuk membuat jalur baru pengiriman khusus $_FILES-->
    <form action="" method="post" enctype="multipart/form-data">
        Nama Buku :
        <input type="text" name="nama_buku" class="form-control">

        Deskripsi Buku : 
        <input type="text" name="deskripsi_buku" class="form-control">

        Gambar Buku :
        <input type="file" name="gambar_buku" class="form-control">

        <button type="tambah" name="tambah_buku" class="btn btn-success">tambah</button>
    </form>
</body>
</html>