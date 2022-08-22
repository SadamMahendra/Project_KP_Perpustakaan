<?php
 include 'koneksi.php';
 include 'cekSesi.php';

 function query($query){

  global $conn;

  $result = mysqli_query($conn, $query);
  $datas  = [];

  while($data = mysqli_fetch_assoc($result)) {

    $datas[] = $data;
  }
  return $datas;
}

$users = query("SELECT id_anggota FROM anggota;");
$buku = query("SELECT id_buku FROM buku");
$pinjam = query("SELECT id_peminjam FROM peminjam WHERE status='dipinjam'");
$totalpeminjam = query("SELECT id_peminjam FROM peminjam");
$popular = query("SELECT COUNT(judul_buku), judul_buku as jdl_buku FROM peminjam GROUP BY judul_buku ORDER BY jdl_buku;");
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

    <title>Dashboard</title>
  </head>
  <body>
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
              <img src="img/user.png" alt="" width="90" /><br />Halo, <?= $_SESSION['username']; ?>
              <hr />
            </li>

            <li class="nav-item mb-2">
              <a
                class="nav-link active text-white"
                aria-current="page"
                href="Dashboard.php"
                ><i class="fa-solid fa-gauge"></i>&nbsp; Dashboard</a
              >
              <!-- <hr class="bg-secondary" />  -->
            </li>
            

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="Anggota.php"
                ><i class="fa-solid fa-user-graduate"></i>&nbsp; Anggota</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="Buku.php"
                ><i class="fa-solid fa-book"></i>&nbsp; Buku</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="Peminjam.php"
                ><i class="fa-solid fa-book-open-reader"></i>&nbsp; Peminjam</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="historyPeminjam.php"
                ><i class="fa-solid fa-clock-rotate-left"></i>&nbsp; History Peminjam</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="booking.php"
                ><i class="fa-solid fa-receipt"></i>&nbsp; booking</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <?php
            if ($_SESSION['level'] == 'admin') { ?>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="DataUser.php"
                ><i class="fa-solid fa-user"></i>&nbsp; User</a>
              <!-- <hr class="bg-secondary" /> -->
            </li>
            <?php } ?>

            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="logoutModal.php" onclick="return confirm('ingin keluar?')"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp; Logout </a>
              <!-- <hr class="bg-secondary" /> -->
            </li>
          </ul>
        </div>
        <!-- bagian content -->
        <div class="col-md-10 p-5" style="margin-left: 250px;">
          <h3><i class="fa-solid fa-gauge"></i>&nbsp; Dashboard</h3>
          <hr />

          <div class="row text-white">
            <div class="card bg-info" style="width: 18rem">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa-solid fa-user-graduate"></i>
                </div>
                <h5 class="card-title">Jumlah Anggota</h5>
                <div class="display-4"><?php echo count($users); ?></div>
                <a href="Anggota.php " class="card-link text-white"
                  ><p class="card-text">
                    Lihat Detail <i class="fa-solid fa-angles-right"></i></p
                ></a>
              </div>
            </div>

            <div class="card bg-danger" style="width: 18rem">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa-solid fa-book"></i>
                </div>
                <h5 class="card-title">Jumlah Buku</h5>
                <div class="display-4"><?php echo count($buku); ?></div>
                <a href="Buku.php" class="card-link text-white"
                  ><p class="card-text">
                    Lihat Detail <i class="fa-solid fa-angles-right"></i></p
                ></a>
              </div>
            </div>

            <div class="card bg-success" style="width: 18rem">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa-solid fa-book-open-reader"></i>
                </div>
                <h5 class="card-title">Jumlah Peminjam</h5>
                <div class="display-4"><?php echo count($pinjam); ?></div>
                <a href="Peminjam.php" class="card-link text-white"
                  ><p class="card-text">
                    Lihat Detail <i class="fa-solid fa-angles-right"></i></p
                ></a>
              </div>
            </div>
<!-- 
            <div class="card bg-success mt-4" style="width: 18rem">
              <div class="card-body">
                <div class="card-body-icon">
                </div>
                <h5 class="card-title">Buku Terpopuler</h5>
                <div><?= $popular[0]["jdl_buku"] ?></div>
              </div>
            </div> -->

            <div class="card bg-warning mt-4" style="width: 18rem">
              <div class="card-body">
                <div class="card-body-icon">
                </div>
                <h5 class="card-title">Total Peminjam</h5>
                <div><?php echo count($totalpeminjam); ?></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    
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
  </body>
</html>
