<?php
include('koneksi.php');

$nama = explode('_',$_POST['nama_anggota'])[0];
$kelas1 = explode('_',$_POST['nama_anggota'])[1];
$judul_buku   = $_POST['judul_buku'];
$tgl_booking  = $_POST['tgl_booking'];
$batas_booking = $_POST['tgl_batas'];
$status = $_POST['status'];

$sid         = mysqli_query($conn,"SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$ibuku       = mysqli_fetch_assoc($sid);
$id          = $ibuku['id_buku'];
$jumlah_buku = $ibuku['jumlah'];

$sag        = mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota = '$nama' and kelas = '$kelas1'");
$ianggota   = mysqli_fetch_assoc($sag);
$kelas      = $ianggota['kelas'];
$namaDB     = $ianggota['nama_anggota'];

if($nama !== $namaDB){
    echo "<script>
    alert('nama peminjam tidak terdaftar')
    window.location.href='booking.php'</script>";
}else if ($jumlah_buku <= 0){
    echo "<script>
    alert('Maaf Buku Tidak Tersedia')
    window.location.href='booking.php'</script>";
} else {
$jumlah_buku--;

$query  = mysqli_query($conn,"INSERT INTO `booking` (`nama_anggota`,`kelas`,`judul_buku`,`tgl_booking`,`tgl_batas`,`status`) VALUES ('$nama','$kelas1','$judul_buku','$tgl_booking','$batas_booking','$status')");
$q2     = mysqli_query($conn,"UPDATE buku SET jumlah = $jumlah_buku WHERE judul_buku = '$judul_buku'");

echo "<script>
alert('Buku Berhasil DiBooking')
window.location.href='booking.php'</script>";
}



if ($query) {
#balek ke halaman pinjem
    header("location:booking.php"); 
}
else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);

}