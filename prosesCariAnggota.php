<?php
include "koneksi.php";

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM anggota
                WHERE
                nama_anggota LIKE '%$keyword%'OR
                kelas LIKE '%$keyword%'OR
                no_telp LIKE '%$keyword%'
                ";
    $result = mysqli_query($conn, $query);
    return $result;
}
