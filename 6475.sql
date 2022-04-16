-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2022 at 05:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `6475`
--
CREATE DATABASE IF NOT EXISTS `6475` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `6475`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(255) NOT NULL,
  `id_chatroom` int(255) NOT NULL,
  `chat` varchar(1000) NOT NULL,
  `tanggal` varchar(1000) NOT NULL,
  `waktu` varchar(1000) NOT NULL,
  `iduser` int(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_chat`, `id_chatroom`, `chat`, `tanggal`, `waktu`, `iduser`, `gambar`) VALUES
(1, 1, 'tim mau tanya fai', '23-10-2017', '10:54:26pm', 1, ''),
(2, 1, 'mau tanya apa chard??', '23-10-2017', '10:55:26pm', 3, ''),
(3, 1, 'tanya endorsement tim', '25-10-2017', '09:29:01am', 1, ''),
(4, 1, 'maksud e endorsement itu apa?', '25-10-2017', '02:30:53pm', 1, ''),
(5, 1, 'ngapain invite aku chard??', '25-10-2017', '04:21:06pm', 2, ''),
(6, 1, 'yo gpp toh wkwk', '25-10-2017', '08:53:06pm', 1, ''),
(7, 4, 'halo djor', '25-10-2017', '09:19:24pm', 1, ''),
(8, 4, 'yak apa kabarmu??', '25-10-2017', '09:19:33pm', 1, ''),
(9, 5, 'halo jes', '25-10-2017', '09:19:56pm', 1, ''),
(10, 4, 'kon stress kenek FAI yo', '25-10-2017', '09:21:40pm', 2, ''),
(11, 4, 'Djor ada kali linuxx', '16-11-2017', '12:55:08am', 1, '84bc37968b8929a490be61a48a639f91.png');

-- --------------------------------------------------------

--
-- Table structure for table `chatmember`
--

CREATE TABLE `chatmember` (
  `id_chatmember` int(255) NOT NULL,
  `id_chatroom` int(255) NOT NULL,
  `iduser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatmember`
--

INSERT INTO `chatmember` (`id_chatmember`, `id_chatroom`, `iduser`) VALUES
(1, 1, 1),
(7, 4, 1),
(8, 4, 2),
(9, 5, 5),
(10, 5, 1),
(11, 1, 2),
(12, 1, 3),
(13, 6, 3),
(14, 6, 1),
(15, 7, 1),
(16, 7, 7),
(17, 8, 3),
(18, 8, 11),
(19, 9, 3),
(20, 9, 10),
(21, 10, 7),
(22, 10, 5),
(23, 11, 7),
(24, 11, 9),
(25, 12, 7),
(26, 12, 11),
(29, 14, 1),
(32, 14, 3),
(33, 14, 9),
(34, 15, 1),
(35, 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id_chatroom` int(255) NOT NULL,
  `date` varchar(10000) NOT NULL,
  `isprivate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id_chatroom`, `date`, `isprivate`) VALUES
(1, '25-10-2017 08:53:06pm', '0'),
(4, '16-11-2017 12:55:08am', '0'),
(5, '25-10-2017 09:19:56pm', '0'),
(6, '02-11-2017 01:39:56am', '0'),
(7, '02-11-2017 03:51:19am', '0'),
(8, '02-11-2017 03:52:32am', '0'),
(9, '02-11-2017 03:52:36am', '0'),
(10, '02-11-2017 03:53:28am', '0'),
(11, '02-11-2017 03:53:32am', '0'),
(12, '02-11-2017 03:53:49am', '0'),
(14, '02-11-2017 08:56:00am', '1'),
(15, '08-11-2017 10:17:13pm', '1');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `idcomment` int(255) NOT NULL,
  `id_post` int(255) NOT NULL,
  `isicomment` varchar(10000) NOT NULL,
  `iduser` int(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`idcomment`, `id_post`, `isicomment`, `iduser`, `email`, `gambar`) VALUES
(1, 2, 'alay kon chard post ae 2x', 2, 'djordi123@gmail.com', ''),
(3, 2, 'djor wes kerjo fai gawe sesuk tah??', 1, 'zdio7635@gmail.com', ''),
(7, 8, 'Maen PES ae tok', 1, 'zdio7635@gmail.com', ''),
(9, 9, 'salah komen', 1, 'zdio7635@gmail.com', ''),
(11, 8, 'bacot kon chard', 2, 'djordi123@gmail.com', ''),
(12, 10, 'salam kenal ya semuanya', 1, 'zdio7635@gmail.com', ''),
(13, 2, 'Oiii jawab', 1, 'zdio7635@gmail.com', ''),
(14, 2, 'halooooo djooooorrr onok Black dessert online', 1, 'zdio7635@gmail.com', 'asnidwq8712983nsajdknsad.jpg'),
(15, 32, 'jeeesss????', 1, 'zdio7635@gmail.com', ''),
(16, 11, 'yuuuhuuu', 3, 'timo@gmail.com', ''),
(17, 11, 'Streak kill 5 people PUBG', 3, 'timo@gmail.com', ''),
(18, 8, 'ling xiao yu', 1, 'zdio7635@gmail.com', 'ec1513d1524ba7e04e49a2469ef88503.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `endorsement`
--

CREATE TABLE `endorsement` (
  `id_endorsement` int(255) NOT NULL,
  `id_skill` int(255) NOT NULL,
  `iduser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `endorsement`
--

INSERT INTO `endorsement` (`id_endorsement`, `id_skill`, `iduser`) VALUES
(1, 2, 2),
(3, 2, 5),
(4, 10, 1),
(6, 3, 5),
(7, 2, 3),
(8, 3, 7),
(9, 2, 7),
(10, 2, 9),
(11, 3, 9),
(12, 13, 1),
(13, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `idfriend` int(255) NOT NULL,
  `iduser1` int(255) NOT NULL,
  `iduser2` int(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`idfriend`, `iduser1`, `iduser2`, `status`) VALUES
(16, 1, 5, '2'),
(18, 1, 2, '2'),
(19, 7, 9, '2'),
(20, 7, 11, '1'),
(21, 7, 1, '2'),
(22, 11, 8, '1'),
(23, 11, 3, '2'),
(24, 11, 6, '1'),
(25, 10, 1, '1'),
(26, 10, 3, '2'),
(27, 5, 9, '2'),
(28, 5, 7, '2'),
(29, 9, 1, '2'),
(30, 1, 3, '2'),
(31, 7, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `jnsskill`
--

CREATE TABLE `jnsskill` (
  `id_jnsskill` int(255) NOT NULL,
  `nama_skill` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnsskill`
--

INSERT INTO `jnsskill` (`id_jnsskill`, `nama_skill`) VALUES
(1, 'PHP Programmer'),
(2, 'Framework Application Internet Programmer'),
(3, 'Object Orientation Programming'),
(4, 'Visual Programming'),
(5, 'C++ Programming'),
(6, 'Basis Data Programmer'),
(7, 'ITP PROGRAMMING'),
(8, 'Mobile Device Programming'),
(9, 'OpenGl Programming'),
(10, 'Android Programming');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id_post` int(255) NOT NULL,
  `iduser` int(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id_post`, `iduser`, `email`) VALUES
(8, 2, 'djordi123@gmail.com'),
(9, 1, 'zdio7635@gmail.com'),
(10, 3, 'timo@gmail.com'),
(2, 3, 'timo@gmail.com'),
(9, 3, 'timo@gmail.com'),
(8, 3, 'timo@gmail.com'),
(11, 3, 'timo@gmail.com'),
(2, 2, 'djordi123@gmail.com'),
(2, 1, 'zdio7635@gmail.com'),
(2, 7, 'theo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `idnotif` int(255) NOT NULL,
  `iduser` int(255) NOT NULL,
  `iduser2` int(255) NOT NULL,
  `isinotif` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `idfriend` int(255) NOT NULL,
  `id_chatroom` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`idnotif`, `iduser`, `iduser2`, `isinotif`, `status`, `idfriend`, `id_chatroom`) VALUES
(6, 2, 1, 'permintaan pertemanan', '1', 11, 0),
(7, 1, 2, 'permintaan pertemanan', '1', 12, 0),
(8, 1, 3, 'permintaan pertemanan', '1', 13, 0),
(9, 5, 1, 'permintaan pertemanan', '1', 14, 0),
(10, 5, 1, 'permintaan pertemanan', '1', 15, 0),
(11, 1, 5, 'Permintaan pertemanan disetujui', '0', 15, 0),
(12, 5, 1, 'permintaan pertemanan', '1', 16, 0),
(13, 1, 5, 'Permintaan pertemanan disetujui', '0', 16, 0),
(15, 1, 2, 'Permintaan pertemanan ditolak', '0', 17, 0),
(16, 2, 1, 'permintaan pertemanan', '1', 18, 0),
(17, 1, 2, 'Permintaan pertemanan disetujui', '0', 18, 0),
(18, 1, 2, 'Like', '0', 0, 0),
(19, 1, 2, 'Komentar', '0', 0, 0),
(20, 1, 1, 'Like', '0', 0, 0),
(21, 1, 1, 'Like', '0', 0, 0),
(22, 1, 1, 'Like', '0', 0, 0),
(26, 3, 1, 'lihatprofile', '0', 0, 0),
(27, 3, 1, 'lihatprofile', '0', 0, 0),
(30, 5, 1, 'Read', '0', 0, 5),
(32, 2, 1, 'lihatprofile', '0', 0, 0),
(33, 2, 1, 'lihatprofile', '0', 0, 0),
(34, 2, 1, 'lihatprofile', '0', 0, 0),
(35, 3, 1, 'lihatprofile', '0', 0, 0),
(36, 2, 1, 'lihatprofile', '0', 0, 0),
(37, 2, 1, 'lihatprofile', '0', 0, 0),
(38, 2, 1, 'lihatprofile', '0', 0, 0),
(39, 2, 1, 'lihatprofile', '0', 0, 0),
(40, 2, 1, 'lihatprofile', '0', 0, 0),
(41, 3, 1, 'lihatprofile', '0', 0, 0),
(42, 2, 1, 'lihatprofile', '0', 0, 0),
(43, 2, 1, 'lihatprofile', '0', 0, 0),
(44, 3, 1, 'lihatprofile', '0', 0, 0),
(45, 2, 1, 'lihatprofile', '0', 0, 0),
(46, 1, 2, 'lihatprofile', '0', 0, 0),
(47, 1, 2, 'lihatprofile', '0', 0, 0),
(48, 1, 2, 'lihatprofile', '0', 0, 0),
(49, 1, 2, 'lihatprofile', '0', 0, 0),
(50, 2, 2, 'lihatprofile', '0', 0, 0),
(51, 1, 2, 'lihatprofile', '0', 0, 0),
(52, 1, 3, 'lihatprofile', '0', 0, 0),
(53, 2, 3, 'lihatprofile', '0', 0, 0),
(54, 1, 3, 'lihatprofile', '0', 0, 0),
(55, 1, 3, 'lihatprofile', '0', 0, 0),
(56, 1, 3, 'lihatprofile', '0', 0, 0),
(57, 1, 3, 'lihatprofile', '0', 0, 0),
(58, 1, 3, 'lihatprofile', '0', 0, 0),
(59, 1, 3, 'lihatprofile', '0', 0, 0),
(60, 1, 3, 'lihatprofile', '0', 0, 0),
(61, 1, 3, 'lihatprofile', '0', 0, 0),
(62, 1, 3, 'lihatprofile', '0', 0, 0),
(63, 1, 3, 'lihatprofile', '0', 0, 0),
(64, 1, 3, 'lihatprofile', '0', 0, 0),
(65, 1, 3, 'lihatprofile', '0', 0, 0),
(66, 1, 3, 'lihatprofile', '0', 0, 0),
(67, 1, 3, 'lihatprofile', '0', 0, 0),
(68, 1, 3, 'lihatprofile', '0', 0, 0),
(69, 1, 3, 'lihatprofile', '0', 0, 0),
(70, 1, 3, 'lihatprofile', '0', 0, 0),
(71, 1, 3, 'lihatprofile', '0', 0, 0),
(72, 1, 3, 'lihatprofile', '0', 0, 0),
(73, 1, 3, 'lihatprofile', '0', 0, 0),
(74, 1, 3, 'lihatprofile', '0', 0, 0),
(75, 1, 3, 'lihatprofile', '0', 0, 0),
(76, 1, 3, 'lihatprofile', '0', 0, 0),
(77, 1, 3, 'lihatprofile', '0', 0, 0),
(78, 1, 3, 'lihatprofile', '0', 0, 0),
(79, 1, 3, 'lihatprofile', '0', 0, 0),
(80, 1, 3, 'lihatprofile', '0', 0, 0),
(81, 1, 3, 'lihatprofile', '0', 0, 0),
(82, 1, 3, 'lihatprofile', '0', 0, 0),
(83, 1, 3, 'lihatprofile', '0', 0, 0),
(84, 2, 1, 'lihatprofile', '0', 0, 0),
(85, 2, 1, 'lihatprofile', '0', 0, 0),
(86, 2, 1, 'lihatprofile', '0', 0, 0),
(87, 2, 1, 'lihatprofile', '0', 0, 0),
(88, 2, 1, 'lihatprofile', '0', 0, 0),
(89, 2, 1, 'lihatprofile', '0', 0, 0),
(90, 2, 1, 'lihatprofile', '0', 0, 0),
(91, 2, 1, 'lihatprofile', '0', 0, 0),
(92, 2, 1, 'lihatprofile', '0', 0, 0),
(93, 2, 1, 'lihatprofile', '0', 0, 0),
(94, 2, 1, 'lihatprofile', '0', 0, 0),
(95, 2, 1, 'lihatprofile', '0', 0, 0),
(96, 2, 1, 'lihatprofile', '0', 0, 0),
(97, 2, 1, 'lihatprofile', '0', 0, 0),
(98, 2, 1, 'lihatprofile', '0', 0, 0),
(99, 2, 1, 'lihatprofile', '0', 0, 0),
(100, 2, 1, 'lihatprofile', '0', 0, 0),
(101, 2, 1, 'lihatprofile', '0', 0, 0),
(102, 2, 1, 'lihatprofile', '0', 0, 0),
(103, 2, 1, 'lihatprofile', '0', 0, 0),
(104, 2, 1, 'lihatprofile', '0', 0, 0),
(105, 2, 1, 'lihatprofile', '0', 0, 0),
(106, 2, 1, 'lihatprofile', '0', 0, 0),
(107, 2, 1, 'lihatprofile', '0', 0, 0),
(108, 2, 1, 'lihatprofile', '0', 0, 0),
(109, 3, 1, 'lihatprofile', '0', 0, 0),
(110, 3, 1, 'lihatprofile', '0', 0, 0),
(111, 3, 1, 'lihatprofile', '0', 0, 0),
(112, 5, 1, 'lihatprofile', '0', 0, 0),
(113, 5, 1, 'lihatprofile', '0', 0, 0),
(114, 5, 1, 'lihatprofile', '0', 0, 0),
(115, 5, 1, 'lihatprofile', '0', 0, 0),
(116, 5, 1, 'lihatprofile', '0', 0, 0),
(117, 5, 1, 'lihatprofile', '0', 0, 0),
(118, 5, 1, 'lihatprofile', '0', 0, 0),
(119, 5, 3, 'lihatprofile', '0', 0, 0),
(120, 2, 3, 'lihatprofile', '0', 0, 0),
(121, 1, 3, 'lihatprofile', '0', 0, 0),
(122, 1, 3, 'lihatprofile', '0', 0, 0),
(123, 1, 3, 'lihatprofile', '0', 0, 0),
(124, 1, 3, 'lihatprofile', '0', 0, 0),
(125, 1, 3, 'lihatprofile', '0', 0, 0),
(126, 1, 3, 'lihatprofile', '0', 0, 0),
(127, 1, 3, 'lihatprofile', '0', 0, 0),
(128, 1, 3, 'lihatprofile', '0', 0, 0),
(129, 1, 3, 'lihatprofile', '0', 0, 0),
(130, 1, 3, 'lihatprofile', '0', 0, 0),
(131, 1, 3, 'lihatprofile', '0', 0, 0),
(132, 1, 3, 'lihatprofile', '0', 0, 0),
(133, 1, 3, 'lihatprofile', '0', 0, 0),
(134, 2, 3, 'lihatprofile', '0', 0, 0),
(135, 2, 3, 'lihatprofile', '0', 0, 0),
(136, 1, 3, 'lihatprofile', '0', 0, 0),
(137, 5, 3, 'lihatprofile', '0', 0, 0),
(138, 2, 3, 'lihatprofile', '0', 0, 0),
(139, 5, 3, 'Mention', '0', 0, 0),
(140, 5, 1, 'Mention', '0', 0, 0),
(141, 1, 5, 'lihatprofile', '0', 0, 0),
(142, 9, 7, 'permintaan pertemanan', '1', 19, 0),
(143, 11, 7, 'permintaan pertemanan', '0', 20, 0),
(144, 1, 7, 'permintaan pertemanan', '1', 21, 0),
(145, 7, 1, 'Permintaan pertemanan disetujui', '0', 21, 0),
(146, 8, 11, 'permintaan pertemanan', '0', 22, 0),
(147, 3, 11, 'permintaan pertemanan', '1', 23, 0),
(148, 6, 11, 'permintaan pertemanan', '0', 24, 0),
(149, 1, 10, 'permintaan pertemanan', '0', 25, 0),
(150, 3, 10, 'permintaan pertemanan', '1', 26, 0),
(151, 11, 3, 'Permintaan pertemanan disetujui', '0', 23, 0),
(152, 10, 3, 'Permintaan pertemanan disetujui', '0', 26, 0),
(153, 9, 5, 'permintaan pertemanan', '1', 27, 0),
(154, 7, 5, 'permintaan pertemanan', '1', 28, 0),
(155, 5, 7, 'Permintaan pertemanan disetujui', '0', 28, 0),
(156, 1, 7, 'lihatprofile', '0', 0, 0),
(157, 1, 7, 'lihatprofile', '0', 0, 0),
(158, 1, 7, 'lihatprofile', '0', 0, 0),
(159, 1, 7, 'Like', '0', 0, 0),
(160, 1, 7, 'lihatprofile', '0', 0, 0),
(161, 1, 5, 'lihatprofile', '0', 0, 0),
(162, 1, 7, 'lihatprofile', '0', 0, 0),
(163, 1, 9, 'permintaan pertemanan', '1', 29, 0),
(164, 7, 9, 'Permintaan pertemanan disetujui', '0', 19, 0),
(165, 5, 9, 'Permintaan pertemanan disetujui', '0', 27, 0),
(166, 9, 1, 'Permintaan pertemanan disetujui', '0', 29, 0),
(167, 1, 9, 'lihatprofile', '0', 0, 0),
(168, 1, 9, 'lihatprofile', '0', 0, 0),
(169, 1, 9, 'lihatprofile', '0', 0, 0),
(170, 2, 1, 'lihatprofile', '0', 0, 0),
(171, 2, 1, 'lihatprofile', '0', 0, 0),
(172, 6, 1, 'lihatprofile', '0', 0, 0),
(173, 2, 1, 'lihatprofile', '0', 0, 0),
(174, 3, 1, 'permintaan pertemanan', '1', 30, 0),
(175, 1, 3, 'Permintaan pertemanan disetujui', '0', 30, 0),
(176, 1, 3, 'lihatprofile', '0', 0, 0),
(177, 2, 1, 'lihatprofile', '0', 0, 0),
(178, 10, 1, 'lihatprofile', '0', 0, 0),
(179, 2, 1, 'lihatprofile', '0', 0, 0),
(180, 3, 1, 'lihatprofile', '0', 0, 0),
(181, 3, 1, 'lihatprofile', '0', 0, 0),
(182, 3, 1, 'lihatprofile', '0', 0, 0),
(183, 2, 1, 'lihatprofile', '0', 0, 0),
(184, 2, 1, 'lihatprofile', '0', 0, 0),
(185, 1, 2, 'lihatprofile', '0', 0, 0),
(186, 1, 2, 'lihatprofile', '0', 0, 0),
(187, 1, 2, 'lihatprofile', '0', 0, 0),
(188, 1, 2, 'lihatprofile', '0', 0, 0),
(189, 1, 2, 'lihatprofile', '0', 0, 0),
(190, 1, 2, 'lihatprofile', '0', 0, 0),
(191, 1, 2, 'lihatprofile', '0', 0, 0),
(192, 1, 2, 'lihatprofile', '0', 0, 0),
(193, 2, 1, 'lihatprofile', '0', 0, 0),
(194, 2, 1, 'lihatprofile', '0', 0, 0),
(195, 2, 1, 'lihatprofile', '0', 0, 0),
(196, 3, 1, 'lihatprofile', '0', 0, 0),
(197, 2, 1, 'lihatprofile', '0', 0, 0),
(198, 3, 1, 'lihatprofile', '0', 0, 0),
(199, 2, 1, 'lihatprofile', '0', 0, 0),
(200, 2, 1, 'lihatprofile', '0', 0, 0),
(201, 3, 1, 'lihatprofile', '0', 0, 0),
(202, 2, 1, 'lihatprofile', '0', 0, 0),
(203, 2, 1, 'lihatprofile', '0', 0, 0),
(204, 2, 1, 'lihatprofile', '0', 0, 0),
(205, 2, 1, 'lihatprofile', '0', 0, 0),
(206, 2, 1, 'lihatprofile', '0', 0, 0),
(207, 2, 1, 'lihatprofile', '0', 0, 0),
(208, 2, 1, 'lihatprofile', '0', 0, 0),
(209, 3, 1, 'lihatprofile', '0', 0, 0),
(210, 1, 1, 'Komentar', '0', 0, 0),
(211, 1, 1, 'Komentar', '0', 0, 0),
(212, 1, 1, 'Komentar', '0', 0, 0),
(213, 2, 1, 'lihatprofile', '0', 0, 0),
(214, 3, 3, 'Komentar', '0', 0, 0),
(215, 3, 3, 'Komentar', '0', 0, 0),
(216, 2, 7, 'permintaan pertemanan', '0', 31, 0),
(217, 1, 2, 'lihatprofile', '0', 0, 0),
(218, 2, 1, 'lihatprofile', '0', 0, 0),
(219, 2, 1, 'lihatprofile', '0', 0, 0),
(220, 2, 1, 'lihatprofile', '0', 0, 0),
(221, 2, 1, 'lihatprofile', '0', 0, 0),
(222, 1, 2, 'lihatprofile', '0', 0, 0),
(223, 1, 2, 'lihatprofile', '0', 0, 0),
(224, 1, 2, 'lihatprofile', '0', 0, 0),
(225, 1, 2, 'lihatprofile', '0', 0, 0),
(226, 1, 2, 'lihatprofile', '0', 0, 0),
(227, 1, 2, 'lihatprofile', '0', 0, 0),
(228, 1, 2, 'lihatprofile', '0', 0, 0),
(229, 1, 2, 'lihatprofile', '0', 0, 0),
(230, 1, 2, 'lihatprofile', '0', 0, 0),
(231, 1, 2, 'lihatprofile', '0', 0, 0),
(232, 1, 2, 'lihatprofile', '0', 0, 0),
(233, 1, 2, 'lihatprofile', '0', 0, 0),
(234, 1, 2, 'lihatprofile', '0', 0, 0),
(235, 1, 2, 'lihatprofile', '0', 0, 0),
(236, 1, 2, 'lihatprofile', '0', 0, 0),
(238, 1, 2, 'lihatprofile', '0', 0, 0),
(239, 1, 2, 'lihatprofile', '0', 0, 0),
(240, 1, 2, 'lihatprofile', '0', 0, 0),
(241, 1, 2, 'lihatprofile', '0', 0, 0),
(242, 1, 2, 'lihatprofile', '0', 0, 0),
(243, 3, 1, 'lihatprofile', '0', 0, 0),
(244, 3, 1, 'lihatprofile', '0', 0, 0),
(245, 2, 1, 'lihatprofile', '0', 0, 0),
(246, 2, 1, 'lihatprofile', '0', 0, 0),
(247, 3, 1, 'lihatprofile', '0', 0, 0),
(248, 1, 2, 'lihatprofile', '0', 0, 0),
(249, 3, 1, 'lihatprofile', '0', 0, 0),
(250, 3, 1, 'lihatprofile', '0', 0, 0),
(251, 2, 1, 'lihatprofile', '0', 0, 0),
(252, 2, 1, 'lihatprofile', '0', 0, 0),
(253, 2, 1, 'lihatprofile', '0', 0, 0),
(254, 2, 1, 'lihatprofile', '0', 0, 0),
(255, 2, 1, 'lihatprofile', '0', 0, 0),
(256, 2, 1, 'lihatprofile', '0', 0, 0),
(257, 2, 1, 'lihatprofile', '0', 0, 0),
(258, 2, 1, 'lihatprofile', '0', 0, 0),
(259, 2, 1, 'lihatprofile', '0', 0, 0),
(260, 2, 1, 'lihatprofile', '0', 0, 0),
(261, 2, 1, 'lihatprofile', '0', 0, 0),
(262, 2, 1, 'lihatprofile', '0', 0, 0),
(263, 2, 1, 'lihatprofile', '0', 0, 0),
(264, 2, 1, 'lihatprofile', '0', 0, 0),
(265, 2, 1, 'lihatprofile', '0', 0, 0),
(266, 2, 1, 'lihatprofile', '0', 0, 0),
(267, 2, 1, 'lihatprofile', '0', 0, 0),
(268, 2, 1, 'lihatprofile', '0', 0, 0),
(269, 2, 1, 'lihatprofile', '0', 0, 0),
(270, 2, 1, 'lihatprofile', '0', 0, 0),
(271, 2, 1, 'lihatprofile', '0', 0, 0),
(272, 2, 1, 'lihatprofile', '0', 0, 0),
(273, 9, 1, 'lihatprofile', '0', 0, 0),
(274, 5, 1, 'lihatprofile', '0', 0, 0),
(275, 3, 1, 'lihatprofile', '0', 0, 0),
(276, 2, 1, 'lihatprofile', '0', 0, 0),
(277, 2, 1, 'lihatprofile', '0', 0, 0),
(278, 2, 1, 'lihatprofile', '0', 0, 0),
(279, 2, 1, 'lihatprofile', '0', 0, 0),
(280, 2, 1, 'lihatprofile', '0', 0, 0),
(281, 2, 1, 'lihatprofile', '0', 0, 0),
(282, 2, 1, 'lihatprofile', '0', 0, 0),
(283, 2, 1, 'lihatprofile', '0', 0, 0),
(284, 2, 1, 'lihatprofile', '0', 0, 0),
(285, 2, 1, 'lihatprofile', '0', 0, 0),
(286, 2, 1, 'lihatprofile', '0', 0, 0),
(287, 2, 1, 'lihatprofile', '0', 0, 0),
(288, 2, 1, 'lihatprofile', '0', 0, 0),
(289, 2, 1, 'lihatprofile', '0', 0, 0),
(290, 2, 1, 'lihatprofile', '0', 0, 0),
(291, 2, 1, 'lihatprofile', '0', 0, 0),
(292, 2, 1, 'lihatprofile', '0', 0, 0),
(293, 2, 1, 'lihatprofile', '0', 0, 0),
(294, 2, 1, 'Komentar', '0', 0, 0),
(295, 2, 1, 'lihatprofile', '0', 0, 0),
(296, 2, 1, 'Komentar', '0', 0, 0),
(297, 1, 1, 'Komentar', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(255) NOT NULL,
  `isi` varchar(100) NOT NULL,
  `iduser` int(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `isi`, `iduser`, `gambar`) VALUES
(2, 'Lelah sekali hari ini', 1, ''),
(8, 'Ayo maen PES kawan', 2, ''),
(9, 'Pusing kena FAI', 2, ''),
(10, 'halo nama saya richard', 1, ''),
(11, 'Main PUBG dulu boy', 3, ''),
(12, 'djordi is cancer @djordi123@gmail.com', 1, ''),
(18, 'tim beli in pubg @timo@gmail.com', 1, ''),
(20, 'Hai intro @dummy', 1, ''),
(21, 'jes @jesslyn@gmail.com', 3, ''),
(25, 'Lelah sekali hari ini Shared from @timo@gmail.com', 3, ''),
(32, 'jes mau tanya @jesslyn@gmail.com', 1, ''),
(33, 'tim ayo main pubg', 1, ''),
(34, 'dota is now in new patch', 1, ''),
(35, 'FAI membuat saya capek', 1, ''),
(36, 'Saya bingung dengan error FAI yang satu ini', 1, ''),
(37, 'Hari ini sangat melelahkan', 1, ''),
(38, 'Kali Linuxxx', 1, '5017b6eb00603db717d605171fa21ef9.png');

-- --------------------------------------------------------

--
-- Table structure for table `readchat`
--

CREATE TABLE `readchat` (
  `id_readchat` int(255) NOT NULL,
  `id_chat` int(255) NOT NULL,
  `iduser` int(255) NOT NULL,
  `isread` int(255) NOT NULL,
  `isvisible` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `readchat`
--

INSERT INTO `readchat` (`id_readchat`, `id_chat`, `iduser`, `isread`, `isvisible`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 3, 1, 0),
(3, 2, 1, 1, 1),
(4, 2, 3, 1, 0),
(5, 3, 1, 1, 1),
(6, 3, 3, 1, 0),
(7, 4, 1, 1, 1),
(8, 4, 3, 1, 0),
(9, 5, 1, 1, 1),
(10, 5, 3, 1, 0),
(11, 5, 2, 1, 1),
(12, 6, 1, 1, 1),
(13, 6, 2, 1, 1),
(14, 6, 3, 1, 1),
(15, 7, 1, 1, 1),
(16, 7, 2, 1, 1),
(17, 8, 1, 1, 1),
(18, 8, 2, 1, 1),
(19, 9, 5, 0, 1),
(20, 9, 1, 1, 1),
(21, 10, 1, 1, 1),
(22, 10, 2, 1, 1),
(23, 11, 1, 1, 1),
(24, 11, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id_shop` int(255) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `price` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `gambar` varchar(1000) NOT NULL,
  `kota` varchar(1000) NOT NULL,
  `iduser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id_shop`, `nama`, `price`, `qty`, `gambar`, `kota`, `iduser`) VALUES
(1, 'PUBG_Game_Steam', 199000, 10, 'PUBG.jpg', 'Surabaya', 3),
(2, 'CSGO_Game', 99000, 0, 'csgo.png', 'Surabaya', 3),
(3, 'Black_Desert_Games', 400000, 4, 'black_dessert.jpg', 'Surabaya', 2);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id_skill` int(255) NOT NULL,
  `id_jnsskill` int(255) NOT NULL,
  `iduser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id_skill`, `id_jnsskill`, `iduser`) VALUES
(2, 3, 1),
(3, 4, 1),
(4, 5, 1),
(8, 1, 1),
(9, 2, 1),
(10, 1, 3),
(11, 2, 3),
(12, 7, 3),
(13, 4, 3),
(14, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(255) NOT NULL,
  `namad` varchar(50) NOT NULL,
  `namab` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `negara` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `bioperusahaan` varchar(100) NOT NULL,
  `biouser` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL,
  `isprivate` int(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `music` varchar(255) DEFAULT NULL,
  `verified` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namad`, `namab`, `email`, `hp`, `password`, `alamat`, `kodepos`, `negara`, `jabatan`, `perusahaan`, `bioperusahaan`, `biouser`, `status`, `isprivate`, `gambar`, `music`, `verified`) VALUES
(1, 'Richard', 'Sugiarto', 'zdio7635@gmail.com', '081333317150', '123aS@', 'kertajaya', '60116', 'Indonesia', 'gtw', 'gtw', 'gtw', 'gtw', '0', 0, 'u1.png', '', ''),
(2, 'Setiawan', 'Djordi', 'djordi123@gmail.com', '081123123123', '123aS@', 'kertajaya', '60116', 'Indonesia', 'manager', 'ggggg', 'GTW', 'GTW', '1', 0, '', '', ''),
(3, 'Timotius', 'Tirtawan', 'timo@gmail.com', '081678678678', '123aS@', 'Dharmo', '60116', 'Indonesia', 'direktur', 'kacang garing', '', '', '1', 1, '', '', '1'),
(5, 'Jesslyn', 'CH', 'jesslyn@gmail.com', '081123123123', '123aS@', 'petemon', '60116', 'Indonesia', 'sekretaris', 'lab stts', 'tidak ada', 'tidak ada', '1', 1, '', '', ''),
(6, 'Raymond', 'Novando', 'raymond@gmail.com', '081678678678', '123aS@', 'manyar', '60116', 'Indonesia', 'manager', 'testing', '', '', '1', 0, '', '', ''),
(7, 'Theo', 'Tirtandari', 'theo@gmail.com', '081678678678', '123aS@', 'tirtomanyar', '60116', 'Indonesia', 'direktur', 'kacang', '', '', '1', 0, '', '', ''),
(8, 'Josef', 'Christian', 'josef@gmail.com', '081123123123', '123aS@', 'ngangel', '60116', 'Indonesia', 'asisten', 'stts', '', '', '1', 0, '', '', ''),
(9, 'Yoel', 'Vinandra', 'yoel@gmail.com', '081123123123', '123aS@', 'kertajaya', '60116', 'Indonesia', 'sales', 'kkr', '', '', '1', 0, '', '', ''),
(10, 'Jefry', 'Tanwijaya', 'jefry@gmail.com', '081678678678', '123aS@', 'Mulyosari', '60116', 'Indonesia', 'Direktur', '1kd', '', '', '1', 0, '', '', ''),
(11, 'William', 'Surya', 'william@gmail.com', '081444444444', '123aS@', 'ngangel selatan', '60116', 'Indonesia', 'Manager', 'khk', '', '', '1', 0, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `chatmember`
--
ALTER TABLE `chatmember`
  ADD PRIMARY KEY (`id_chatmember`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id_chatroom`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idcomment`);

--
-- Indexes for table `endorsement`
--
ALTER TABLE `endorsement`
  ADD PRIMARY KEY (`id_endorsement`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`idfriend`);

--
-- Indexes for table `jnsskill`
--
ALTER TABLE `jnsskill`
  ADD PRIMARY KEY (`id_jnsskill`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`idnotif`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `readchat`
--
ALTER TABLE `readchat`
  ADD PRIMARY KEY (`id_readchat`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id_shop`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id_skill`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chatmember`
--
ALTER TABLE `chatmember`
  MODIFY `id_chatmember` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id_chatroom` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `idcomment` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `endorsement`
--
ALTER TABLE `endorsement`
  MODIFY `id_endorsement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `idfriend` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jnsskill`
--
ALTER TABLE `jnsskill`
  MODIFY `id_jnsskill` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `idnotif` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `readchat`
--
ALTER TABLE `readchat`
  MODIFY `id_readchat` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id_shop` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id_skill` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
