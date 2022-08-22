<?php
include 'koneksi.php';
include 'cekSesi.php';
include "prosesCariBuku.php";

function query($query){

  global $conn;

  $result = mysqli_query($conn, $query);
  $datas  = [];

  while($data = mysqli_fetch_assoc($result)) {

    $datas[] = $data;
  }
  return $datas;
}
$waktusekarang = date('Y-m-d', strtotime('now'));
$anggota = query("SELECT * FROM anggota order by nama_anggota asc");
$buku = query("SELECT * FROM buku order by judul_buku asc");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- manggil css -->
    <link rel="stylesheet" type="text/css" href="css/Dashboard.css" />
    <link rel="icon" type="image/png" href="./img/logo_smp_preview_rev_1.png"/>
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />

    <!-- script manggil si font-awesome -->
    <script
      src="https://kit.fontawesome.com/5abd65a6aa.js"
      crossorigin="anonymous"
    ></script>

    <title>Booking</title>
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

    <script type="text/javascript" src="js/Dashboard.js"></script>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
          <img
            src="img/logo_smp.png"
            alt=""
            width="50"
            height="50"
            class="d-inline-block align-text-center"
          />
          <b>PERPUSTAKAAN SMPN 52 BEKASI</b>
        </a>
      </div>
    </nav>

    <!-- sidebar -->
    <div class="sidebar">
      <div class="row no-gutters">
        <!-- bagian sidebar yang isinya menu -->
        <div class="col-md-2 bg-dark mt-2 pr-3 pt-1 sidebar position-fixed" style="width: 15em;">
          <ul class="nav flex-column mb-5 isi_sidebar">
            <!-- logo user -->
            <li class="logo-user">
              <img src="img/user.png" alt="" width="90" /><br />Halo, <?= $_SESSION['nama_anggota']; ?>
              <hr />
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link active text-white" href="dashboard1.php"
                ><i class="fa-solid fa-book"></i>&nbsp; Buku</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="dashboard2.php"
                ><i class="fa-solid fa-receipt"></i>&nbsp; booking</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
            <a class="nav-link text-white" href="logoutModal.php" onclick="return confirm('ingin keluar?')"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp; Logout </a>
              <!-- <hr class="bg-secondary" /> -->
            </li>
          </ul>
        </div>
        <!-- bagian content -->
        <div class="col-md-10 p-5" style="margin-left: 250px;">
          <h3>
          <i class="fa-solid fa-book"></i>&nbsp; Buku
          </h3>
          <hr />
          <!--  -->

          <div class="mb-3">
          <form action="" method="POST" style="margin-left: 113vh; width: 25%" class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Silahkan Cari..." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
            <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          </div>

          <table class="table table-striped table-bordered">
            <!-- bagian atas table -->
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tahun</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <!-- isi table -->
            <tbody>
              <?php
              $query = mysqli_query($conn, "SELECT * FROM buku order by judul_buku asc");
              $no = 1;
              if (isset($_POST["cari"])) {
                $query = cari($_POST["keyword"]);
              }
              while ($data = mysqli_fetch_assoc($query)) {
                  // untuk menghitung selisih hari terlambat
                  $t = $data['jumlah'];
                  if ($t > 0){
                $status = 'tersedia' ;
                }else {
                  $status = 'tidak tersedia' ;
              }
              ?>
              <tr>
                  
                  <th><?= $no++ ?></th>
                  <td><?= $data["kode"] ?></td>
                  <td><?= $data["judul_buku"] ?></td>
                  <td><?= $data["pengarang"] ?></td>
                  <td><?= $data["penerbit"] ?></td>
                  <td><?= $data["tahun_penerbit"] ?></td>
                  <td><?= $data["jumlah"] ?></td>
                  <td><?= $status ?></td>
            </tr>

                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
