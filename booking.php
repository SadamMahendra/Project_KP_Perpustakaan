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
              <img src="img/user.png" alt="" width="90" /><br />Halo, <?= $_SESSION['username']; ?>
              <hr />
            </li>

            <li class="nav-item mb-2">
              <a
                class="nav-link text-white"
                aria-current="page"
                href="Dashboard.php"
                ><i class="fa-solid fa-gauge"></i>&nbsp; Dashboard</a
              >
              <!-- <hr class="bg-secondary" /> -->
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
              <a class="nav-link active text-white" href="booking.php"
                ><i class="fa-solid fa-receipt"></i>&nbsp; booking</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>
            
            <?php
            if ($_SESSION['level'] == 'admin') { ?>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="DataUser.php"
                ><i class="fa-solid fa-user"></i>&nbsp; User</a
              >
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
          <h3>
          <i class="fa-solid fa-receipt"></i>&nbsp; Booking
          </h3>
          <hr />
          <!--  -->
          <!-- Button trigger modal tambah user-->
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
                <form action="tambahBooking.php" method="POST">    
                  <div class="mb-3">
                    <label for="nama_anggota" class="form-label">nama anggota</label>
                    <input class="form-control" autocomplete="off" list="datalistOptions1" id="exampleDataList" name="nama_anggota" placeholder="Ketikan Nama Anggota" required>
                    <datalist id="datalistOptions1">
                      <?php foreach($anggota as $value) : ?>
                        <option value="<?= $value['nama_anggota']?>_<?= $value['kelas']?>"><?= $value['nama_anggota'] , " ", $value['kelas']?></option>
                      <?php endforeach ?>
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
                <th colspan="3" scope="col">Aksi</th>
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
                  <td>
                    <a href="#" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#prosesEdit<?php echo $data['id_booking']; ?>">
                    Edit</a>
                  </td>
                  <td>
                    <a href="#" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#prosesTerima<?php echo $data['id_booking']; ?>">
                    <i class="fa-solid fa-check"></i></a>
                  </td>
                  <td>
                    <a href="#" type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#prosesGagal<?php echo $data['id_booking']; ?>">
                    <i class="fa-solid fa-x"></i></a>
                  </td>
              </tr>
               <!-- isi modal edit -->
               <div class="modal fade" id="prosesEdit<?php echo $data['id_booking']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="prosesTerimaLabel">Terima</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesEditBooking.php" method="POST">
                          <!--  -->
                          <?php
                          $id_booking = $data['id_booking'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking ='$id_booking'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>
                          <!--  --> 
                          <input type="hidden" name="id_booking" value="<?= $row['id_booking']; ?>">
                          <div class="mb-3">
                            <label for="tgl_batas" class="form-label">Batas Booking</label>
                            <input type="date" class="form-control" name="tgl_batas" id="tgl_batas" value="<?= $row['tgl_batas'] ?>" required>
                          </div> 
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          <?php } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  end modal -->
                  <!-- isi modal Terima -->
                  <div class="modal fade" id="prosesTerima<?php echo $data['id_booking']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="prosesTerimaLabel">Terima</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesTerimaBooking.php" method="POST">
                          <!--  -->
                          <?php
                          $id_booking = $data['id_booking'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking ='$id_booking'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>
                          <!--  --> 
                          <input type="hidden" name="id_booking" value="<?= $row['id_booking']; ?>">
                          <input type="hidden" name="nama_anggota" value="<?= $row['nama_anggota']; ?>">
                          <input type="hidden" name="kelas" value="<?= $row['kelas']; ?>">
                          <input type="hidden" name="judul_buku" value="<?= $row['judul_buku']; ?>">
                          <input type="hidden" name="tgl_batas" value="<?= $row['tgl_batas']; ?>">
                          <input type="hidden" name="status_peminjam" value="dipinjam">
                          <input type="hidden" name="status_booking" value="<?= $row['status']; ?>">
                          <div class="mb-3">
                            Terima Booking ?
                          </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          <?php } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  end modal -->
                <!-- isi modal Gagal -->
                <div class="modal fade" id="prosesGagal<?php echo $data['id_booking']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="prosesGagalLabel">Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesGagalBooking.php" method="POST">
                          <!--  -->
                          <?php
                          $id_booking = $data['id_booking'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking ='$id_booking'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>
                          <!--  --> 
                          <input type="hidden" name="id_booking" value="<?= $row['id_booking']; ?>">
                          <input type="hidden" name="judul_buku" value="<?= $row['judul_buku']; ?>">
                          <input type="hidden" name="status_booking" value="<?= $row['status']; ?>">
                          <div class="mb-3">
                            Hapus Booking ?
                          </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          <?php } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  end modal -->
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
