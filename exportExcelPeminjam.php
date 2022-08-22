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
$datas = query("SELECT * FROM Peminjam order by tgl_minjam asc");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataPeminjam.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Data Buku</title>
</head>

<body>
	<h3>Data Buku</h3>
	<table border="1">
		<tr>
			<th >No</th>
			<th >Nama</th>
			<th>Kelas</th>
			<th >Judul buku</th>
			<th >Tgl Minjam</th>
			<th >Tgl Kembali</th>
			<th >Denda</th>
			<th >Status Denda</th>
			<th >Status</th>
		</tr>
		<?php foreach ($datas as $key => $value) : ?>
			<tr>
				<td><?= $key+1 ?></td>
				<td><?= $value["nama_anggota"] ?></td>
				<td><?= $value["kelas"] ?></td>
				<td><?= $value["judul_buku"] ?></td>
				<td><?= $value["tgl_minjam"] ?></td>
				<td><?= $value["tgl_kembali"] ?></td>
				<td><?= $value["denda"] ?></td>
				<td><?= $value["status_denda"] ?></td>
				<td><?= $value["status"] ?></td>
			</tr>
		<?php endforeach  ?>
		<tr >
			<td  style="background-color: 'yellow';" colspan ='8'> Total Peminjaman </td>
			<td> <?= count($datas) ?> </td>
		</tr>
	</table>

</body>

</html>