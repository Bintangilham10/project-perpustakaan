<!DOCTYPE html>
<html>
<head>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </link>

    <title></title>
</head>
<body>
<h3>Tambah Siswa</h3>
    <form action="proses_tambah_siswa.php" method="post">

        nama siswa :
        <input type="text" name="nama_siswa" class="form-control">

        <br>
        Tanggal Lahir :
        <input type="date" name="tanggal_lahir" class="form-control">

        <br>
        Gender :
        <select name="gender" class="form-control">
        <option></option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
        </select>

        Alamat :
        <textarea name="alamat" class="form-control"
        rows="4"></textarea>

        Kelas :
        <select name="id_kelas" class="form-control">
        <option></option>
        <?php
        //melakukan pemanggilan berkas dan membuat variabel yang diisi hasil query
        include "koneksi.php";
        $qry_kelas = mysqli_query($conn,"select * from kelas");

        //untuk setiap hasil query yang di fecth, buatlah option dari hasil tersebut
        while($data_kelas = mysqli_fetch_array($qry_kelas)){
            $idkelas = $data_kelas['id_kelas'];
            $nmkelas = $data_kelas['nama_kelas'];
            echo "<option value='$idkelas'>".$nmkelas."</option>";
        }
        ?>
        </select>

        <br>
        Username :
        <input type="text" name="username" class="form-control">

        <br>
        Password :
        <input type="password" name="password" class="form-control">

        <input type="submit" name="simpan" value="Tambah Siswa" class="btn btn-primary">
    </form>

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous">
    </script>
</body>
</html>