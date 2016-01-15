-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2016 at 05:48 PM
-- Server version: 5.6.27-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canvas`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `userid`, `name`, `password`) VALUES
(3, 1, '5698c6d3e5e97.png', 'a3f0bec59cebeb60553e'),
(4, 1, '5698c7378baa6.png', '09b06cc28c85d5325791'),
(5, 1, '5698c8f65896b.png', '1728efbda81692282ba6'),
(6, 1, '5698c950c4681.png', 'c8e812b716d764690e3a'),
(7, 1, '5698c955e1a34.png', '3621f1454cacf995530e'),
(8, 1, '5698c960cd06f.png', '1728efbda81692282ba6'),
(9, 1, '5698c963e7795.png', '39c585848e2f3fa70a9e'),
(10, 1, '5698c97331912.png', 'f36645ded531138a9212'),
(11, 1, '5698ca751f553.png', '5875221a0f30c6ee5dc4'),
(12, 1, '5698ca97a5f65.png', 'ab233b682ec355648e78'),
(13, 1, '5698cab0a84eb.png', '65d90fc6d307590b14e9'),
(14, 1, '5698caca4356a.png', 'dd5680e704d370c81c83'),
(15, 1, '5698cb1f732fa.png', 'd459adb16ee458dbd494'),
(16, 1, '5698cb36730b4.png', 'd592214d7f4b62c39c4c'),
(17, 1, '5698cc02dab29.png', '6ff81213f4309e6d2fcf'),
(18, 1, '5698cc2add726.png', '8ecfd4862a75c60d98d5'),
(19, 1, '5698ccc6354fd.png', 'd459adb16ee458dbd494'),
(20, 1, '5698cdc39b9cd.png', '69d8bc9bd967e2da4e05'),
(21, 1, '5698cdde2c1d1.png', 'b5889ce7d53f4379b87b'),
(22, 1, '5698ceb0d4b07.png', '63347f5d946164a23fac'),
(23, 1, '5698cebee62b6.png', '838ece1033bf7c7468e8'),
(24, 1, '5698cee86ad46.png', '2070e4cfb8f24209647d'),
(25, 1, '5698ceec5e212.png', 'cb7bf7efa6d652046abd'),
(26, 1, '5698db7d36a33.png', '8ecfd4862a75c60d98d5'),
(27, 1, '5698dbd6463c0.png', '27c36e650f63a42a51aa'),
(28, 1, '5698dc0fd6cb7.png', '7d70663568cac5af6845'),
(29, 1, '5698dea09b5a9.png', '83bec07142435dc3a070'),
(30, 1, '5698dead921d4.png', '7aa6b6e69f16a93101bc'),
(31, 1, '5698dedbed07e.png', '71f75f92d8946eea102a'),
(32, 1, '5698e43d54c4d.png', 'b16c29f8a364bc697032'),
(33, 1, '5698e44920251.png', 'df6d2338b2b8fce1ec2f'),
(34, 1, '5698e57447d3e.png', 'd592214d7f4b62c39c4c'),
(35, 1, '5698eb0364468.png', '0d1822f0b87b994093fd'),
(36, 1, '5698eb17561a6.png', '04159afa219c56abc29e'),
(37, 1, '5698ed69d5c20.png', '2a4034af2835a22fec9f'),
(38, 1, '5698fdfc7abfc.png', '202cb962ac59075b964b'),
(39, 1, '5698fe3d0fb93.png', '250cf8b51c773f3f8dc8'),
(40, 1, '5699002f4ad2e.png', 'd81f9c1be2e08964bf9f24b15f0e4900'),
(41, 1, '56990350e26e6.png', '827ccb0eea8a706c4c34a16891f84e7b'),
(42, 1, '569904cc05e7c.png', '37a6259cc0c1dae299a7866489dff0bd'),
(43, 1, '569904db520ca.png', '6c14da109e294d1e8155be8aa4b1ce8e'),
(44, 1, '569905325e05f.png', '250cf8b51c773f3f8dc8b4be867a9a02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
