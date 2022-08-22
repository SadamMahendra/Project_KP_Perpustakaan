<?php
include "koneksi.php";
include 'cekSesi.php';
include "prosesCariBuku.php";

function query($query){
global $conn;
$result = mysqli_query($conn, $query);
$datas = [];
while($data = mysqli_fetch_assoc($result)) {
  $datas[] = $data;
}
return $datas;
}
  $buku = query("SELECT * FROM buku");
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

    <title>Buku</title>
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
              <img src="img/user.png" alt="" width="100" /><br />Halo, <?= $_SESSION['level']; ?>
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
                ><i class="fa-solid fa-book-open-reader"></i>&nbsp; Peminjam Buku</a
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
          <h3><i class="fa-solid fa-book"></i>&nbsp; Buku</h3>
          <hr />

          <!-- <a href="#" class="btn btn-primary mb-3"
            ><i class="fa-solid fa-plus"></i> Tambah Buku</a
          > -->

          <!-- Button trigger modal tambah Buku-->
          <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahBuku">
            <i class="fa-solid fa-plus"></i>&nbsp; Tambah Data Buku
          </button>
        
          &nbsp;

          <span>
            <a target="_blank" href="exportExcelBuku.php" class="btn btn-primary mb-3"><i class="fa-solid fa-download"></i>&nbsp; Download</a>
          </span>

          <div class="mb-3">
          <form action="" method="POST" style="margin-left: 113vh; width: 25%" class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Silahkan Cari..." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
            <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          </div>

          <!-- Modal tambah Buku -->
          <div class="modal fade" id="tambahBuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="tambahBukuLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahBukuLabel">Tambah Data Buku</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="tambahBuku.php" method="get">

                  <div class=" mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" name="judul_buku" placeholder="masukan judul buku" required>
                  </div>

                  <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" name="pengarang" placeholder="masukan pengarang">
                  </div>

                  <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" placeholder="masukan penerbit">
                  </div>

                  <div class="mb-3">
                    <label for="tahun_penerbit" class="form-label">Tahun Terbit</label>
                    <input type="text" class="form-control" name="tahun_penerbit" placeholder="masukan tahun terbit">
                  </div>

                  <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Buku</label>
                    <input type="text" class="form-control" name="jumlah" placeholder="masukan jumlah buku" required>
                  </div>

                  <div class="mb-3 ">
                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" placeholder="ketikan deskirpsi" id="deskripsi" style="height: 100px"></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="jumlah_halaman" class="form-label">Jumlah halaman buku</label>
                    <input type="text" class="form-control" name="jumlah_halaman" placeholder="masukan jumlah halaman buku">
                  </div>

                  <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" name="isbn" placeholder="masukan ISBN">
                  </div>

                  <div class="mb-3">
                    <label for="bahasa_buku" class="form-label">bahasa buku</label>
                    <input type="text" class="form-control" name="bahasa_buku" placeholder="masukan bahasa buku">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- end modal tambah Buku -->

          <table class="table table-striped table-bordered">
            <!-- bagian atas table -->
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Jumlah</th>
                <th colspan="3" scope="col">Aksi</th>
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
              ?>
              <tr>
                  
                  <th><?= $no++ ?></th>
                  <td><?= $data["judul_buku"] ?></td>
                  <td><?= $data["pengarang"] ?></td>
                  <td><?= $data["penerbit"] ?></td>
                  <td><?= $data["tahun_penerbit"] ?></td>
                  <td><?= $data["jumlah"] ?></td>
                  <td>
                    <a href="#" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#infoModal<?php echo $data['id_buku']; ?>" ><i class="fa-solid fa-info"></i></a>
                  </td>
                  <td>
                    <a href="#" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_buku']; ?>">
                    <i class="fa-solid fa-pen-to-square"></i></a>
                  </td>
                  <td>
                    <a href="#" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['id_buku']; ?>" ><i class="fa-solid fa-trash-can"></i></a>
                  </td>
                </tr>
                <!-- modal info  -->
                <div class="modal fade" id="infoModal<?php echo $data['id_buku']; ?>" role="dialog">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <!--  -->
                          <?php
                          $id_buku = $data['id_buku'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku ='$id_buku'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>

                          <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">

                          <div class="form-group mb-3">
                            <label for="judul_buku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" value="<?php echo $row['judul_buku']; ?>" readonly>
                          </div>

                          <div class="form-group mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" style="height: 200px"
                            readonly><?php echo $row['deskripsi']; ?></textarea>
                          </div>

                          <div class="row mb-3">
                            <div class="col-md-6">
                            <label for="jumlah_halaman" class="form-label">Jumlah halaman buku</label>
                            <input type="text" class="form-control" name="jumlah_halaman" value="<?= $row['jumlah_halaman']; ?>" readonly>
                            </div>
                            <div class="col-md-6 ms-auto">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="<?= $row['penerbit']; ?>" readonly>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-md-6 ms-auto">
                            <label for="tahun_penerbit" class="form-label">Tahun Terbit</label>
                            <input type="text" class="form-control" name="tahun_penerbit" value="<?= $row['penerbit']; ?>" readonly>
                            </div>
                            <div class="col-md-6">
                            <label for="isbn" class="form-label">isbn</label>
                            <input type="text" class="form-control" name="isbn" value="<?= $row['isbn']; ?>" readonly>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-md-6 ms-auto">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" value="<?= $row['pengarang']; ?>" readonly>
                            </div>
                            <div class="col-md-6">
                            <label for="bahasa_buku" class="form-label">bahasa buku</label>
                            <input type="text" class="form-control" name="bahasa_buku" value="<?= $row['bahasa_buku']; ?>" readonly>
                            </div>
                          </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                          <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  end modal -->
                <!-- isi modal edit  -->
                <div class="modal fade" id="editModal<?php echo $data['id_buku']; ?>" role="dialog">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesEditBuku.php" method="get"> 
                          <!--  -->

                          <?php
                          $id_buku = $data['id_buku'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku ='$id_buku'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>
                          <input type="hidden" name="id_buku" value="<?= $row['id_buku']; ?>">
                          <!--  -->
                            <div class="form-group mb-3">
                                <label for="judul_buku" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" name="judul_buku" value="<?= $row['judul_buku']; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" class="form-control" name="pengarang" value="<?= $row['pengarang']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" name="penerbit" value="<?= $row['penerbit']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun_penerbit" class="form-label">Tahun Terbit</label>
                                <input type="text" class="form-control" name="tahun_penerbit" value="<?= $row['tahun_penerbit']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jumlah" class="form-label">Jumlah Buku</label>
                                <input type="text" class="form-control" name="jumlah" value="<?= $row['jumlah']; ?>" required>
                            </div>

                            <div class="mb-3 ">
                              <label for="deskripsi" class="col-form-label">Deskripsi</label>
                              <textarea class="form-control" name="deskripsi" id="deskripsi" style="height: 100px" value="<?= $row['deskripsi']; ?>"><?= $row['deskripsi']; ?></textarea>
                            </div>

                            <div class="mb-3">
                              <label for="jumlah_halaman" class="form-label">Jumlah halaman buku</label>
                              <input type="text" class="form-control" name="jumlah_halaman" value="<?= $row['jumlah_halaman']; ?>">
                            </div>

                            <div class="mb-3">
                              <label for="isbn" class="form-label">ISBN</label>
                              <input type="text" class="form-control" name="isbn"value="<?= $row['isbn']; ?>">
                            </div>

                            <div class="mb-3">
                              <label for="bahasa_buku" class="form-label">bahasa buku</label>
                              <input type="text" class="form-control" name="bahasa_buku" value="<?= $row['bahasa_buku']; ?>">
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
                  <div class="modal fade" id="hapusModal<?php echo $data['id_buku']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Hapus Data Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesHapusBuku.php" method="get">
                          <!--  -->
                          <?php
                          $id_buku = $data['id_buku'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku ='$id_buku'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>

                          <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                          Yakin ingin hapus data buku?
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                          <?php } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  end modal -->
        </div>
      </div>
    </div>
    <?php } ?>
  </body>

</html>
