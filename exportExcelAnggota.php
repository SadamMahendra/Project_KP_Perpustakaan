<?php
// Load file koneksi.php  
include 'koneksi.php';

// Buat query untuk menampilkan semua data siswa
function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$datas = [];
	while ($data = mysqli_fetch_assoc($result)) {
		$datas[] = $data;
	}
	return $datas;
}
if (isset($_GET['kelas'])){
    $kelas1 = $_GET['kelas'];
	if($kelas1 == ''){
		$kelas1 = ';';
	}else {
		$kelas1 = "where kelas='$kelas1'";
	}
	

} else {
    $kelas1 = '';
}
$datas = query("SELECT * FROM anggota $kelas1");


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataAnggota.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Data Anggota</title>
</head>

<body>
	<h3>Data Anggota</h3>
	<table border="1">
		<tr>
			<th>No</th>
			<th>Nama Anggota</th>
			<th>Kelas</th>
			<th>No Telp</th>
		</tr>
		<?php foreach ($datas as $key => $value) : ?>
			<tr>
				<td><?= $key+1 ?></td>
				<td><?= $value['nama_anggota']; ?></td>
				<td><?= $value['kelas']; ?></td>
				<td><?= $value['no_telp']; ?></td>
			</tr>
		<?php endforeach  ?>
	</table>

</body>

</html>