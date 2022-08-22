<?php
include('koneksi.php');

$nama = explode('_',$_POST['nama_anggota'])[0];
$kelas1 = explode('_',$_POST['nama_anggota'])[1];
$judul_buku   = $_POST['judul_buku'];
$tgl_minjam   = $_POST['tgl_minjam'];
$tgl_kembali  = $_POST['tgl_kembali'];
$status       = $_POST['status'];

$sid         = mysqli_query($conn,"SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$ibuku       = mysqli_fetch_assoc($sid);
$id          = $ibuku['id_buku'];
$jumlah_buku = $ibuku['jumlah'];

$sag        = mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota ='$nama' and kelas = '$kelas1'");
$ianggota   = mysqli_fetch_assoc($sag);
$kelas      = $ianggota['kelas'];
$namaDB     = $ianggota['nama_anggota'];

if($nama !== $namaDB){
    echo "<script>
    alert('nama peminjam tidak terdaftar')
    window.location.href='Peminjam.php'</script>";
}else if ($jumlah_buku <= 0){
    echo "<script>
    alert('Buku tidak tersedia')
    window.location.href='Peminjam.php'</script>";
} else {
    $jumlah_buku--;

    $query  = mysqli_query($conn,"INSERT INTO `peminjam` (`nama_anggota`,`kelas`,`judul_buku`,`tgl_minjam`,`tgl_kembali`,`denda`,`status`) VALUES ('$nama','$kelas','$judul_buku','$tgl_minjam','$tgl_kembali','0','$status')");
    $q2     = mysqli_query($conn,"UPDATE buku SET jumlah = $jumlah_buku WHERE judul_buku = '$judul_buku'");

    echo "<script>
    alert('Buku berhasil dipinjam')
    window.location.href='Peminjam.php'</script>";
}


if ($query) {
#balek ke halaman pinjem
    header("location:peminjam.php"); 
}
else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);

}