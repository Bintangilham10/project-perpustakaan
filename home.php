<?php
    //inport header
    include "header.php";
    $i = date('G');
    if($i < 10){
        $i = "selamat pagi";
    }else if($i < 14){
        $i = "selamat siang";
    }else if( $i < 17){
        $i = "selamat sore";
    }else if($i <= 23){
        $i = "selamat malam";
    }
?>

<h2>Selamat datang <?=$_SESSION['nama_siswa']?> di website Perpus Online.</h2>
<h3><?=$i?></h3>

    
<?php
    //import footer
    include "footer.php";
?>