-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2016 at 04:27 AM
-- Server version: 5.6.24
-- PHP Version: 5.4.41

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `youtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `fcID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `fID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`fcID`, `uID`, `fID`) VALUES
(1, 1, 2),
(2, 1, 2),
(3, 1, 2),
(4, 1, 2),
(5, 1, 2),
(6, 1, 4),
(7, 1, 4),
(8, 1, 4),
(9, 1, 4),
(10, 1, 101),
(11, 1, 101),
(12, 1, 101),
(13, 1, 101),
(14, 1, 2),
(15, 1, 4),
(16, 1, 4),
(18, 1, 9),
(19, 1, 9),
(20, 1, 9),
(21, 1, 9),
(22, 1, 9),
(23, 1, 9),
(24, 1, 9),
(25, 1, 9),
(26, 1, 9),
(27, 1, 16),
(28, 1, 39),
(29, 1, 39),
(30, 1, 4),
(31, 1, 99),
(32, 1, 97),
(33, 1, 95),
(36, 1, 2),
(37, 1, 2),
(38, 1, 17),
(39, 1, 17),
(40, 1, 17),
(41, 1, 17),
(43, 1, 4),
(44, 1, 4),
(45, 1, 4),
(46, 1, 4),
(47, 1, 5),
(48, 1, 5),
(49, 1, 5),
(50, 1, 5),
(51, 1, 5),
(52, 1, 5),
(53, 1, 9),
(55, 1, 2),
(56, 1, 31),
(61, 1, 2),
(63, 1, 8),
(64, 1, 10),
(65, 1, 10),
(66, 1, 10),
(67, 1, 10),
(68, 1, 10),
(69, 1, 10),
(70, 1, 18),
(71, 1, 18),
(72, 1, 18),
(73, 1, 2),
(74, 1, 6),
(75, 1, 12),
(76, 1, 11),
(80, 1, 4),
(81, 1, 4),
(82, 1, 4),
(83, 1, 4),
(84, 1, 8),
(85, 1, 8),
(88, 1, 11),
(89, 1, 11),
(90, 1, 11),
(91, 1, 4),
(92, 1, 4),
(93, 1, 4),
(94, 1, 4),
(95, 1, 8),
(96, 1, 8),
(97, 1, 10),
(98, 1, 10),
(101, 1, 4),
(102, 1, 4),
(103, 1, 11),
(106, 1, 8),
(107, 1, 10),
(108, 1, 10),
(109, 1, 8),
(110, 1, 10),
(111, 1, 4),
(112, 1, 4),
(116, 1, 5),
(131, 1, 1),
(132, 1, 1),
(136, 1, 10),
(137, 1, 10),
(141, 1, 7),
(142, 1, 7),
(143, 1, 5),
(144, 1, 5),
(145, 1, 5),
(146, 1, 5),
(147, 1, 5),
(148, 1, 5),
(149, 1, 5),
(150, 1, 5),
(151, 1, 5),
(152, 1, 5),
(153, 1, 5),
(154, 1, 5),
(155, 1, 5),
(156, 1, 5),
(157, 1, 5),
(158, 1, 5),
(159, 1, 5),
(160, 1, 8),
(162, 1, 3),
(163, 1, 22),
(164, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE IF NOT EXISTS `playlists` (
  `pID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `pName` varchar(25) NOT NULL,
  `pDescription` varchar(125) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`pID`, `uID`, `pName`, `pDescription`, `likes`, `dislikes`) VALUES
(1, 1, 'Fav Videos', 'This playlist consists of my favourite videos!', 2, 0),
(2, 2, 'Friends', 'This playlist consists of my favourite videos to share with my friends', 11, 0),
(3, 2, 'Testing2', 'This is a playlist of my fav songs', 15, 0),
(4, 2, 'ONE', 'TESTING@@@@@@', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_videos`
--

CREATE TABLE IF NOT EXISTS `playlist_videos` (
  `pvId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `vId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist_videos`
--

INSERT INTO `playlist_videos` (`pvId`, `pId`, `vId`) VALUES
(225, 1, 2),
(226, 1, 7),
(227, 2, 7),
(228, 2, 4),
(229, 1, 4),
(230, 1, 6),
(231, 1, 5),
(232, 1, 9),
(233, 1, 1),
(234, 3, 7),
(235, 3, 4),
(236, 3, 1),
(237, 3, 2),
(238, 4, 7),
(239, 4, 6),
(240, 3, 10),
(241, 2, 5),
(242, 2, 2),
(243, 4, 2),
(244, 2, 1),
(245, 4, 5),
(246, 3, 5),
(247, 2, 12),
(248, 4, 1),
(249, 4, 3),
(250, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uID` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `name` varchar(45) NOT NULL,
  `about` varchar(120) DEFAULT NULL,
  `avatar` varchar(20) DEFAULT 'default.png',
  `gender` tinyint(4) DEFAULT '1',
  `auth` varchar(50) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uID`, `email`, `name`, `about`, `avatar`, `gender`, `auth`, `start_date`, `password`) VALUES
(1, 'JamesWainwright@gmail.com', 'James Wainwright', 'James is really cool', 'default.png', NULL, NULL, '0000-00-00 00:00:00', ''),
(2, 'SAMMY@gmail.com', 'SAM SMITH', 'Sam is really cool', 'sam_2.jpg', 1, 'test', '0000-00-00 00:00:00', 'root'),
(3, 'hello@h.com', 'Hello', 'TESTING TESTING', 'default.png', NULL, NULL, '0000-00-00 00:00:00', ''),
(4, 'justo@facilisi.co.uk', 'Reagan Burke', 'rutrum lorem', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(5, 'euismod.ac.fermentum@lacusvestibulum.org', 'Orli K. Coffey', 'Curabitur sed tortor. Integer', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(6, 'Sed.neque@elit.com', 'Jermaine Castaneda', 'interdum. Curabitur dictum. Phasellus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(7, 'egestas@Maecenas.ca', 'Oleg P. Case', 'diam nunc, ullamcorper eu,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(8, 'Cras@temporest.net', 'Whoopi Bennett', 'leo.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(9, 'Fusce.mollis@mattisornare.edu', 'Xanthus F. French', 'ipsum ac mi', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(10, 'purus@quis.net', 'Isabelle Z. Alvarez', 'vehicula risus. Nulla eget', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(11, 'risus@leoCras.net', 'Hyatt R. Whitaker', 'nisl. Maecenas malesuada fringilla est.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(12, 'ac.mattis@magnisdisparturient.edu', 'Berk S. Patel', 'ut dolor dapibus gravida. Aliquam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(13, 'vulputate.eu.odio@estMauris.com', 'Sacha J. Hoffman', 'posuere at, velit.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(14, 'non.quam@elitpharetra.com', 'Abel Andrews', 'consequat purus. Maecenas libero est,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(15, 'Quisque@Vivamusnon.org', 'Abigail U. Wells', 'eget laoreet', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(16, 'tincidunt.Donec@liberoProinmi.co.uk', 'Prescott Mendoza', 'egestas.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(17, 'mi.lorem.vehicula@nonmagna.net', 'Clio U. Solis', 'et malesuada fames ac turpis', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(18, 'pretium.aliquet.metus@gravidanunc.edu', 'Martena Cohen', 'neque', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(19, 'eget@tellusAenean.com', 'Micah Z. Vasquez', 'mi,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(20, 'sagittis@magnaDuis.net', 'Hyacinth S. Carrillo', 'ligula.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(21, 'ultrices.posuere.cubilia@justositamet.org', 'Amos X. Montgomery', 'mi. Duis', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(22, 'dui.lectus@Loremipsumdolor.net', 'May Roach', 'elit. Etiam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(23, 'sollicitudin@risus.co.uk', 'Gil Y. Williamson', 'ligula elit, pretium', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(24, 'est.Mauris@ultricesposuerecubilia.org', 'Noelle Daniels', 'egestas. Aliquam nec enim. Nunc', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(25, 'enim@semperdui.com', 'Leilani L. Richard', 'aliquet', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(26, 'at.risus.Nunc@duinecurna.com', 'Zenia Cox', 'netus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(27, 'dui.Fusce@Quisque.net', 'Rama Patterson', 'egestas rhoncus. Proin nisl sem,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(28, 'vestibulum.neque@Nullasempertellus.org', 'Kenneth Alford', 'congue, elit sed consequat auctor,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(29, 'Sed.congue@vestibulumnequesed.com', 'Willa K. Price', 'mi, ac', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(30, 'Nunc.lectus.pede@anteNuncmauris.co.uk', 'Jolie A. Little', 'aliquet libero.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(31, 'eu@dictum.net', 'Colton L. Banks', 'urna justo faucibus lectus, a', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(32, 'et@Sedidrisus.org', 'Ahmed Obrien', 'tristique aliquet. Phasellus fermentum convallis', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(33, 'nonummy@acturpis.com', 'Trevor Myers', 'Donec vitae erat', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(34, 'enim@quamdignissimpharetra.com', 'Eleanor O. Skinner', 'diam lorem, auctor', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(35, 'nisl@Aliquamvulputateullamcorper.net', 'Jeanette X. Olson', 'faucibus. Morbi vehicula. Pellentesque tincidunt', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(36, 'fermentum.risus@mauriserateget.net', 'Kimberly Hall', 'Lorem ipsum dolor sit', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(37, 'lectus.convallis@massaInteger.org', 'Wallace B. Heath', 'urna et', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(38, 'non.lorem.vitae@euismodurna.org', 'Ria Clarke', 'leo. Vivamus nibh dolor, nonummy', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(39, 'consequat.purus.Maecenas@nibhDonecest.com', 'Abra Padilla', 'facilisi. Sed neque. Sed eget', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(40, 'purus.ac.tellus@temporarcuVestibulum.ca', 'Grant Robles', 'vitae dolor. Donec', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(41, 'ipsum@cubiliaCuraePhasellus.edu', 'Brittany Hunt', 'ac metus vitae velit egestas', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(42, 'a@egestasFusce.com', 'Noelle Hickman', 'egestas blandit. Nam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(43, 'vulputate@Nuncac.edu', 'Candice Oneill', 'augue.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(44, 'id.nunc@commodoipsumSuspendisse.org', 'Jolie D. Rose', 'Nunc mauris. Morbi', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(45, 'penatibus.et@Cumsociisnatoque.com', 'Darius Davenport', 'consequat enim diam vel', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(46, 'in.dolor.Fusce@nulla.ca', 'Quamar A. Smith', 'id', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(47, 'mauris.eu.elit@arcuvelquam.com', 'Lev Mcbride', 'Morbi accumsan laoreet ipsum. Curabitur', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(48, 'mauris.erat.eget@velfaucibus.net', 'Karleigh Stokes', 'Phasellus nulla.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(49, 'varius@imperdietnon.ca', 'Whoopi Dickerson', 'neque. Nullam nisl.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(50, 'ut.nisi@tinciduntaliquamarcu.org', 'Liberty B. Farmer', 'Aenean gravida nunc sed', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(51, 'pellentesque.a.facilisis@velvulputate.edu', 'Quin Terrell', 'turpis. Nulla aliquet. Proin velit.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(52, 'sed@sapiencursusin.net', 'Rhoda Todd', 'bibendum fermentum metus. Aenean sed', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(53, 'Vivamus.nisi.Mauris@idmagnaet.org', 'Imelda Bauer', 'sed, hendrerit a,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(54, 'orci.Ut.sagittis@Morbivehicula.com', 'Kiayada Evans', 'eu erat semper rutrum. Fusce', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(55, 'quam.Pellentesque.habitant@ornareegestas.org', 'Clio Barnett', 'litora torquent per conubia', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(56, 'diam.Duis.mi@feugiatLorem.org', 'Melissa K. Beasley', 'non,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(57, 'Donec@ipsumdolorsit.ca', 'Buffy Bradley', 'lacus.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(58, 'elit.Curabitur.sed@Nullamvitae.edu', 'Louis S. Macias', 'elit. Aliquam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(59, 'montes@Aeneanegestashendrerit.com', 'Kamal N. Santana', 'Vivamus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(60, 'euismod.et@ante.co.uk', 'Drew S. Solis', 'ipsum. Suspendisse sagittis. Nullam vitae', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(61, 'mauris.Suspendisse@Fuscealiquamenim.co.uk', 'Rhiannon Gray', 'vel', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(62, 'odio.semper@Curabiturvellectus.ca', 'Chava O. Whitney', 'Mauris blandit', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(63, 'luctus@nonegestasa.co.uk', 'Adena V. Harper', 'pede', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(64, 'iaculis@montesnasceturridiculus.edu', 'Rashad Duncan', 'fermentum metus. Aenean sed pede', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(65, 'tortor.at.risus@adipiscingligulaAenean.ca', 'Flynn Drake', 'vitae aliquam eros', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(66, 'vulputate.mauris.sagittis@Donec.ca', 'Cassady H. Richmond', 'mi. Aliquam gravida', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(67, 'eu@Fuscealiquet.com', 'Orla Booker', 'erat vitae risus. Duis a', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(68, 'enim@eudolor.ca', 'Dalton Hood', 'lacinia vitae, sodales', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(69, 'ut.pharetra.sed@auctor.co.uk', 'Aquila L. Alvarez', 'nec, imperdiet nec,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(70, 'sed.dui@aenimSuspendisse.org', 'Fletcher Burke', 'non', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(71, 'accumsan@pharetrased.com', 'Keelie Collins', 'est, mollis non, cursus non,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(72, 'diam@dictumeuplacerat.org', 'Sasha Chapman', 'a, dui. Cras', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(73, 'a.odio@velit.edu', 'Zane Mason', 'Cum sociis natoque', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(74, 'ultrices@lacusAliquam.edu', 'Cally D. Stephens', 'orci lacus vestibulum lorem,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(75, 'vel@dolor.co.uk', 'Macaulay Montoya', 'nisi sem semper erat, in', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(76, 'odio.sagittis@luctusCurabituregestas.ca', 'Evan B. Walls', 'lacus vestibulum', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(77, 'dapibus.id.blandit@Donecporttitor.co.uk', 'Mira E. Rush', 'sed orci', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(78, 'mi@mauris.co.uk', 'Alexis Macdonald', 'vehicula risus. Nulla', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(79, 'ipsum.Phasellus.vitae@tinciduntpedeac.com', 'Dacey Wong', 'Vestibulum ante ipsum primis', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(80, 'consequat.lectus.sit@orciUtsemper.com', 'Charles Berger', 'venenatis vel, faucibus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(81, 'mollis@Integereulacus.org', 'Colton Vaughn', 'quam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(82, 'metus.facilisis@tempusrisus.ca', 'Allistair R. Meadows', 'ullamcorper', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(83, 'Cras.vulputate.velit@molestietellusAenean.co.uk', 'Cameron I. Hewitt', 'est tempor bibendum. Donec', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(84, 'malesuada.Integer.id@nibhdolor.net', 'Montana A. Hahn', 'lobortis', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(85, 'lobortis.quam.a@sagittisDuis.org', 'Serena Kelly', 'vel', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(86, 'iaculis.quis.pede@vel.net', 'Keelie Morgan', 'rutrum. Fusce dolor quam, elementum', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(87, 'amet@estacfacilisis.edu', 'Hayley Myers', 'mauris. Suspendisse', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(88, 'facilisis.non.bibendum@orcitinciduntadipiscing.org', 'Jonas S. Hood', 'nec urna', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(89, 'sodales.purus.in@morbitristiquesenectus.com', 'Haley V. Montgomery', 'lacus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(90, 'ornare.egestas@Nullam.net', 'Nelle O. Buchanan', 'odio. Phasellus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(91, 'magna@musProinvel.co.uk', 'Alana Randall', 'sed sem egestas blandit. Nam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(92, 'lectus.sit.amet@DonecestNunc.ca', 'Sonya Delacruz', 'ac, fermentum', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(93, 'nunc@semperrutrum.net', 'Tanya X. Mclaughlin', 'magna.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(94, 'sodales@dictummagna.ca', 'Castor D. Larsen', 'Quisque imperdiet,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(95, 'Class@duisemper.edu', 'Barrett Boyle', 'Pellentesque habitant morbi', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(96, 'erat@condimentumegetvolutpat.net', 'Roary Steele', 'In condimentum. Donec at', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(97, 'enim.Sed.nulla@nonmagnaNam.co.uk', 'Lyle P. Sherman', 'magna. Suspendisse tristique neque', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(98, 'magnis@Duis.ca', 'Joel Marshall', 'gravida. Praesent eu', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(99, 'Sed.nulla.ante@eu.co.uk', 'Ann Z. Mcpherson', 'lectus. Nullam', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(100, 'Nulla.tincidunt@in.com', 'Ivor Q. Wilkerson', 'malesuada id, erat.', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(101, 'ac.metus.vitae@tellussemmollis.com', 'Lee D. Dalton', 'cursus', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(102, 'Nunc@nasceturridiculus.org', 'Moana T. Wheeler', 'tellus faucibus leo,', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(103, 'a.feugiat@Nuncpulvinararcu.edu', 'Shellie Riddle', 'est. Mauris', 'default.jpg', NULL, NULL, '0000-00-00 00:00:00', ''),
(104, 'james.23.40@hotmail.com', 'james', '1', 'default.png', 0, ' e91e42143771c0bb2b3ff4954894ddb4 ', '2015-08-12 01:39:01', ''),
(105, 'root@admin.com', 'root', 'test user', 'default.png', 0, ' 6fa29ad71988d26c809e48e3a64a4eff ', '2015-08-12 02:22:13', ''),
(106, 'root@root.com', 'root', 'This user has chosen not to leave a description', 'default.png', 0, ' 5f860984ff68ddf3a9aaebc9e3b8a8a3 ', '2015-08-12 02:25:54', 'root'),
(107, 'jameswain10@gmail.com', 'james wainwright', 'i am da siqesst', 'default.png', 1, ' 1b22c573847b2cd9a406c091d487be74 ', '2015-08-16 11:39:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `userLikedVideos`
--

CREATE TABLE IF NOT EXISTS `userLikedVideos` (
  `uID` int(11) NOT NULL,
  `vId` int(11) NOT NULL,
  `vote` smallint(6) DEFAULT NULL,
  `liked` int(11) DEFAULT '0',
  `dislikes` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userLikedVideos`
--

INSERT INTO `userLikedVideos` (`uID`, `vId`, `vote`, `liked`, `dislikes`) VALUES
(2, 5, 1, 43, 5),
(2, 3, 1, 31, 9),
(2, 1, 1, 37, 1),
(2, 2, 1, 77, 11),
(2, 6, 1, 14, 7),
(2, 8, 1, 26, 3),
(2, 4, 1, 15, 8),
(2, 7, 1, 21, 3),
(2, 9, 1, 14, 2),
(2, 10, 1, 13, 5),
(2, 11, 1, 21, 3),
(2, 12, 1, 10, 1),
(106, 2, 1, 3, 0),
(106, 1, 1, 2, 0),
(106, 3, 1, 1, 0),
(106, 6, 1, 1, 0),
(106, 7, 1, 1, 0),
(106, 11, 1, 4, 0),
(0, 1, 1, 1, 0),
(0, 2, 1, 1, 0),
(0, 3, 1, 2, 0),
(0, 4, 1, 1, 0),
(0, 5, 1, 1, 0),
(0, 6, 1, 3, 0),
(0, 7, 1, 1, 0),
(0, 8, 1, 2, 0),
(0, 9, 1, 1, 0),
(0, 10, 1, 2, 0),
(0, 11, 1, 1, 0),
(0, 12, 1, 1, 0),
(106, 4, 1, 1, 0),
(106, 5, 1, 1, 0),
(106, 8, 1, 1, 0),
(106, 9, 1, 1, 0),
(1, 3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE IF NOT EXISTS `user_post` (
  `postID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `post_data` varchar(200) DEFAULT NULL,
  `post_time` datetime DEFAULT NULL,
  `post_embed` varchar(30) DEFAULT 'embed'
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`postID`, `uID`, `post_data`, `post_time`, `post_embed`) VALUES
(47, 1, 'dsafe', '2015-07-25 18:35:51', 'embed'),
(52, 5, 'adasasd', '2015-07-25 23:04:41', 'embed'),
(60, 8, '', '2015-07-26 13:08:36', 'embed'),
(63, 22, 'h', '2015-07-26 20:59:40', 'embed'),
(67, 2, 'hello', '2015-07-31 23:12:27', 'embed'),
(68, 2, 'vasssup', '2015-07-31 23:12:39', 'embed'),
(69, 2, 'vasssup', '2015-07-31 23:27:38', 'embed'),
(73, 2, 'Bdd', '2015-08-03 14:39:29', 'zJFKKB1b5Ss'),
(74, 2, '', '2015-08-04 15:16:39', 'r9MnsFBXl-c'),
(75, 2, 'Teest', '2015-08-07 16:51:24', 'H-dV3hnK5FI'),
(76, 2, '', '2015-08-07 17:08:27', 'zJFKKB1b5Ss'),
(100, 2, 'null', '2015-08-12 17:15:55', 'r9MnsFBXl-c'),
(101, 106, 'asdasd', '2015-08-12 19:57:23', 'embed'),
(102, 106, 'dddd', '2015-08-12 19:57:26', 'embed'),
(103, 106, 'hey', '2015-08-15 10:41:47', 'embed'),
(104, 106, 'hay', '2015-08-15 10:41:50', 'embed'),
(105, 106, 'heeeey', '2015-08-15 10:41:53', 'embed'),
(106, 106, 'yoooo', '2015-08-15 10:41:57', 'embed'),
(107, 106, 'wasssup', '2015-08-15 10:42:00', 'embed'),
(108, 106, 'wasssup', '2015-08-15 10:42:06', 'embed'),
(109, 106, 'wasssup', '2015-08-15 10:42:17', 'embed'),
(110, 2, 'null', '2015-08-15 18:08:35', '5IwAcHqmF-w'),
(111, 106, 'Hey', '2015-10-15 13:49:12', 'embed'),
(112, 106, 'Hey', '2015-10-15 13:49:15', 'embed'),
(113, 106, 'This is a post!', '2016-10-18 15:24:40', 'embed'),
(114, 106, 'null', '2016-10-18 15:25:16', 'r9MnsFBXl-c');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `vId` int(11) NOT NULL,
  `vEmbed` varchar(80) NOT NULL,
  `vCat` varchar(45) NOT NULL,
  `likes` int(11) DEFAULT '0',
  `dislikes` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`vId`, `vEmbed`, `vCat`, `likes`, `dislikes`) VALUES
(1, 'zJFKKB1b5Ss', 'automotive', 151, 17),
(2, 'r9MnsFBXl-c', 'automotive,misc', 193, 36),
(3, 'gIlDiz2MA8o', 'surfing', 119, 22),
(4, 'tiqnN6rb92g', 'sports,surfing', 63, 24),
(5, 'H-dV3hnK5FI', 'cars,automotive', 106, 15),
(6, 'y1Fb7hK2Za4', 'automotive', 52, 21),
(7, 'mpGvgFLSMZw', 'surfing', 72, 25),
(8, 'PQrW0yMY1DE', 'comedy,sports', 62, 19),
(9, 'TBgxjhhm-14', 'comedy,sports,motivation,misc', 55, 15),
(10, 'GmzSdtfIu-E', 'cars,f1,automotive,gaming', 35, 6),
(11, '9GHPNKUMf70', 'talk show,comedy', 25, 3),
(12, '5IwAcHqmF-w', 'comedy, misc', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `video_comments`
--

CREATE TABLE IF NOT EXISTS `video_comments` (
  `cID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `vId` int(11) NOT NULL,
  `comment_data` varchar(200) DEFAULT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_comments`
--

INSERT INTO `video_comments` (`cID`, `uID`, `vId`, `comment_data`, `comment_date`) VALUES
(4, 1, 2, 'Test comment', '0000-00-00 00:00:00'),
(60, 1, 10, 'james', '0000-00-00 00:00:00'),
(61, 1, 6, 'this video ffin sucks\r\n', '0000-00-00 00:00:00'),
(62, 1, 10, 'this video ffin sucks\r\n', '0000-00-00 00:00:00'),
(64, 1, 1, 'yo', '0000-00-00 00:00:00'),
(65, 1, 9, 'yo', '0000-00-00 00:00:00'),
(86, 1, 7, 'james', '0000-00-00 00:00:00'),
(89, 1, 4, 'james is really cool', '0000-00-00 00:00:00'),
(93, 2, 3, 'jhbh', '0000-00-00 00:00:00'),
(99, 2, 10, 'hello', '0000-00-00 00:00:00'),
(100, 2, 10, 'ajasdasd', '0000-00-00 00:00:00'),
(102, 2, 11, 'Hello', '0000-00-00 00:00:00'),
(109, 2, 2, 'sdfadssdaf', '0000-00-00 00:00:00'),
(111, 2, 2, 'sdfadssdaf', '0000-00-00 00:00:00'),
(112, 2, 2, 'sdfadssdaf', '0000-00-00 00:00:00'),
(130, 2, 1, 'Hey', '0000-00-00 00:00:00'),
(131, 2, 5, 'test', '0000-00-00 00:00:00'),
(149, 2, 7, 'jo', '0000-00-00 00:00:00'),
(150, 2, 7, 'jo', '0000-00-00 00:00:00'),
(151, 2, 7, 'jo', '0000-00-00 00:00:00'),
(152, 2, 7, 'jo', '0000-00-00 00:00:00'),
(153, 2, 7, 'asdasd', '0000-00-00 00:00:00'),
(154, 2, 7, 'asdasd', '0000-00-00 00:00:00'),
(155, 2, 7, 'asdasd', '0000-00-00 00:00:00'),
(156, 2, 7, 'dsfasasfd', '0000-00-00 00:00:00'),
(157, 2, 7, 'dsfasasfd', '2015-08-07 21:48:37'),
(158, 2, 7, 'asdfasasfd', '2015-08-07 21:48:42'),
(159, 2, 7, 'HI', '2015-08-07 21:48:46'),
(160, 2, 7, 'HI', '2015-08-07 22:36:50'),
(161, 2, 7, 'HI', '2015-08-07 22:45:06'),
(162, 2, 7, 'HI', '2015-08-07 22:47:58'),
(163, 2, 7, 'HI', '2015-08-07 22:49:46'),
(164, 2, 7, 'HI', '2015-08-07 22:49:47'),
(165, 2, 7, 'HI', '2015-08-07 22:50:42'),
(166, 2, 7, 'HI', '2015-08-07 22:50:50'),
(167, 2, 7, 'HI', '2015-08-07 22:50:51'),
(168, 2, 7, 'HI', '2015-08-07 22:51:16'),
(169, 2, 7, 'HI', '2015-08-07 22:52:52'),
(170, 2, 7, 'HI', '2015-08-07 22:53:27'),
(171, 2, 7, 'HI', '2015-08-07 22:53:29'),
(172, 2, 7, 'HI', '2015-08-07 22:53:34'),
(173, 2, 7, 'HI', '2015-08-07 22:53:36'),
(174, 2, 7, 'HI', '2015-08-07 22:53:41'),
(175, 2, 7, 'HI', '2015-08-07 22:53:49'),
(176, 2, 7, 'HI', '2015-08-07 22:53:51'),
(177, 2, 7, 'HI', '2015-08-07 22:54:01'),
(178, 2, 7, 'HI', '2015-08-07 22:55:30'),
(179, 2, 7, 'HI', '2015-08-07 22:55:33'),
(180, 2, 7, 'HI', '2015-08-07 22:55:40'),
(181, 2, 7, 'HI', '2015-08-07 22:56:12'),
(182, 2, 7, 'HI', '2015-08-07 22:56:13'),
(183, 2, 7, 'HI', '2015-08-07 22:57:04'),
(184, 2, 7, 'HI', '2015-08-07 22:58:28'),
(185, 2, 7, 'HI', '2015-08-07 22:58:29'),
(186, 2, 7, 'HI', '2015-08-07 22:58:29'),
(187, 2, 7, 'HI', '2015-08-07 22:58:31'),
(188, 2, 7, 'HI', '2015-08-07 22:58:48'),
(189, 2, 7, 'HI', '2015-08-07 22:59:11'),
(190, 2, 7, 'HI', '2015-08-07 22:59:57'),
(191, 2, 7, 'HI', '2015-08-07 23:00:06'),
(192, 2, 7, 'HI', '2015-08-07 23:00:47'),
(193, 2, 7, 'HI', '2015-08-07 23:00:53'),
(194, 2, 7, 'HI', '2015-08-07 23:00:55'),
(195, 2, 7, 'HI', '2015-08-07 23:01:04'),
(196, 2, 7, 'HI', '2015-08-07 23:01:25'),
(197, 2, 7, 'HI', '2015-08-07 23:01:59'),
(198, 2, 7, 'HI', '2015-08-07 23:02:00'),
(199, 2, 7, 'HI', '2015-08-07 23:02:37'),
(200, 2, 7, 'HI', '2015-08-07 23:02:38'),
(201, 2, 7, 'HI', '2015-08-07 23:02:44'),
(202, 2, 7, 'HI', '2015-08-07 23:02:45'),
(203, 2, 7, 'HI', '2015-08-07 23:02:53'),
(204, 2, 7, 'HI', '2015-08-07 23:07:35'),
(205, 2, 7, 'HI', '2015-08-07 23:08:41'),
(206, 2, 7, 'HI', '2015-08-07 23:08:47'),
(207, 2, 7, 'HI', '2015-08-07 23:09:18'),
(208, 2, 7, 'HI', '2015-08-07 23:10:05'),
(209, 2, 7, 'HI', '2015-08-07 23:10:18'),
(210, 2, 7, 'HI', '2015-08-07 23:10:50'),
(211, 2, 7, 'HI', '2015-08-07 23:10:58'),
(212, 2, 7, 'HI', '2015-08-07 23:11:00'),
(213, 2, 7, 'HI', '2015-08-07 23:11:23'),
(214, 2, 7, 'HI', '2015-08-07 23:11:25'),
(215, 2, 7, 'HI', '2015-08-07 23:13:13'),
(216, 2, 7, 'HI', '2015-08-07 23:15:08'),
(217, 2, 7, 'HI', '2015-08-07 23:15:55'),
(218, 2, 7, 'HI', '2015-08-07 23:15:57'),
(219, 2, 7, 'HI', '2015-08-07 23:16:40'),
(220, 2, 7, 'HI', '2015-08-07 23:16:46'),
(221, 2, 7, 'HI', '2015-08-07 23:17:03'),
(222, 2, 7, 'HI', '2015-08-07 23:17:06'),
(223, 2, 7, 'HI', '2015-08-07 23:17:14'),
(224, 2, 7, 'HI', '2015-08-07 23:17:45'),
(225, 2, 7, 'HI', '2015-08-07 23:18:43'),
(226, 2, 7, 'HI', '2015-08-07 23:19:47'),
(227, 2, 7, 'HI', '2015-08-07 23:20:29'),
(228, 2, 7, 'HI', '2015-08-07 23:20:33'),
(229, 2, 7, 'HI', '2015-08-07 23:20:47'),
(230, 2, 7, 'HI', '2015-08-07 23:21:04'),
(231, 2, 7, 'HI', '2015-08-07 23:21:42'),
(232, 2, 7, 'HI', '2015-08-07 23:21:53'),
(233, 2, 7, 'HI', '2015-08-07 23:22:38'),
(234, 2, 7, 'HI', '2015-08-07 23:22:45'),
(235, 2, 7, 'HI', '2015-08-07 23:23:37'),
(236, 2, 7, 'HI', '2015-08-07 23:24:03'),
(237, 2, 7, 'HI', '2015-08-07 23:24:12'),
(238, 2, 7, 'HI', '2015-08-07 23:24:19'),
(239, 2, 7, 'HI', '2015-08-07 23:24:54'),
(240, 2, 7, 'HI', '2015-08-07 23:25:07'),
(241, 2, 7, 'HI', '2015-08-07 23:25:15'),
(242, 2, 7, 'HI', '2015-08-07 23:25:30'),
(244, 2, 1, 'ssssss', '2015-08-08 11:38:19'),
(245, 2, 10, 'heyyy', '2015-08-09 20:09:29'),
(247, 2, 7, 'aaaaaÃ¤a', '2015-08-09 20:09:52'),
(248, 2, 11, 'aaaaaÃ¤a', '2015-08-09 20:09:57'),
(249, 2, 1, 'kk', '2015-08-09 20:10:32'),
(250, 106, 12, 'hi', '2015-08-12 19:43:09'),
(251, 106, 9, 'hi', '2015-08-12 19:44:08'),
(252, 106, 6, 'hi', '2015-08-12 19:53:45'),
(253, 106, 9, 'hi', '2015-08-12 19:53:50'),
(254, 106, 8, 'hi', '2015-08-12 19:54:05'),
(255, 106, 12, 'tes', '2015-08-12 19:57:03'),
(256, 106, 11, 'sadasd', '2015-08-12 19:57:11'),
(257, 0, 2, 'AHAHA', '2015-08-12 21:33:39'),
(258, 0, 2, '///', '2015-08-12 22:06:25'),
(259, 0, 9, 'sa', '2015-08-15 10:52:06'),
(260, 0, 11, 'sasas', '2015-08-15 10:52:12'),
(261, 0, 4, 'sasas', '2015-08-15 12:04:48'),
(262, 2, 1, 'asdsadasdas', '2015-08-15 12:35:38'),
(263, 2, 1, 'sadfasdfasdf', '2015-08-15 12:35:42'),
(264, 106, 2, 'adfasdf', '2016-10-18 15:26:00'),
(265, 106, 2, 'this is a comment', '2016-10-18 15:26:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`fcID`),
  ADD KEY `FK_uID` (`uID`),
  ADD KEY `FK_fID` (`fID`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `playlist_videos`
--
ALTER TABLE `playlist_videos`
  ADD PRIMARY KEY (`pvId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uID`);

--
-- Indexes for table `userLikedVideos`
--
ALTER TABLE `userLikedVideos`
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`vId`);

--
-- Indexes for table `video_comments`
--
ALTER TABLE `video_comments`
  ADD PRIMARY KEY (`cID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `fcID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `playlist_videos`
--
ALTER TABLE `playlist_videos`
  MODIFY `pvId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `video_comments`
--
ALTER TABLE `video_comments`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=266;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `FK_fID` FOREIGN KEY (`fID`) REFERENCES `user` (`uID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_uID` FOREIGN KEY (`uID`) REFERENCES `user` (`uID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
