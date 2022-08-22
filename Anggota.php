<?php
  include 'koneksi.php';
  include 'cekSesi.php';
  include "prosesCariAnggota.php";

function query($query){
  global $conn;
  $result = mysqli_query($conn, $query);
  $datas = [];
  while($data = mysqli_fetch_assoc($result)) {
    $datas[] = $data;
  }
  return $datas;
}
  if (isset($_GET['kelas'])){
    $kelas1 = $_GET['kelas'];
    $kelas2 = "WHERE kelas='$kelas1'";
  } else {
    $kelas1 = '';
    $kelas2 = '';
  }
  $anggota = query("SELECT * FROM anggota");
  $kelas = query("SELECT * FROM kelas order by tingkatan asc");
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

    <title>Anggota</title>
  </head>
  <body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

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
                class="nav-link text-white" href="Dashboard.php">
                <i class="fa-solid fa-gauge"></i>&nbsp; Dashboard</a
              >
              <!-- <hr class="bg-secondary" /> -->
            </li>

            <li class="nav-item mb-2">
              <a class="nav-link active text-white" href="Anggota.php"
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
          <h3><i class="fa-solid fa-user-graduate"></i>&nbsp; Anggota</h3>
          <hr /> 

          <!-- <a href="#" class="btn btn-primary mb-3"
            ><i class="fa-solid fa-plus"></i> Tambah Data User</a
          > -->

          <!-- Button trigger modal tambah user-->
          <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
          <i class="fa-solid fa-plus"></i> Tambah Anggota
          </button>

          &nbsp;

          <span>
          <a  target="_blank" href="exportExcelAnggota.php?kelas=<?= $kelas1 ?>" class="btn btn-primary mb-3"><i class="fa-solid fa-download"></i>&nbsp; Download</a>
          </span>

          <div class="mb-3" style="width: 29%;">
          <select id="kelas" class="form-select" aria-label="Default select example" onchange="tokelas(this)">
            <option selected>Pilih Kelas</option>
            <?php foreach($kelas as $value) : ?>
              <option value="<?= $value['tingkatan']?>"><?= $value['tingkatan']?></option>
            <?php endforeach ?>
          </select>
          </div>

          <div class="mb-3">
          <form action="" method="POST" style="margin-left: 113vh; width: 25%" class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Silahkan Cari..." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
            <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          </div>

          <!-- Modal tambah user -->
          <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahModalLabel">Tambah Anggota</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="tambahAnggota.php" method="get">
                  <div class="mb-3">
                    <label for="nama_anggota" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama_anggota" required placeholder="masukan nama">
                  </div>
                  <div class="mb-3">
                    <label for="kelas" class="form-label">kelas</label>
                    <select class="form-select" name="kelas" required>
                      <option selected>Pilih Kelas</option>
                      <?php foreach($kelas as $value) : ?>
                        <option value="<?= $value['tingkatan']?>"><?= $value['tingkatan']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telp" placeholder="masukan no tlp">
                  </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" name="username" required placeholder="masukan username">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="text" class="form-control" name="password" required placeholder="masukan password">
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

          <!-- end modal tambah user -->
          
          <!--  -->

        <table class="table table-striped table-bordered" id="myTable">
            <!-- bagian atas table -->
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tingkat</th>
                <th scope="col">No Telepon</th>
                <th scope="col">username</th>
                <th scope="col">password</th>
                <th colspan="3" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $counter = 0;
              $query = mysqli_query($conn, "SELECT * FROM anggota $kelas2 order by nama_anggota asc");
              if (isset($_POST["cari"])) {
                $query = cari($_POST["keyword"]);
              }
              while ($data = mysqli_fetch_assoc($query)) {
              ?>
              <tr>
                  
                  <th><?= $no++  ?></th>
                  <td><?= $data["nama_anggota"] ?></td>
                  <td><?= $data["kelas"] ?></td>
                  <td><?= $data["no_telp"] ?></td>
                  <td><?= $data["username"] ?></td>
                  <td><input class="form-control border-0 bg-transparent w-75 d-inline" placeholder="Masukan Data" id="input-<?= $counter ?>" type="password" name="<?= $counter + 1 ?>-1" autocomplete="off" value="<?= $data['password'] ?>">
                      <button type="button" class="btn btn-outline-primary" id="btn-show-<?= $counter ?>" onclick="showPassword('<?= $counter ?>')">
                          <i class="far fa-eye-slash"></i>
                      </button>
                  </td>
                  <script>
                    function showPassword(id) {
                        const inputPassword = document.querySelector(`#input-${id}`);
                        const btnShow = document.querySelector(`#btn-show-${id}`);
                        if (inputPassword.type === "password") {
                            inputPassword.type = "text";
                            btnShow.style.backgroundColor = "#0d6efd";
                            btnShow.style.color = "#fff"
                        } else {
                            inputPassword.type = "password";
                            btnShow.style.backgroundColor = "transparent";
                            btnShow.style.color = "#0d6efd"
                        }
                    }
                  </script>
                  <td>
                    <a href="#" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_anggota']; ?>">
                    <i class="fa-solid fa-pen-to-square"></i></a>
                  </td>
                  <td>
                    <a href="#" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['id_anggota']; ?>" ><i class="fa-solid fa-trash-can"></i></a>
                  </td>
                </tr>
                <!-- isi modal si  -->
                <div class="modal fade" id="editModal<?php echo $data['id_anggota']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesEditAnggota.php" method="get">
                          <!--  -->
                          <?php
                          $id_anggota = $data['id_anggota'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota ='$id_anggota'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>

                          <input type="hidden" name="id_anggota" value="<?php echo $row['id_anggota']; ?>">

                          <!--  -->
                            <div class="form-group">
                                <label for="nama_anggota" class="form-label">Nama Anggota</label>
                                <input type="text" class="form-control" name="nama_anggota" value="<?php echo $row['nama_anggota']; ?>"  >
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">kelas</label>
                                <select class="form-select" name="kelas">
                                  <option selected ><?= $row['kelas']?></option>
                                  <?php foreach($kelas as $value) : ?>
                                    <option value="<?= $value['tingkatan']?>"><?= $value['tingkatan']?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_telp" class="form-label">no_telp</label>
                                <input type="text" class="form-control" name="no_telp" value="<?php echo $row['no_telp']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label">username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>"  >
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>"  >
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
                  <div class="modal fade" id="hapusModal<?php echo $data['id_anggota']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Hapus Data Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="prosesHapusAnggota.php" method="get">
                          <!--  -->
                          <?php
                          $id_anggota = $data['id_anggota'];
                          $query_edit = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota ='$id_anggota'");
                          while ($row = mysqli_fetch_array($query_edit)) {
                          ?>

                          <input type="hidden" name="id_anggota" value="<?php echo $row['id_anggota']; ?>">
                          Yakin ingin hapus data Anggota?
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
                <?php
                  $counter++;
              
              ?>
                <?php } ?>
            </tbody>
        </table>
        </div>
      </div>
    </div>
    <script>
      const kelas = document.querySelector("#kelas")
      console.log(kelas);
      kelas.selectedIndex = "<?= $kelas ?>"
    </script>
    <script>
      function tokelas(e) {
        console.log(e);
        window.location.href = `Anggota.php?kelas=${e.value}`
      }
    </script>
  </body>
</html>
