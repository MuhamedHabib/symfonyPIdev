-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 04:07 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chadha`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nomcategorie` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nomcategorie`, `description`) VALUES
(11, 'softskills', 'softskills...'),
(15, 'inovatech', 'inovatech est'),
(16, 'chadha', 'chadhajtkjrjk'),
(17, 'nouveauu', 'noiveau est'),
(18, 'hh', 'nhhh'),
(19, 'inovatech', 'innovah est'),
(20, 'cat1', 'azerttyuio'),
(21, 'cat2', 'cat2cat21234'),
(22, 'base de donnee', 'basebaseba'),
(23, 'gg', 'ababababab'),
(24, 'vv', 'vvvvvvvvvvv'),
(25, 'cc', '0123456789'),
(26, 'maryem', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210411234339', '2021-04-13 22:02:45', 215),
('DoctrineMigrations\\Version20210417163307', '2021-04-17 18:34:34', 1560),
('DoctrineMigrations\\Version20210418110834', '2021-04-18 13:09:08', 2012),
('DoctrineMigrations\\Version20210418113240', '2021-04-18 13:32:58', 178),
('DoctrineMigrations\\Version20210418115506', '2021-04-18 13:56:10', 2157),
('DoctrineMigrations\\Version20210418222314', '2021-04-19 00:23:34', 1771),
('DoctrineMigrations\\Version20210418225052', '2021-04-19 00:51:07', 1555),
('DoctrineMigrations\\Version20210418225421', '2021-04-19 00:54:27', 1397),
('DoctrineMigrations\\Version20210421000405', '2021-04-21 02:04:35', 2540),
('DoctrineMigrations\\Version20210423235805', '2021-04-24 01:58:25', 706),
('DoctrineMigrations\\Version20210424000156', '2021-04-24 02:02:19', 250),
('DoctrineMigrations\\Version20210424000512', '2021-04-24 02:05:42', 313),
('DoctrineMigrations\\Version20210424170357', '2021-04-24 19:04:18', 661),
('DoctrineMigrations\\Version20210426125952', '2021-04-26 15:00:14', 1302),
('DoctrineMigrations\\Version20210427122358', '2021-04-27 14:24:17', 643);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(99) NOT NULL,
  `nom_event` varchar(99) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `nbr_place` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `nom_event`, `date_deb`, `date_fin`, `nbr_place`, `categorie_id`, `id_user`, `image`) VALUES
(27, 'eventsoftskills', '2016-01-01', '2016-01-01', 29, 11, NULL, 'dd2a8aacb3e2056eabfa95e3c7f56cce.png'),
(28, 'chadha', '2016-01-01', '2016-01-01', 20, 11, NULL, '634bb4642b890b5c814ef0ee7862163f.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(100) NOT NULL,
  `id` int(11) NOT NULL,
  `file` varchar(111) NOT NULL,
  `date_creation` date NOT NULL,
  `myfile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `id`, `file`, `date_creation`, `myfile`) VALUES
(33, 7, 'extension', '2021-03-12', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\final.mp4'),
(35, 4, 'file', '2021-03-11', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\backlog.pdf'),
(36, 3, 'file', '2021-03-04', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\TP5 - STP.pdf'),
(37, 5, 'file', '2021-03-03', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\final.mp4'),
(38, 6, 'FILE', '2021-03-05', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\custom.jpg'),
(40, 8, '.pdf', '2021-03-03', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\TP5 - STP.pdf'),
(42, 1, 'video', '2021-04-06', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\backlog.pdf'),
(44, 11, 'mp4', '2021-04-06', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\VPN.mp4'),
(45, 14, 'mp4', '2021-04-06', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\yt1s.com - Developing in IBM Cloud_v240P.mp4'),
(46, 33, 'mp4', '2021-04-07', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\linkind.mp4'),
(47, 34, 'mp4', '2021-04-07', 'C:\\\\ESPRIT\\\\Esprit\\\\helpd\\\\src\\\\resources\\\\linkind.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL,
  `libelle_formation` varchar(40) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `niveau` varchar(40) DEFAULT NULL,
  `description` varchar(400) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id_formation`, `libelle_formation`, `id_user`, `niveau`, `description`, `date_creation`) VALUES
(1, 'java', 1, 'hard', 'vv', '2021-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `form_file_v`
--

CREATE TABLE `form_file_v` (
  `id` int(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `Image` varchar(55) DEFAULT NULL,
  `myfile` varchar(100) DEFAULT NULL,
  `file` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `for_file`
--

CREATE TABLE `for_file` (
  `id` int(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `Image` varchar(55) DEFAULT NULL,
  `myfile` varchar(100) DEFAULT NULL,
  `file` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(20) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `id_user` int(20) DEFAULT NULL,
  `message` varchar(99) NOT NULL,
  `reponse` varchar(99) DEFAULT NULL,
  `record` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `date_creation`, `id_user`, `message`, `reponse`, `record`) VALUES
(13, NULL, NULL, 'Je veux poster des publications', 'reponse', NULL),
(14, NULL, NULL, 'Je suis satisafaite', 'trying', NULL),
(15, NULL, NULL, 'helloooooooooooooooooooooooooooooo', 'hello hello hello', NULL),
(16, NULL, NULL, 'Je suis satisafaite de votre contenu lalalalal', 'aucune', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `myformation`
--

CREATE TABLE `myformation` (
  `id` int(100) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `type` varchar(99) NOT NULL,
  `Image` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `myformation`
--

INSERT INTO `myformation` (`id`, `libelle`, `description`, `date`, `type`, `Image`) VALUES
(1, 'remote working', 'VDI troubelshooting', '11/11/2020', 'mp4', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\IBM.jpg'),
(2, 'remote working', 'VDI troubelshooting', '11/14/2021', 'mp4', 'C:ESPRITEsprithelpdsrc\resources.jpg'),
(3, 'MSOffice', 'PPoint', '11/11/1995', 'FAD', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\images.jpg'),
(4, 'MSOffice', 'word', '11/11/1995', 'FAE', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\download.jpg'),
(5, 'MSOffice', 'word', '11/11/1995', 'FAE', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\download.jpg'),
(6, 'Management', 'Ethic seccurity ', '11/11/1989', 'PP', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\b.jpg'),
(7, 'Management', 'Ethic seccurity ', '11/11/1989', 'word', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\book.jpg'),
(8, 'Management', 'Ethic seccurity ', '11/11/1989', 'word', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\download.jpg'),
(9, 'Management', 'Ethic seccurity ', '11/11/1989', 'word', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\b.jpg'),
(10, 'Management', 'Ethic seccurity ', '11/11/1989', 'file', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\download.jpg'),
(11, 'remote working', 'VPN troubelshooting', '11/11/2020', 'FILE', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\IBM.jpg'),
(14, 'MSOffice', 'word', '11/11/1995', 'FAEd', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\images.jpg'),
(15, '', 'word', '11/11/1995', 'FAEd', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\b.jpg'),
(17, 'Management', 'Ethic seccurity ', '11/11/1989', 'word', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\images.jpg'),
(19, 'Management', 'Ethic seccurity ', '11/11/1989', 'word', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\book.jpg'),
(24, 'MSO', 'PP', '11/11/1997', 'vidéo', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\download.jpg'),
(25, 'ManagementMM', 'Ethic seccurity ', '11/11/1989', 'PP', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\g.jpg'),
(33, 'reseau', 'IP essentials', '11/11/2020', 'mp4', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\Ipessentials.jpg'),
(34, 'remote working', 'VPN troubelshooting', '11/11/2020', 'mp4', 'C:\\ESPRIT\\Esprit\\helpd\\src\\resources\\MSO.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id_participation` int(30) NOT NULL,
  `id_event` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id_participation`, `id_event`, `id_user`) VALUES
(26, 27, NULL),
(27, 27, NULL),
(28, 27, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `date_naissance` varchar(40) NOT NULL,
  `telephone` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `image` varchar(300) NOT NULL,
  `etat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`id_user`, `nom`, `prenom`, `email`, `mdp`, `date_naissance`, `telephone`, `status`, `image`, `etat`) VALUES
(1, 'mouelhi', 'chadha', 'chadha.mouelhi@esprit.tn', '88', '2021-03-16', '25000111', 'Admin', '', ''),
(2, 'mouelhi', 'shadha', 'chadha@gmail.com', '88', '1997-04-14', '21282247', 'Membre', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `planning`
--

CREATE TABLE `planning` (
  `id_planning` int(99) NOT NULL,
  `nom_event` varchar(99) NOT NULL,
  `nom` varchar(99) NOT NULL,
  `prenom` varchar(99) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `planning`
--

INSERT INTO `planning` (`id_planning`, `nom_event`, `nom`, `prenom`, `date_creation`) VALUES
(1, 'certification', 'Ala', 'Hamed', '2021-03-22'),
(3, 'certification', 'Ala', 'Hamed', '2021-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `categories` varchar(30) NOT NULL,
  `quiz` text NOT NULL,
  `resultat` text DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quizzer`
--

CREATE TABLE `quizzer` (
  `idq` int(11) NOT NULL,
  `id-quiz` int(11) NOT NULL,
  `formation` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

CREATE TABLE `reclamation` (
  `id_reclamation` int(11) NOT NULL,
  `type` varchar(99) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_validation` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `text` varchar(99) NOT NULL,
  `statut` varchar(99) DEFAULT NULL,
  `screenshot` varchar(99) DEFAULT NULL,
  `object` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `reclamation`
--

INSERT INTO `reclamation` (`id_reclamation`, `type`, `date_creation`, `date_validation`, `id_user`, `text`, `statut`, `screenshot`, `object`) VALUES
(29, 'Contenu', '2021-04-26 23:39:11', '2021-04-28', NULL, 'heydheyeyhdd', 'validée', 'bd8029518fca827ee7e509a6cf8a9285.png', 'hehehehehehe'),
(31, 'Contenu', '2021-04-28 03:16:25', NULL, NULL, 'je n\'arrive pas à me connecter', 'en attente', '023bdf39f4834a9056a563dd06f4d833.png', 'Conenxion'),
(32, 'Contenu', '2021-04-14 03:18:31', NULL, NULL, 'je suis satisfaite', 'En cours', '27ccd51040d36fa027bfbbb5775e0bee.png', 'bonjour');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `test` text NOT NULL,
  `resltat` text DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id_test`, `categories`, `test`, `resltat`, `duree`, `date_creation`) VALUES
(1, '', '', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tester`
--

CREATE TABLE `tester` (
  `id` int(11) DEFAULT NULL,
  `id_test` int(11) NOT NULL,
  `formation` varchar(30) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mdp` varchar(40) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `télephone` int(12) NOT NULL,
  `status` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `mdp`, `date_naissance`, `télephone`, `status`) VALUES
(1, 'med', 'kh', 'med.kh@mail.com', 'AAA', '2021-03-16', 2222222, 'Celb'),
(2, 'med', 'kh', 'med.kh@mail.com', 'AAA', '2021-03-16', 2222222, 'Celb'),
(4, 'med', 'kh', 'med.kh@mail.com', 'AAA', '2021-03-16', 2222222, 'Celb'),
(5, 'med', 'kh', 'med.kh@mail.com', 'AAA', '2021-03-16', 2222222, 'Celb'),
(6, 'med', 'kh', 'med.kh@mail.com', 'AAA', '2021-03-16', 2222222, 'Celb');

-- --------------------------------------------------------

--
-- Table structure for table `v_for_fil`
--

CREATE TABLE `v_for_fil` (
  `id` int(100) DEFAULT NULL,
  `Image` varchar(55) DEFAULT NULL,
  `myfile` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `IDX_5387574ABCF5E72D` (`categorie_id`),
  ADD KEY `IDX_5387574A6B3CA4B` (`id_user`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `fkey` (`id`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `id_user_fk` (`id_user`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `FK_mess_user` (`id_user`);

--
-- Indexes for table `myformation`
--
ALTER TABLE `myformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id_participation`),
  ADD KEY `IDX_AB55E24FD52B4B97` (`id_event`),
  ADD KEY `IDX_AB55E24F6B3CA4B` (`id_user`);

--
-- Indexes for table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id_planning`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`);

--
-- Indexes for table `quizzer`
--
ALTER TABLE `quizzer`
  ADD PRIMARY KEY (`idq`),
  ADD KEY `id-quiz` (`id-quiz`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id_reclamation`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Indexes for table `tester`
--
ALTER TABLE `tester`
  ADD KEY `id_test` (`id_test`),
  ADD KEY `tester_ibfk_2` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `myformation`
--
ALTER TABLE `myformation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id_participation` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `planning`
--
ALTER TABLE `planning`
  MODIFY `id_planning` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzer`
--
ALTER TABLE `quizzer`
  MODIFY `idq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id_reclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_5387574A6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `personne` (`id_user`),
  ADD CONSTRAINT `FK_5387574ABCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24F6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `personne` (`id_user`),
  ADD CONSTRAINT `FK_AB55E24FD52B4B97` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
