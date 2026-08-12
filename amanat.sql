-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2026 at 11:14 AM
-- Server version: 12.3.2-MariaDB
-- PHP Version: 8.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amanat`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 5, 1510813066),
('admin', 7, 1548838385),
('Kaban', 29, 1669883452),
('Kabid', 4, 1510580411),
('Kabid', 6, 1513228644),
('Kabid', 8, 1548838574),
('Kabid', 9, 1548838585),
('Kabid', 10, 1548838602),
('Kabid', 11, 1548838616),
('Kabid', 13, 1668507241),
('Kabid', 30, 1683792825),
('Kabid', 31, 1675916076),
('Pegawai', 15, 1556495425),
('Pegawai', 16, 1556495552),
('Pegawai', 17, 1556495626),
('Pegawai', 18, 1556495733),
('Pegawai', 19, 1556496224),
('Pegawai', 20, 1556497845),
('Pegawai', 21, 1556498401),
('Pegawai', 22, 1556498549),
('Pegawai', 23, 1556498948),
('Pegawai', 24, 1556499073),
('Pegawai', 25, 1556499442),
('Pegawai', 26, 1556499490),
('Pegawai', 27, 1556508092),
('Pegawai', 28, 1556508958),
('Super Admin', 1, 1492009614),
('Super Admin', 12, 1548838768);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/admin/*', 2, NULL, NULL, NULL, 1492009603, 1492009603),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1492009497, 1492009497),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/menu/*', 2, NULL, NULL, NULL, 1492009497, 1492009497),
('/admin/menu/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/permission/*', 2, NULL, NULL, NULL, 1492009497, 1492009497),
('/admin/permission/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/role/*', 2, NULL, NULL, NULL, 1492009498, 1492009498),
('/admin/role/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/route/*', 2, NULL, NULL, NULL, 1492009498, 1492009498),
('/admin/route/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/rule/*', 2, NULL, NULL, NULL, 1492009498, 1492009498),
('/admin/rule/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/user/*', 2, NULL, NULL, NULL, 1492009498, 1492009498),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1556510774, 1556510774),
('/admin/user/index', 2, NULL, NULL, NULL, 1492009409, 1492009409),
('/admin/user/signup', 2, NULL, NULL, NULL, 1492017232, 1492017232),
('/bidang/*', 2, NULL, NULL, NULL, 1668578735, 1668578735),
('/bidang/index', 2, NULL, NULL, NULL, 1668578741, 1668578741),
('/gridview/export/download', 2, NULL, NULL, NULL, 1693215744, 1693215744),
('/klasifikasi/*', 2, NULL, NULL, NULL, 1668578752, 1668578752),
('/klasifikasi/index', 2, NULL, NULL, NULL, 1668578762, 1668578762),
('/laporan-monitoring/*', 2, NULL, NULL, NULL, 1684227057, 1684227057),
('/laporan-monitoring/index', 2, NULL, NULL, NULL, 1684227066, 1684227066),
('/laporan/*', 2, NULL, NULL, NULL, 1492017995, 1492017995),
('/laporan/bulanan', 2, NULL, NULL, NULL, 1492017986, 1492017986),
('/laporan/disposisi', 2, NULL, NULL, NULL, 1492017986, 1492017986),
('/laporan/edit-verifikasi', 2, NULL, NULL, NULL, 1510579818, 1510579818),
('/laporan/file-jawaban', 2, NULL, NULL, NULL, 1510579842, 1510579842),
('/laporan/harian', 2, NULL, NULL, NULL, 1492017986, 1492017986),
('/laporan/harian-verifikasi', 2, NULL, NULL, NULL, 1492944078, 1492944078),
('/laporan/index', 2, NULL, NULL, NULL, 1492017986, 1492017986),
('/laporan/lihat-file', 2, NULL, NULL, NULL, 1510579861, 1510579861),
('/laporan/lihat-verifikasi', 2, NULL, NULL, NULL, 1510579902, 1510579902),
('/laporan/update', 2, NULL, NULL, NULL, 1510579533, 1510579533),
('/laporan/update-bagian', 2, NULL, NULL, NULL, 1510579565, 1510579565),
('/laporan/update-cetak', 2, NULL, NULL, NULL, 1510579597, 1510579597),
('/monitoring-honorarium/*', 2, NULL, NULL, NULL, 1680508559, 1680508559),
('/monitoring-honorarium/create', 2, NULL, NULL, NULL, 1683002588, 1683002588),
('/monitoring-honorarium/delete', 2, NULL, NULL, NULL, 1683002602, 1683002602),
('/monitoring-honorarium/index', 2, NULL, NULL, NULL, 1680508584, 1680508584),
('/monitoring-honorarium/index-batal', 2, NULL, NULL, NULL, 1680508872, 1680508872),
('/monitoring-honorarium/update', 2, NULL, NULL, NULL, 1683002596, 1683002596),
('/monitoring-honorarium/verifikasi', 2, NULL, NULL, NULL, 1683002328, 1683002328),
('/monitoring-lembur/*', 2, NULL, NULL, NULL, 1680508529, 1680508529),
('/monitoring-lembur/create', 2, NULL, NULL, NULL, 1683002646, 1683002646),
('/monitoring-lembur/delete', 2, NULL, NULL, NULL, 1683002656, 1683002656),
('/monitoring-lembur/index', 2, NULL, NULL, NULL, 1680508543, 1680508543),
('/monitoring-lembur/index-batal', 2, NULL, NULL, NULL, 1680508858, 1680508858),
('/monitoring-lembur/update', 2, NULL, NULL, NULL, 1683002651, 1683002651),
('/monitoring-lembur/verifikasi', 2, NULL, NULL, NULL, 1683002311, 1683002311),
('/monitoring-perjadin/*', 2, NULL, NULL, NULL, 1680508496, 1680508496),
('/monitoring-perjadin/create', 2, NULL, NULL, NULL, 1683002617, 1683002617),
('/monitoring-perjadin/delete', 2, NULL, NULL, NULL, 1683002628, 1683002628),
('/monitoring-perjadin/get-surat', 2, NULL, NULL, NULL, 1684928431, 1684928431),
('/monitoring-perjadin/index', 2, NULL, NULL, NULL, 1680508510, 1680508510),
('/monitoring-perjadin/index-batal', 2, NULL, NULL, NULL, 1680508845, 1680508845),
('/monitoring-perjadin/update', 2, NULL, NULL, NULL, 1683002622, 1683002622),
('/monitoring-perjadin/verifikasi', 2, NULL, NULL, NULL, 1683002296, 1683002296),
('/pegawai/*', 2, NULL, NULL, NULL, 1680599705, 1680599705),
('/pegawai/index', 2, NULL, NULL, NULL, 1680599712, 1680599712),
('/pengaduan-internal/create', 2, NULL, NULL, NULL, 1510580004, 1510580004),
('/pengaduan-internal/upload-file', 2, NULL, NULL, NULL, 1510580095, 1510580095),
('/pengaduan/*', 2, NULL, NULL, NULL, 1492331540, 1492331540),
('/site/*', 2, NULL, NULL, NULL, 1492019362, 1492019362),
('/site/index', 2, NULL, NULL, NULL, 1492019195, 1492019195),
('/site/logout', 2, NULL, NULL, NULL, 1492019196, 1492019196),
('/site/signup', 2, NULL, NULL, NULL, 1669883058, 1669883058),
('/surat-keluar/*', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/cetak-surat', 2, NULL, NULL, NULL, 1693196123, 1693196123),
('/surat-keluar/create', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/daftar-file', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/daftar-file-verified', 2, NULL, NULL, NULL, 1670402510, 1670402510),
('/surat-keluar/delete', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/delete-file', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/delete-file-verified', 2, NULL, NULL, NULL, 1670308420, 1670308420),
('/surat-keluar/index', 2, NULL, NULL, NULL, 1668575617, 1668575617),
('/surat-keluar/update', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/update-disposisi', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/update-nomor', 2, NULL, NULL, NULL, 1668583138, 1668583138),
('/surat-keluar/update-terima', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/update-tindaklanjut', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/update-verifikasi', 2, NULL, NULL, NULL, 1668591654, 1668591654),
('/surat-keluar/upload-file', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/upload-file-verified', 2, NULL, NULL, NULL, 1670308414, 1670308414),
('/surat-keluar/view', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/view-disposisi', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/view-file', 2, NULL, NULL, NULL, 1668580509, 1668580509),
('/surat-keluar/view-file-verified', 2, NULL, NULL, NULL, 1670402702, 1670402702),
('/surat-keluar/view-nomor', 2, NULL, NULL, NULL, 1668591269, 1668591269),
('/surat-masuk/*', 2, NULL, NULL, NULL, 1668506389, 1668506389),
('/surat-masuk/cetak-surat', 2, NULL, NULL, NULL, 1693196099, 1693196099),
('/surat-masuk/create', 2, NULL, NULL, NULL, 1668507374, 1668507374),
('/surat-masuk/daftar-file', 2, NULL, NULL, NULL, 1668507503, 1668507503),
('/surat-masuk/delete', 2, NULL, NULL, NULL, 1668507490, 1668507490),
('/surat-masuk/delete-file', 2, NULL, NULL, NULL, 1668507595, 1668507595),
('/surat-masuk/delete-masuk-bidang', 2, NULL, NULL, NULL, 1673607005, 1673607005),
('/surat-masuk/index', 2, NULL, NULL, NULL, 1668506455, 1668506455),
('/surat-masuk/update', 2, NULL, NULL, NULL, 1668507434, 1668507434),
('/surat-masuk/update-disposisi', 2, NULL, NULL, NULL, 1668507450, 1668507450),
('/surat-masuk/update-disposisi-kaban', 2, NULL, NULL, NULL, 1669881945, 1669881945),
('/surat-masuk/update-disposisi-ubah', 2, NULL, NULL, NULL, 1673319064, 1673319064),
('/surat-masuk/update-terima', 2, NULL, NULL, NULL, 1668507482, 1668507482),
('/surat-masuk/update-tindaklanjut', 2, NULL, NULL, NULL, 1668507469, 1668507469),
('/surat-masuk/upload-file', 2, NULL, NULL, NULL, 1668507519, 1668507519),
('/surat-masuk/view', 2, NULL, NULL, NULL, 1668507392, 1668507392),
('/surat-masuk/view-disposisi', 2, NULL, NULL, NULL, 1668507408, 1668507408),
('/surat-masuk/view-file', 2, NULL, NULL, NULL, 1668507581, 1668507581),
('/user/create', 2, NULL, NULL, NULL, 1556513689, 1556513689),
('/user/ganti-password', 2, NULL, NULL, NULL, 1548862408, 1548862408),
('admin', 1, NULL, NULL, NULL, 1510812968, 1510812968),
('Kaban', 1, NULL, NULL, NULL, 1548841585, 1668507264),
('Kabid', 1, NULL, NULL, NULL, 1510579421, 1668503097),
('Keuangan', 1, 'Spesial keuangan', NULL, NULL, 1683002220, 1683002220),
('Pegawai', 1, NULL, NULL, NULL, 1556495393, 1556495393),
('Super Admin', 1, NULL, NULL, NULL, 1492009581, 1492009581);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Super Admin', '/admin/*'),
('admin', '/admin/user/change-password'),
('Kaban', '/admin/user/change-password'),
('Kabid', '/admin/user/change-password'),
('Keuangan', '/admin/user/change-password'),
('admin', '/bidang/*'),
('admin', '/bidang/index'),
('admin', '/gridview/export/download'),
('Kabid', '/gridview/export/download'),
('admin', '/klasifikasi/*'),
('admin', '/klasifikasi/index'),
('admin', '/laporan-monitoring/*'),
('Kabid', '/laporan-monitoring/*'),
('Keuangan', '/laporan-monitoring/*'),
('Super Admin', '/laporan-monitoring/*'),
('admin', '/laporan-monitoring/index'),
('Kabid', '/laporan-monitoring/index'),
('Keuangan', '/laporan-monitoring/index'),
('Super Admin', '/laporan-monitoring/index'),
('Kabid', '/laporan/harian'),
('Keuangan', '/laporan/harian'),
('Kabid', '/laporan/update'),
('Keuangan', '/laporan/update'),
('Super Admin', '/monitoring-honorarium/*'),
('admin', '/monitoring-honorarium/create'),
('Kabid', '/monitoring-honorarium/create'),
('admin', '/monitoring-honorarium/delete'),
('Kabid', '/monitoring-honorarium/delete'),
('admin', '/monitoring-honorarium/index'),
('Kabid', '/monitoring-honorarium/index'),
('Keuangan', '/monitoring-honorarium/index'),
('Super Admin', '/monitoring-honorarium/index'),
('Super Admin', '/monitoring-honorarium/index-batal'),
('admin', '/monitoring-honorarium/update'),
('Kabid', '/monitoring-honorarium/update'),
('admin', '/monitoring-honorarium/verifikasi'),
('Keuangan', '/monitoring-honorarium/verifikasi'),
('Super Admin', '/monitoring-lembur/*'),
('admin', '/monitoring-lembur/create'),
('Kabid', '/monitoring-lembur/create'),
('admin', '/monitoring-lembur/delete'),
('Kabid', '/monitoring-lembur/delete'),
('admin', '/monitoring-lembur/index'),
('Kabid', '/monitoring-lembur/index'),
('Keuangan', '/monitoring-lembur/index'),
('Super Admin', '/monitoring-lembur/index'),
('Super Admin', '/monitoring-lembur/index-batal'),
('admin', '/monitoring-lembur/update'),
('Kabid', '/monitoring-lembur/update'),
('admin', '/monitoring-lembur/verifikasi'),
('Keuangan', '/monitoring-lembur/verifikasi'),
('Super Admin', '/monitoring-perjadin/*'),
('admin', '/monitoring-perjadin/create'),
('Kabid', '/monitoring-perjadin/create'),
('admin', '/monitoring-perjadin/delete'),
('Kabid', '/monitoring-perjadin/delete'),
('admin', '/monitoring-perjadin/get-surat'),
('Kabid', '/monitoring-perjadin/get-surat'),
('admin', '/monitoring-perjadin/index'),
('Kabid', '/monitoring-perjadin/index'),
('Keuangan', '/monitoring-perjadin/index'),
('Super Admin', '/monitoring-perjadin/index'),
('Super Admin', '/monitoring-perjadin/index-batal'),
('admin', '/monitoring-perjadin/update'),
('Kabid', '/monitoring-perjadin/update'),
('admin', '/monitoring-perjadin/verifikasi'),
('Keuangan', '/monitoring-perjadin/verifikasi'),
('admin', '/pegawai/*'),
('Super Admin', '/pegawai/*'),
('admin', '/pegawai/index'),
('Super Admin', '/pegawai/index'),
('admin', '/site/*'),
('Super Admin', '/site/*'),
('admin', '/site/index'),
('Kaban', '/site/index'),
('Kabid', '/site/index'),
('Keuangan', '/site/index'),
('admin', '/site/logout'),
('Kaban', '/site/logout'),
('Kabid', '/site/logout'),
('Keuangan', '/site/logout'),
('Super Admin', '/site/signup'),
('admin', '/surat-keluar/cetak-surat'),
('Super Admin', '/surat-keluar/cetak-surat'),
('admin', '/surat-keluar/create'),
('Kabid', '/surat-keluar/create'),
('Keuangan', '/surat-keluar/create'),
('admin', '/surat-keluar/daftar-file'),
('Kabid', '/surat-keluar/daftar-file'),
('Keuangan', '/surat-keluar/daftar-file'),
('admin', '/surat-keluar/daftar-file-verified'),
('Kaban', '/surat-keluar/daftar-file-verified'),
('Kabid', '/surat-keluar/daftar-file-verified'),
('Keuangan', '/surat-keluar/daftar-file-verified'),
('admin', '/surat-keluar/delete'),
('Kabid', '/surat-keluar/delete'),
('Kabid', '/surat-keluar/delete-file'),
('Keuangan', '/surat-keluar/delete-file'),
('admin', '/surat-keluar/delete-file-verified'),
('admin', '/surat-keluar/index'),
('Kaban', '/surat-keluar/index'),
('Kabid', '/surat-keluar/index'),
('Keuangan', '/surat-keluar/index'),
('Super Admin', '/surat-keluar/index'),
('admin', '/surat-keluar/update'),
('admin', '/surat-keluar/update-nomor'),
('Kabid', '/surat-keluar/update-terima'),
('Keuangan', '/surat-keluar/update-terima'),
('admin', '/surat-keluar/update-verifikasi'),
('Kabid', '/surat-keluar/upload-file'),
('Keuangan', '/surat-keluar/upload-file'),
('admin', '/surat-keluar/upload-file-verified'),
('admin', '/surat-keluar/view'),
('Kaban', '/surat-keluar/view'),
('admin', '/surat-keluar/view-file'),
('Kaban', '/surat-keluar/view-file'),
('Kabid', '/surat-keluar/view-file'),
('Keuangan', '/surat-keluar/view-file'),
('admin', '/surat-keluar/view-file-verified'),
('Kaban', '/surat-keluar/view-file-verified'),
('Kabid', '/surat-keluar/view-file-verified'),
('Keuangan', '/surat-keluar/view-file-verified'),
('admin', '/surat-keluar/view-nomor'),
('Kaban', '/surat-keluar/view-nomor'),
('Kabid', '/surat-keluar/view-nomor'),
('Keuangan', '/surat-keluar/view-nomor'),
('admin', '/surat-masuk/cetak-surat'),
('Super Admin', '/surat-masuk/cetak-surat'),
('admin', '/surat-masuk/create'),
('admin', '/surat-masuk/daftar-file'),
('Kaban', '/surat-masuk/daftar-file'),
('Kabid', '/surat-masuk/daftar-file'),
('Keuangan', '/surat-masuk/daftar-file'),
('Super Admin', '/surat-masuk/daftar-file'),
('admin', '/surat-masuk/delete'),
('admin', '/surat-masuk/delete-file'),
('admin', '/surat-masuk/delete-masuk-bidang'),
('admin', '/surat-masuk/index'),
('Kaban', '/surat-masuk/index'),
('Kabid', '/surat-masuk/index'),
('Keuangan', '/surat-masuk/index'),
('Super Admin', '/surat-masuk/index'),
('admin', '/surat-masuk/update'),
('admin', '/surat-masuk/update-disposisi'),
('admin', '/surat-masuk/update-disposisi-kaban'),
('Kaban', '/surat-masuk/update-disposisi-kaban'),
('admin', '/surat-masuk/update-disposisi-ubah'),
('Kabid', '/surat-masuk/update-terima'),
('Keuangan', '/surat-masuk/update-terima'),
('Kabid', '/surat-masuk/update-tindaklanjut'),
('Keuangan', '/surat-masuk/update-tindaklanjut'),
('admin', '/surat-masuk/upload-file'),
('admin', '/surat-masuk/view'),
('Kaban', '/surat-masuk/view'),
('Super Admin', '/surat-masuk/view'),
('admin', '/surat-masuk/view-disposisi'),
('Kaban', '/surat-masuk/view-disposisi'),
('Kabid', '/surat-masuk/view-disposisi'),
('Keuangan', '/surat-masuk/view-disposisi'),
('Super Admin', '/surat-masuk/view-disposisi'),
('admin', '/surat-masuk/view-file'),
('Kaban', '/surat-masuk/view-file'),
('Kabid', '/surat-masuk/view-file'),
('Keuangan', '/surat-masuk/view-file'),
('Super Admin', '/surat-masuk/view-file'),
('Super Admin', '/user/create'),
('admin', '/user/ganti-password'),
('Kaban', '/user/ganti-password'),
('Kabid', '/user/ganti-password'),
('Keuangan', '/user/ganti-password'),
('Super Admin', '/user/ganti-password');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` tinyint(4) NOT NULL,
  `bidang` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id` int(11) NOT NULL,
  `klasifikasi` varchar(128) NOT NULL,
  `Keterangan` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `surat_id` int(11) DEFAULT NULL,
  `jenisSurat` tinyint(4) NOT NULL COMMENT '0:Masuk,1:KeluarDraft,2:KeluarVerified, 3;Tandaterima',
  `type` varchar(128) DEFAULT NULL,
  `namaFile` varchar(128) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `uploadAt` datetime NOT NULL,
  `uploadBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'RBAC', NULL, NULL, 10, NULL),
(2, 'Assignment', 1, '/admin/assignment/index', 1, NULL),
(3, 'Roles', 1, '/admin/role/index', 2, NULL),
(4, 'Permissions', 1, '/admin/permission/index', 3, NULL),
(5, 'Routes', 1, '/admin/route/index', 4, NULL),
(6, 'Rules', 1, '/admin/rule/index', 5, NULL),
(7, 'Menus', 1, '/admin/menu/index', 6, NULL),
(8, 'USER MANAJEMEN', NULL, NULL, 9, NULL),
(9, 'Tambah Pengguna', 8, '/admin/user/signup', 3, NULL),
(10, 'User', 8, '/admin/user/index', 2, NULL),
(11, 'Laporan Monitoring', NULL, '/laporan-monitoring/index', 7, 0x6661732066612d636c6970626f6172642d6c697374),
(16, 'Dashboard', NULL, '/site/index', 1, 0x746163686f6d657465722d616c74),
(20, 'Surat Masuk', NULL, '/surat-masuk/index', 2, 0x6661732066612d696e626f78),
(21, 'Surat Keluar', NULL, '/surat-keluar/index', 3, 0x6661732066612d70617065722d706c616e65),
(22, 'Pengaturan', NULL, NULL, 8, 0x6661732066612d636f6773),
(23, 'Bidang', 22, '/bidang/index', 3, 0x6661732066612d736861706573),
(24, 'Klasifikasi', 22, '/klasifikasi/index', 2, 0x6661732066612d736974656d6170),
(25, 'Perjalanan Dinas', NULL, '/monitoring-perjadin/index', 4, 0x6661732066612d73756974636173652d726f6c6c696e67),
(29, 'Honorarium', NULL, '/monitoring-honorarium/index', 6, 0x6661732066612d636f696e73),
(35, 'Lembur', NULL, '/monitoring-lembur/index', 5, 0x6661732066612d636c6f75642d6d6f6f6e),
(37, 'Pegawai', 22, '/pegawai/index', 1, 0x6661732066612d7573657273);

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_honorarium`
--

CREATE TABLE `monitoring_honorarium` (
  `idHonor` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `jenisSurat` tinyint(4) NOT NULL,
  `idSurat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(6) NOT NULL,
  `tujuan` varchar(128) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `statusVerifikasi` tinyint(4) NOT NULL DEFAULT 0,
  `verifikasiBy` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_lembur`
--

CREATE TABLE `monitoring_lembur` (
  `idLembur` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `jenisSurat` tinyint(2) NOT NULL,
  `idSurat` int(11) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `jenisPerjalanan` tinyint(2) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `statusVerifikasi` tinyint(4) NOT NULL DEFAULT 0,
  `verifikasiBy` int(11) DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_lembur_tanggal`
--

CREATE TABLE `monitoring_lembur_tanggal` (
  `id` int(11) NOT NULL,
  `idLembur` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_perjadin`
--

CREATE TABLE `monitoring_perjadin` (
  `idPerjadin` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `jenisSurat` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=keluar;1=masuk',
  `idSurat` int(11) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `jenisPerjalanan` tinyint(2) NOT NULL COMMENT '0=Dalam Daerah; 1=Luar Daerah Dalam Propinsi; 2:Luar Daerah Luar Provinsi',
  `tempat` varchar(255) NOT NULL,
  `statusVerifikasi` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=diajukan; 1=disetujui; 2=dibatalkan',
  `verifikasiBy` int(11) DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_perjadin_tanggal`
--

CREATE TABLE `monitoring_perjadin_tanggal` (
  `id` int(11) NOT NULL,
  `idPerjadin` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `statusAparatur` tinyint(4) NOT NULL,
  `namaLengkap` varchar(100) NOT NULL,
  `nip` varchar(22) DEFAULT NULL,
  `eselon` tinyint(4) NOT NULL,
  `kodeBidang` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_eselon`
--

CREATE TABLE `pegawai_eselon` (
  `id` tinyint(4) NOT NULL,
  `nm_eselon` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `noSurat` varchar(128) DEFAULT NULL,
  `asalTujuan` mediumtext NOT NULL,
  `tanggalSurat` date DEFAULT NULL,
  `statusSurat` tinyint(4) DEFAULT NULL,
  `statusKirim` tinyint(4) NOT NULL,
  `kodeBidang` tinyint(4) NOT NULL,
  `kodeKlasifikasi` mediumint(6) DEFAULT NULL,
  `perihal` varchar(128) NOT NULL,
  `uraianSurat` mediumtext NOT NULL,
  `isiDisposisi` varchar(128) DEFAULT NULL,
  `timeDisposisi` int(11) DEFAULT NULL,
  `jawabanDisposisi` varchar(128) DEFAULT NULL,
  `timeJawaban` int(11) DEFAULT NULL,
  `userJawab_id` int(11) DEFAULT NULL,
  `tanggalTerimaKirim` date DEFAULT NULL,
  `namaTerimaKirim` varchar(128) DEFAULT NULL,
  `timeCreated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `noSurat` varchar(128) NOT NULL,
  `asalTujuan` mediumtext NOT NULL,
  `tanggalSurat` date NOT NULL,
  `statusSurat` tinyint(4) DEFAULT NULL,
  `kodeBidang` tinyint(4) DEFAULT NULL,
  `kodeKlasifikasi` mediumint(6) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `uraianSurat` mediumtext NOT NULL,
  `isiDisposisi` mediumtext DEFAULT NULL,
  `disposisiKaban` mediumtext DEFAULT NULL,
  `timeDisposisi` int(11) DEFAULT NULL,
  `jawabanDisposisi` varchar(128) DEFAULT NULL,
  `timeJawaban` int(11) DEFAULT NULL,
  `userJawab_id` int(11) DEFAULT NULL,
  `tanggalTerimaKirim` date DEFAULT NULL,
  `namaTerimaKirim` varchar(128) DEFAULT NULL,
  `timeCreated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk_bidang`
--

CREATE TABLE `surat_masuk_bidang` (
  `id` int(11) NOT NULL,
  `noSurat` int(11) NOT NULL,
  `statusSurat` tinyint(4) NOT NULL COMMENT '0:Diteruskan bidang; 1: Diterima Bidang; 2: Ditindaklanjuti',
  `kodeBidang` tinyint(4) DEFAULT NULL,
  `jawabanDisposisi` varchar(128) DEFAULT NULL,
  `timeJawaban` int(11) DEFAULT NULL,
  `userJawab_id` int(11) DEFAULT NULL,
  `tanggalTerimaKirim` date DEFAULT NULL,
  `namaTerimaKirim` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `nama_lengkap` mediumtext DEFAULT NULL,
  `nip` char(18) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `bagian_id` tinyint(4) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `nama_lengkap`, `nip`, `email`, `status`, `bagian_id`, `created_at`, `updated_at`) VALUES
(1, 'developer', '4pgRqpeOVq6xkBpJ1cjc6Tr2b1ZwzGTa', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'abc@gmail.com', 10, NULL, 1492008084, 1676261003),
(7, 'sekretariat', 'GtrlmMrxPiT3A-_JOZojF1TXadULzOhX', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'abc@gmail.com', 10, NULL, 1548838286, 1556494795),
(8, 'ekonomi', 'SEk_AgyfxgoFAorw3_lbJOBAibtxqg-p', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'def@gmail.com', 10, 0, 1548838446, 1548838446),
(9, 'pemerintahan', 'ZUQIg5sfh9w6h2Ota3i3LI_SQvais-mZ', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'ghi@gmail.com', 10, 1, 1548838481, 1548838481),
(10, 'ppepd', 'TMKU2GRDWgy-xSG8REUpA9jAz3xhK-ug', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'jkl@gmail.com', 10, 2, 1548838519, 1548838519),
(11, 'infrastruktur', 'qkIyK4Dy85mxPrRqQhwY1GLIlZZRKb8-', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'mno@gmail.com', 10, 3, 1548838546, 1548838546),
(13, 'litbang', '36bALs2-Wj-kASb5ketOGb2uEoPdrMVh', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, '', '', 'opqr@gmail.com', 10, 4, 1548841568, 1548841568),
(29, 'kaban', 'loHUGj5GPC2F4_syCR9cQnlTGcEPurtZ', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, NULL, NULL, 'mnop@gmail.com', 10, NULL, 1669883432, 1669883432),
(30, 'keuangan', '9dNcWduZksj0qnqLrsZXtlUtoULr5U1C', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, NULL, NULL, 'pqrs@gmail.com', 10, 6, 1675915684, 1675915684),
(31, 'program', 'xPT-sLeiO1IUbNy5Y_o8KBNopIXHErMp', '$2y$13$YhQLc7epDAHMBXpCb8MbK.9w8GCvnL5q1y8NHRk2bUbJLD1bmMSNG', NULL, NULL, NULL, 'tuv@gmail.com', 10, 7, 1675915829, 1675915829);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `monitoring_honorarium`
--
ALTER TABLE `monitoring_honorarium`
  ADD PRIMARY KEY (`idHonor`),
  ADD KEY `monitoring_honorarium_pegawai_id_fk` (`idPegawai`);

--
-- Indexes for table `monitoring_lembur`
--
ALTER TABLE `monitoring_lembur`
  ADD PRIMARY KEY (`idLembur`),
  ADD KEY `monitoring_lembur_pegawai_id_fk` (`idPegawai`);

--
-- Indexes for table `monitoring_lembur_tanggal`
--
ALTER TABLE `monitoring_lembur_tanggal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitoring_lembur_tanggal_monitoring_lembur_idLembur_fk` (`idLembur`);

--
-- Indexes for table `monitoring_perjadin`
--
ALTER TABLE `monitoring_perjadin`
  ADD PRIMARY KEY (`idPerjadin`),
  ADD KEY `monitoring_perjadin_pegawai_id_fk` (`idPegawai`);

--
-- Indexes for table `monitoring_perjadin_tanggal`
--
ALTER TABLE `monitoring_perjadin_tanggal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitoring_perjadin_tanggal_monitoring_perjadin_idPerjadin_fk` (`idPerjadin`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai_eselon`
--
ALTER TABLE `pegawai_eselon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `noSurat` (`noSurat`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk_bidang`
--
ALTER TABLE `surat_masuk_bidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_masuk_bidang_surat_masuk_id_fk` (`noSurat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_bagian` (`bagian_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `monitoring_honorarium`
--
ALTER TABLE `monitoring_honorarium`
  MODIFY `idHonor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitoring_lembur`
--
ALTER TABLE `monitoring_lembur`
  MODIFY `idLembur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitoring_lembur_tanggal`
--
ALTER TABLE `monitoring_lembur_tanggal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitoring_perjadin`
--
ALTER TABLE `monitoring_perjadin`
  MODIFY `idPerjadin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitoring_perjadin_tanggal`
--
ALTER TABLE `monitoring_perjadin_tanggal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk_bidang`
--
ALTER TABLE `surat_masuk_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_honorarium`
--
ALTER TABLE `monitoring_honorarium`
  ADD CONSTRAINT `monitoring_honorarium_pegawai_id_fk` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_lembur`
--
ALTER TABLE `monitoring_lembur`
  ADD CONSTRAINT `monitoring_lembur_pegawai_id_fk` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_lembur_tanggal`
--
ALTER TABLE `monitoring_lembur_tanggal`
  ADD CONSTRAINT `monitoring_lembur_tanggal_monitoring_lembur_idLembur_fk` FOREIGN KEY (`idLembur`) REFERENCES `monitoring_lembur` (`idLembur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_perjadin`
--
ALTER TABLE `monitoring_perjadin`
  ADD CONSTRAINT `monitoring_perjadin_pegawai_id_fk` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_perjadin_tanggal`
--
ALTER TABLE `monitoring_perjadin_tanggal`
  ADD CONSTRAINT `monitoring_perjadin_tanggal_monitoring_perjadin_idPerjadin_fk` FOREIGN KEY (`idPerjadin`) REFERENCES `monitoring_perjadin` (`idPerjadin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuk_bidang`
--
ALTER TABLE `surat_masuk_bidang`
  ADD CONSTRAINT `surat_masuk_bidang_surat_masuk_id_fk` FOREIGN KEY (`noSurat`) REFERENCES `surat_masuk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_bagian` FOREIGN KEY (`bagian_id`) REFERENCES `bidang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
