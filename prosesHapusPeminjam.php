<?php
include('koneksi.php');

$id           = $_GET['id_peminjam'];
$judul_buku   = $_GET['judul_buku'];
$status2      = $_GET['status2'] ;
$nama_anggota = $_GET['nama_anggota'];
$denda        = $_GET['denda'];
$statusdenda  = $_GET['status_denda'];



$sid        = mysqli_query($conn,"SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$ibuku      = mysqli_fetch_assoc($sid);
$jumlah_buku = $ibuku['jumlah'];
$jumlah_buku++;


//query update
if ($statusdenda === 'lunas' || $statusdenda === 'belum denda' ){
    $statusdenda  = 'lunas';
$query  = mysqli_query($conn,"UPDATE peminjam SET status = '$status2',status_denda = '$statusdenda' WHERE id_peminjam = '$id'");
$q2     = mysqli_query($conn,"UPDATE buku SET jumlah = $jumlah_buku WHERE judul_buku = '$judul_buku'");
}else{
    echo "<script>
    alert('Maaf Tolong bayar Denda Terlebih dahulu')
    window.location.href='Peminjam.php'</script>";
}

if ($query) {
 # credirect ke page index
 header("location:peminjam.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}