<?php

include 'koneksi.php';

function query($query){

  global $conn;

  $result = mysqli_query($conn, $query);
  $datas  = [];

  while($data = mysqli_fetch_assoc($result)) {

    $datas[] = $data;
  }
  return $datas;
}
$id     = explode('_',$_POST['nama_anggota'])[0];
$nama   = explode('_',$_POST['nama_anggota'])[1];
$kelas  = explode('_',$_POST['nama_anggota'])[2];
$peminjam = query("SELECT * FROM peminjam where id_peminjam =$id and kelas = '$kelas' and status='dipinjam' or nama_anggota ='$nama' and kelas = '$kelas' and status='dipinjam'");
$tDenda = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- manggil css -->
    <link rel="stylesheet" type="text/css" href="css/Dashboard.css" />

    <link rel="stylesheet" href="fontawesome/css/all.min.css" />

    <link rel="icon" type="image/png" href="./img/logo_smp_preview_rev_1.png"/>

    <!-- script manggil si font-awesome -->
    <script
      src="https://kit.fontawesome.com/5abd65a6aa.js"
      crossorigin="anonymous"
    ></script>

    <title>Laporan</title>
</head>
<body>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <script type="text/javascript" src="js/Dashboard.js"></script>

    <h4 class="mt-5" style="text-align: center;">PERPUSTAKAAN SMPN 52 BEKASI</h4>
    <h6  style="text-align: center;">RT.004/RW.007, Kranji, Kec. Bekasi Barat, Kota Bks, Jawa Barat 17135</h6>
    <h4 style="text-align: center;">Laporan Denda</h4>

    <table class="table table-borderless mx-5 mt-5">

    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Judul Buku</th>
            <th>Denda</th>
            <th>tgl minjam</th>
            <th>tgl kembali</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($peminjam as $value) :?>
            <tr>
                <td><?= $value['nama_anggota'] ?></td>
                <td><?= $value['kelas'] ?></td>
                <td><?= $value['judul_buku'] ?></td>
                <td><?= $value['denda'] ?></td>
                <td><?= $value['tgl_minjam'] ?></td>
                <td><?= $value['tgl_kembali'] ?></td>
            </tr>

            <?php $tDenda+= $value['denda'] ?>

        <?php endforeach ?>
        <tr>
                <td colspan="3" >Total Denda</td>
                <td> <?= $tDenda ?> </td>
            </tr>
    </tbody>
    </table>

    <h6 class="mt-5" style="text-align: center;">Terimakasih Sudah Meminjam Buku</h6>
    <script>window.print()</script>
</body>
</html>