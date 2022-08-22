-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 05:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `kelas`, `no_telp`, `username`, `password`) VALUES
(1, 'Muhammad Sadam Mahendra', '7A', '0821563215', 'sadam', 'sadam'),
(2, 'Malik Abdul Aziz', '7B', '0821467212', 'malik', 'malik'),
(3, 'Agung Gunawan', '7C', '0878555988', 'agung', 'agung'),
(4, 'Firmansah', '7D', '0897555139', 'firman', 'firman'),
(28, 'Tarno', 'GURU', '0888223', 'tarno', 'tarno');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `tgl_booking` varchar(50) NOT NULL,
  `tgl_batas` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `nama_anggota`, `kelas`, `judul_buku`, `tgl_booking`, `tgl_batas`, `status`) VALUES
(40, 'Agung Gunawan', '7C', 'Funiculi Funicula', '2022-08-02', '2022-08-03', 'batal booking'),
(41, 'Malik Abdul Aziz', '7B', 'Jujutsu Kaisen 05', '2022-08-03', '2022-08-04', 'berhasil booking'),
(43, 'Agung Gunawan', '7C', 'Hai, Miiko! 34', '2022-08-04', '2022-08-03', 'batal booking'),
(47, 'Agung Gunawan', '7C', 'Hai, Miiko! 34', '2022-08-04', '2022-08-02', 'batal booking'),
(48, 'Tarno', 'GURU', 'Hai, Miiko! 34', '2022-08-04', '2022-08-05', 'berhasil booking'),
(50, 'Firmansah', '7D', 'Funiculi Funicula', '2022-08-05', '2022-08-02', 'batal booking'),
(51, 'Firmansah', '7D', 'Funiculi Funicula', '2022-08-05', '2022-08-06', 'berhasil booking'),
(52, 'Tarno', 'GURU', 'Hai, Miiko! 34', '2022-08-05', '2022-08-06', 'batal booking');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_penerbit` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_halaman` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `bahasa_buku` varchar(50) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `rak` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_penerbit`, `jumlah`, `deskripsi`, `jumlah_halaman`, `isbn`, `bahasa_buku`, `gambar`, `lokasi`, `rak`, `kode`) VALUES
(17, 'Laut Bercerita', 'Leila S. Chudori', 'Kepustakaan Populer Gramedia', '21 Des 2017', 4, 'Laut Bercerita, novel terbaru Leila S. Chudori, bertutur tentang kisah keluarga yang kehilangan, sekumpulan sahabat yang merasakan kekosongan di dada, sekelompok orang yang gemar menyiksa dan lancar berkhianat, sejumlah keluarga yang mencari kejelasan makam anaknya, dan tentang cinta yang tak akan luntur.', '400', '9786024246945', 'Indonesia', '9786024246945_Laut-Bercerita.jpg', '', '', 'NV005'),
(18, 'Home Sweet Loan', 'Almira Bastari', 'Gramedia Pustaka Utama', '16 Feb 2022', 5, 'Empat orang yang berteman sejak SMA bekerja di perusahaan yang sama meski beda nasib. Di usia 31 tahun, mereka berburu rumah idaman yang minimal… nyerempet Jakarta. Kaluna, pegawai Bagian Umum, yang gajinya tak pernah menyentuh dua digit. Gadis ini kerja sampingan sebagai model bibir, bermimpi membeli rumah demi keluar dari situasi tiga kepala keluarga yang bertumpuk di bawah satu atap. Di tengah perjuangannya menabung, Kaluna dirongrong oleh kekasihnya untuk pesta pernikahan mewah. Tanisha, ibu satu anak yang menjalani Long Distance Marriage, mencari rumah murah dekat MRT yang juga bisa menampung mertuanya. Kamamiya, yang berambisi menjadi selebgram, mencari apartemen cantik untuk diunggah ke media sosial demi memenuhi gengsinya agar bisa menikah dengan pria kaya. Danan, anak tunggal tanpa beban yang akhirnya berpikir untuk berhenti hura-hura, dan membeli aset agar bisa pensiun dengan tenang. Apakah keempat sahabat ini berhasil menemukan rumah yang mampu mereka cicil? Dan apakah Kaluna bisa membentuk keluarga yang ia impikan?', '312', '9786020658049', 'Indonesia', 'Home_Sweet_Loan_cov.jpg', 'perpustakaan', '3', 'NV003'),
(19, 'Melangkah', 'Js. Khairen', 'Gramedia Widiasarana Indonesia', '23 Mar 2020', 5, 'Listrik padam di seluruh Jawa dan Bali secara misterius! Ancaman nyata kekuatan baru yang hendak menaklukkan Nusantara.\r\n\r\nSaat yang sama, empat sahabat mendarat di Sumba, hanya untuk mendapati nasib ratusan juta manusia ada di tangan mereka! Empat mahasiswa ekonomi ini, harus bertarung melawan pasukan berkuda yang bisa melontarkan listrik! Semua dipersulit oleh seorang buronan tingkat tinggi bertopeng pahlawan yang punya rencana mengerikan.\r\n\r\nTernyata pesan arwah nenek moyang itu benar-benar terwujud. “Akan datang kegelapan yang berderap, bersama ribuan kuda raksasa di kala malam. Mereka bangun setelah sekian lama, untuk menghancurkan Nusantara. Seorang lelaki dan seorang perempuan ditakdirkan membaurkan air di lautan dan api di pegunungan. Menyatukan tanah yang menghujam, dan udara yang terhampar.”\r\n\r\nKisah tentang persahabatan, tentang jurang ego anak dan orangtua, tentang menyeimbangkan logika dan perasaan. Juga tentang melangkah menuju masa depan. Bahwa, apa pun yang menjadi luka masa lalu, biarlah mengering bersama waktu.', '368', '9786020523316', 'Indonesia', '9786020523316_Melangkah_UV_Spot_R4-1.jpg', 'perpustakaan', '1', 'NV006'),
(20, 'Jujutsu Kaisen 05', 'Gege Akutami', 'Elexmedia Komputindo', '18 Jan 2022', 4, 'Program pertukaran dengan Akademi Jujutsu Kyoto dimulai. Pihak yang duluan menyingkirkan jurei tingkat 2 di area pertandinganlah yang akan jadi pemenangnya. Todo yang gemar berkelahi segera menyerang pihak Tokyo! Saat Todo dan Itadori saling berhadapan, anak-anak Kyoto yang lain ikut mengepung Itadori dengan niat untuk membunuhnya...!?', '200', '9786230029783', 'Indonesia', '9786230029783_Jujutsukaisen_5.jpg', 'perpustakaan', '2', 'NV004'),
(21, 'Hai, Miiko! 34', 'Ono Eriko', 'm&c!', '6 Jan 2022', 4, 'Hari-hari Miiko dan kawan-kawan di SD Suginoki telah usai. Sambil menyimpan semua kenangan indah dalam hati, mereka kini melangkah maju sebagai murid SMP! Gedung sekolah baru, cinta baru, persahabatan baru, juga keseruan baru telah menanti. Mari kita rayakan momen berharga Miiko bersama-sama!', '168', '9786230306150', 'Indonesia', 'WhatsApp_Image_2021-12-20_at_1.42.06_PM.jpeg', 'perpustakaan', '3', 'NV002'),
(46, 'Funiculi Funicula', 'Toshikazu Kawaguchi', 'Gramedia Pustaka Utama', '21 Apr 2021', 1, 'Di sebuah gang kecil di Tokyo, ada kafe tua yang bisa membawa pengunjungnya menjelajahi waktu. Keajaiban kafe itu menarik seorang wanita yang ingin memutar waktu untuk berbaikan dengan kekasihnya, seorang perawat yang ingin membaca surat yang tak sempat diberikan suaminya yang sakit, seorang kakak yang ingin menemui adiknya untuk terakhir kali, dan seorang ibu yang ingin bertemu dengan anak yang mungkin takkan pernah dikenalnya. Namun ada banyak peraturan yang harus diingat. Satu, mereka harus tetap duduk di kursi yang telah ditentukan. Dua, apa pun yang mereka lakukan di masa yang didatangi takkan mengubah kenyataan di masa kini. Tiga, mereka harus menghabiskan kopi khusus yang disajikan sebelum kopi itu dingin. Rentetan peraturan lainnya tak menghentikan orang-orang itu untuk menjelajahi waktu. Akan tetapi, jika kepergian mereka tak mengubah satu hal pun di masa kini, layakkah semua itu dijalani?', '225', '9786020651927', 'Indonesia', '9786020651927_Funiculi_Funicula_cov.jpg', 'perpustakaan', '2', 'NV001'),
(58, 'The Chronicles of Narnia #1d', 'C. S. Lewisd', 'Gramedia Pustaka Utamad', '2 Jun 2022d', 5, 'testingd', '264d', '9786020336398d', 'Indonesiadd', 'Narnia_1_cov_page-0001.jpg', 'perpustakaand', '2d', 'BI002d');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `tingkatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `tingkatan`) VALUES
(1, '7A'),
(2, '7B'),
(3, '7C'),
(4, '7D'),
(5, '8A'),
(6, '8B'),
(7, '8C'),
(8, '9A'),
(9, '9B'),
(10, '9C'),
(11, '7E'),
(12, 'GURU');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id_peminjam` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `tgl_minjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) DEFAULT NULL,
  `denda` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `status_denda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `nama_anggota`, `kelas`, `judul_buku`, `tgl_minjam`, `tgl_kembali`, `denda`, `status`, `status_denda`) VALUES
(157, 'Betari Indrianto', '9B', 'Home Sweet Loan', '2022-08-02', '2022-07-22', '11000', 'dikembalikan', 'lunas'),
(159, 'Agung Gunawan', '7C', 'Melangkah', '2022-08-02', '2022-07-23', '10000', 'dikembalikan', 'lunas'),
(180, 'Agung Gunawan', '7C', 'Funiculi Funicula', '2022-08-02', '2022-08-02', '2000', 'dikembalikan', 'lunas'),
(181, 'Dekrito Maski Firdaus', '8C', 'Funiculi Funicula', '2022-07-31', '2022-08-01', '3000', 'dikembalikan', 'lunas'),
(182, 'Betari Indrianto', '9B', 'Hai, Miiko! 34', '2022-08-02', '2022-08-16', '0', 'dipinjam', 'belum denda'),
(183, 'Malik Abdul Aziz', '7B', 'Jujutsu Kaisen 05', '2022-08-04', '2022-08-18', '0', 'dipinjam', 'belum denda'),
(184, 'Tarno', 'GURU', 'Funiculi Funicula', '2022-08-04', '2022-08-01', '3000', 'dikembalikan', 'lunas'),
(185, 'Tarno', 'GURU', 'Jujutsu Kaisen 05', '2022-08-04', '2022-08-02', '2000', 'dikembalikan', 'lunas'),
(186, 'Tarno', 'GURU', 'Hai, Miiko! 34', '2022-08-04', '2022-08-02', '3000', 'dipinjam', 'belum lunas'),
(187, 'Tarno', 'GURU', 'Laut Bercerita', '2022-08-04', '2022-08-01', '4000', 'dipinjam', 'belum lunas'),
(188, 'Firmansah', '7D', 'Funiculi Funicula', '2022-08-05', '2022-08-19', '0', 'dipinjam', 'belum denda');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(4, 'malek', '1234', 'staff'),
(5, 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
