<?php
include 'koneksi.php';
include 'cekSesi.php';
include "prosesCariBooking.php";

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
              <a class="nav-link text-white" href="dashboard1.php"
                ><i class="fa-solid fa-book"></i>&nbsp; Buku</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link active text-white" href="dashboard2.php"
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
          <i class="fa-solid fa-receipt"></i>&nbsp; Booking
          </h3>
          <hr />
          <!--  -->
          <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahTransaksi">
          <i class="fa-solid fa-plus"></i>&nbsp; Booking
          </button>

          <div class="mb-3">
          <form action="" method="POST" style="margin-left: 113vh; width: 25%" class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Silahkan Cari..." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
            <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          </div>

          <!-- Modal tambah user -->
          <div class="modal fade" id="tambahTransaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="tambahTransaksiLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahTransaksiLabel">Pinjam Buku</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php $pinjam = strtotime("now");
                          $pinjam = date('Y-m-d', $pinjam);
                          $tgl_kembali = strtotime("+1 day", strtotime($pinjam));
                          $tgl_kembali = date('Y-m-d', $tgl_kembali); ?>
                <form action="tambahBookingUser.php" method="POST">    
                  <div class="mb-3">
                    <label for="nama_anggota" class="form-label">nama anggota</label>
                    <input class="form-control" name="nama_anggota" value="<?= $_SESSION['nama_anggota']?>_<?= $_SESSION['kelas']?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="judul_buku" multiple class="form-label">Judul Buku</label>
                    <input class="form-control" autocomplete="off" list="datalistOptions2" id="exampleDataList" name="judul_buku" placeholder="Perhatikan ketikan dengan benar" required>
                    <datalist id="datalistOptions2">
                    <?php foreach($buku as $value) : ?>
                        <option value="<?= $value['judul_buku']?>"><?= $value['judul_buku']?></option>
                      <?php endforeach ?>
                  </div>

                  <div class="mb-3">
                    <label for="tgl_booking" class="form-label">Tanggal Booking</label>
                    <input type="date" class="form-control" name="tgl_booking" id="tgl_booking" value="<?= $pinjam ?>" required readonly>
                  </div> 

                  <div class="mb-3">
                    <label for="tgl_batas" class="form-label">Batas Booking</label>
                    <input type="date" class="form-control" name="tgl_batas" id="tgl_batas" value="<?= $tgl_kembali ?>" required readonly>
                  </div> 

                  <input type="hidden" name="status" value="dibooking">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- end modal tambah user -->
          <table class="table table-striped table-bordered" id="myTable">
            <!-- bagian atas table -->
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tingkat</th>
                <th scope="col">Judul buku</th>
                <th scope="col">Tgl Booking</th>
                <th scope="col">Batas Booking</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($conn, "SELECT * FROM booking order by tgl_booking ASC");
              $no = 1;            
              
              if (isset($_POST["cari"])) {
                $query = cari($_POST["keyword"]);
              }
              while ($data = mysqli_fetch_assoc($query)) {
                  $t = $data['tgl_batas'];
                  $n = date('Y-m-d');
                  $status_booking = $data['status'] ;

                if($data['status'] === 'berhasil booking'){
                  $id = $data['id_booking'];

                mysqli_query($conn, "UPDATE booking set status ='$status_booking' where id_booking=$id");
                }else if ($t >= $n){
                  $id = $data['id_booking'];
                  $status_booking = 'dibooking' ;
                  mysqli_query($conn, "UPDATE booking set status ='$status_booking' where id_booking=$id");}
                else {
                $judul_buku  = $data['judul_buku'];

                if ($status_booking !== 'batal booking'){
                  $sid         = mysqli_query($conn,"SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
                  $ibuku       = mysqli_fetch_assoc($sid);
                  $jumlah_buku = $ibuku['jumlah'];
                  $jumlah_buku++;
                  mysqli_query($conn,"UPDATE buku SET jumlah = $jumlah_buku WHERE judul_buku = '$judul_buku'");}

                  $id = $data['id_booking'];
                  $status_booking = 'batal booking';
                  mysqli_query($conn, "UPDATE booking set status ='$status_booking' where id_booking=$id"); 
                }
                ?>
            
            <tr>
                <th><?= $no++  ?></th>
                <td><?= $data["nama_anggota"] ?></td>
                <td><?= $data["kelas"] ?></td>
                <td><?= $data["judul_buku"] ?></td>
                <td><?= $data["tgl_booking"] ?></td>
                <td><?= $data["tgl_batas"] ?></td>
                <td><?php echo $status_booking ?></td>
            </tr>

                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
