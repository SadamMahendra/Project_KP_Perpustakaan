<?php
include 'koneksi.php';
include 'cekSesi.php';
include "prosesCariPeminjam.php";

function query($query){

  global $conn;

  $result = mysqli_query($conn, $query);
  $datas  = [];

  while($data = mysqli_fetch_assoc($result)) {

    $datas[] = $data;
  }
  return $datas;
}

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

    <link rel="stylesheet" href="fontawesome/css/all.min.css" />

    <!-- script manggil si font-awesome -->
    <script
      src="https://kit.fontawesome.com/5abd65a6aa.js"
      crossorigin="anonymous"
    ></script>

    <title>Peminjam</title>
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
              <img src="img/user.png" alt="" width="90" /><br />Halo, <?= $_SESSION['level']; ?>
              <hr />
            </li>

            <li class="nav-item">
              <a
                class="nav-link active text-white"
                aria-current="page"
                href="Dashboard.php"
                ><i class="fa-solid fa-gauge"></i>&nbsp; Dashboard</a
              >
              <hr class="bg-secondary" />
            </li>

            <li class="nav-item">
              <a class="nav-link text-white" href="Anggota.php"
                ><i class="fa-solid fa-user-graduate"></i>&nbsp; Anggota</a
              >
              <hr class="bg-secondary" />
            </li>

            <li class="nav-item">
              <a class="nav-link text-white" href="Buku.php"
                ><i class="fa-solid fa-book"></i>&nbsp; Buku</a
              >
              <hr class="bg-secondary" />
            </li>

            <li class="nav-item">
              <a class="nav-link text-white" href="Peminjam.php"
                ><i class="fa-solid fa-book-open-reader"></i>&nbsp; Peminjam</a
              >
              <hr class="bg-secondary" />
            </li>

            <?php
            if ($_SESSION['level'] == 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="DataUser.php"
                ><i class="fa-solid fa-user"></i>&nbsp; User</a
              >
              <hr class="bg-secondary" />
            </li>
            <?php } ?>

            <li class="nav-item">
            <a class="nav-link text-white" href="logoutModal.php" onclick="return confirm('ingin keluar?')"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp; Logout </a>
              <hr class="bg-secondary" />
            </li>
          </ul>
        </div>
        <!-- bagian content -->
        <div class="col-md-10 p-5" style="margin-left: 250px;">
          <h3>
            <i class="fa-solid fa-book-open-reader"></i>&nbsp; Peminjam
          </h3>
          <hr />
          <!--  -->
          <!-- Button trigger modal tambah user-->
          <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahTransaksi">
          <i class="fa-solid fa-plus"></i>&nbsp; Pinjam Buku
          </button>

          &nbsp;

          <span>
            <a target="_blank" href="exportExcelPeminjam.php" class="btn btn-primary mb-3"><i class="fa-solid fa-download"></i>&nbsp; Download</a>
          </span>

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

                <form action="tambahPeminjam.php" method="get">    
                  <div class="mb-3">
                    <label for="nama_anggota" class="form-label">nama anggota</label>
                    <input class="form-control" autocomplete="off" list="datalistOptions1" id="exampleDataList" name="nama_anggota" placeholder="Ketikan Nama Anggota" required>
                    <datalist id="datalistOptions1">
                      <?php foreach($anggota as $value) : ?>
                        <option value="<?= $value['nama_anggota']?>"><?= $value['nama_anggota'] , " ", $value['kelas']?></option>
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
                    <label for="tgl_minjam" class="form-label">tanggal minjam</label>
                    <?php $pinjam = strtotime("now");
                          $pinjam = date('Y-m-d', $pinjam); ?>
                    <input type="date" class="form-control" name="tgl_minjam" id="tgl_minjam" value="<?= $pinjam ?>" required>
                  </div> 
                  <div class="mb-3">
                    <label for="tgl_kembali" class="form-label">tanggal kembali</label>
                    <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" required>
                  </div>
                  <input type="hidden" name="status" value="dipinjam">
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
                <th scope="col">Kelas</th>
                <th scope="col">Judul buku</th>
                <th scope="col">Tgl Minjam</th>
                <th scope="col">Tgl Kembali</th>
                <th scope="col">Terlambat</th>
                <th colspan="3" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($conn, "SELECT * FROM peminjam WHERE status='dipinjam'");
              $no = 1;
              if (isset($_POST["cari"])) {
                $query = cari($_POST["keyword"]);
              }
              while ($data = mysqli_fetch_assoc($query)) {
                 // untuk menghitung selisih hari terlambat
                  $t = date_create($data['tgl_kembali']);
                  $n = date_create(date('Y-m-d'));
                  $terlambat = date_diff($t, $n);
                  if ($t >= $n){
                $hari = 0 ;
                }else {
                  $hari = $terlambat->format("%a");
              }
                  // menghitung denda
                  $denda = $hari * 1000;
                  ?>
              
              <tr>
                  
                  <th><?= $no++  ?></th>
                  <td><?= $data["nama_anggota"] ?></td>
                  <td><?= $data["kelas"] ?></td>
                  <td><?= $data["judul_buku"] ?></td>
                  <td><?= $data["tgl_minjam"] ?></td>
                  <td><?= $data["tgl_kembali"] ?></td>
                  <td><?php echo "
                    <font color='red'>$hari hari <br>(Rp. $denda) </font>
                    " 
                    ?>
                    </td>
                  <td>
                    <a href="#" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_peminjam']; ?>">
                    <i class="fa-solid fa-pen-to-square"></i></a>
                  </td>
                  <td>
                    <a href="#" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['id_peminjam']; ?>" >kembalikan</a>
                  </td>
                </tr>
                <!-- isi modal edit -->
                <div class="modal fade" id="editModal<?php echo $data['id_peminjam']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Peminjam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesEditPeminjam.php" method="get">
                          <!--  -->
                          <?php
                          $id_peminjam = $data['id_peminjam'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM peminjam WHERE id_peminjam ='$id_peminjam'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>
                          <!--  --> 
                          <input type="hidden" name="id_peminjam" value="<?php echo $row['id_peminjam']; ?>">
                          <input type="hidden" class="form-control" name="tmp_buku" value="<?php echo $row['judul_buku']; ?>" >
                            <div class="form-group mb-3">
                                <label for="nama_anggota" class="form-label">nama anggota</label>
                                <input type="text" class="form-control" name="nama_anggota" value="<?php echo $row['nama_anggota']; ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" name="kelas" value="<?php echo $row['kelas']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_buku" value="<?php echo $row['id_buku']; ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="judul_buku" class="form-label">Judul Buku</label>
                                <select class="form-select" size="3" name="judul_buku" required>
                                  <option selected><?php echo $row['judul_buku']; ?></option>
                                  <?php foreach($buku as $i => $value) : ?>
                                    <option value="<?= $value['judul_buku']?>"><?=($i+1).'. '.$value['judul_buku']?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_minjam" class="form-label">tgl minjam</label>
                                <input type="date" class="form-control" name="tgl_minjam" value="<?php echo $row['tgl_minjam']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_kembali" class="form-label">tgl kembali</label>
                                <input type="date" class="form-control" name="tgl_kembali" value="<?php echo $row['tgl_kembali']; ?>">
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
                  <!-- isi hapus  -->
                  <div class="modal fade" id="hapusModal<?php echo $data['id_peminjam']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Kembalikan Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesHapusPeminjam.php" method="get">
                          <!--  -->
                          <?php
                          $id_peminjam = $data['id_peminjam'];
                          $judul_buku = $data['judul_buku'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM peminjam WHERE id_peminjam ='$id_peminjam'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>
                          <input type="hidden" name="id_peminjam" value="<?php echo $row['id_peminjam']; ?>">
                          <input type="hidden" name="nama_anggota" value="<?php echo $row['nama_anggota']; ?>">
                          <input type="hidden" name="judul_buku" value="<?php echo $row['judul_buku']; ?>">
                          <input type="hidden" name="status2" value="dikembalikan">
                          
                          Yakin ingin Mengembalikan buku?
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Kembalikan</button>
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
