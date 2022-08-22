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
$datas = query("SELECT * FROM buku");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataBuku.xls");
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
			<th>No</th>
			<th>kode buku</th>
			<th>Judul Buku</th>
			<th>Pengarang</th>
			<th>Penerbit</th>
			<th>Tahun Terbit</th>
			<th>Jumlah buku</th>
			<th>Jumlah halaman</th>
			<th>ISBN</th>
			<th>Bahasa buku</th>
		</tr>
		<?php foreach ($datas as $key => $value) : ?>
			<tr>
				<td><?= $key+1 ?></td>
				<td><?= $value["kode"] ?></td>
				<td><?= $value["judul_buku"] ?></td>
				<td><?= $value["pengarang"] ?></td>
				<td><?= $value["penerbit"] ?></td>
				<td><?= $value["tahun_penerbit"] ?></td>
				<td><?= $value["jumlah"] ?></td>
				<td><?= $value["jumlah_halaman"] ?></td>
				<td><?= $value["isbn"] ?></td>
				<td><?= $value["bahasa_buku"] ?></td>
			</tr>
		<?php endforeach  ?>
	</table>

</body>

</html>