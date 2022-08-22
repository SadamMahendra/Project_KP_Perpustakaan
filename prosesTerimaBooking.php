<?php
include('koneksi.php');

$id_booking = $_POST['id_booking'];
$nama_anggota = $_POST['nama_anggota'];
$kelas = $_POST['kelas'];
$judul_buku   = $_POST['judul_buku'];
$batas_booking = $_POST['tgl_batas'];
$status_booking       = $_POST['status_booking'];
$status_peminjam       = $_POST['status_peminjam'];
$tgl_sekarang = strtotime("now");
$tgl_sekarang = date('Y-m-d');
$tgl_kembali = strtotime("+14 day", strtotime($tgl_sekarang));
$tgl_kembali = date('Y-m-d', $tgl_kembali); 

$sid         = mysqli_query($conn,"SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$ibuku       = mysqli_fetch_assoc($sid);
$id          = $ibuku['id_buku'];
$jumlah_buku = $ibuku['jumlah'];

$sag        = mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota = '$nama_anggota' and kelas = '$kelas'");
$ianggota   = mysqli_fetch_assoc($sag);
$kelas      = $ianggota['kelas'];
$namaDB     = $ianggota['nama_anggota'];

if($nama_anggota !== $namaDB){
    echo "<script>
    alert('nama peminjam tidak terdaftar')
    window.location.href='Peminjam.php'</script>";
} else if ($status_booking === 'dibooking') {
    // $jumlah_buku--;
    $status_booking1 = 'berhasil booking';

    $query  = mysqli_query($conn,"INSERT INTO `peminjam` (`nama_anggota`,`kelas`,`judul_buku`,`tgl_minjam`,`tgl_kembali`,`status`) VALUES ('$nama_anggota','$kelas','$judul_buku','$tgl_sekarang','$tgl_kembali','$status_peminjam')");

    $q4     = mysqli_query($conn,"UPDATE booking set status = '$status_booking1' where id_booking = '$id_booking'");
    // $q2     = mysqli_query($conn,"UPDATE buku SET jumlah = $jumlah_buku WHERE judul_buku = '$judul_buku'");
    // $q3 = mysqli_query($conn,"DELETE FROM booking where id_booking='$id_booking'");

} else if ($status_booking === 'berhasil booking'){
    echo "<script>
    alert('buku sudah masuk ke peminjam')
    window.location.href='booking.php'</script>";
}else if ($status_booking === 'batal booking'){
    echo "<script>
    alert('booking melewati batasan waktu, silahkan booking kembali')
    window.location.href='booking.php'</script>";
}


if ($query) {
#balek ke halaman pinjem
    
    echo "<script>
        alert('Buku berhasil dipinjam')
        window.location.href= 'booking.php'
    </script>";
}
else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);

}