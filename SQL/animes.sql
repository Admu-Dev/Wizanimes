-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 24 nov. 2024 à 19:34
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `animes`
--

-- --------------------------------------------------------

--
-- Structure de la table `add_list`
--

CREATE TABLE `add_list` (
  `id` int NOT NULL,
  `like_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `add_list`
--

INSERT INTO `add_list` (`id`, `like_Name`) VALUES
(9, 'Naruto');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `img` varchar(255) NOT NULL,
  `NameAnime` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `date_ajout` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`img`, `NameAnime`, `categorie`, `date_ajout`) VALUES
('155e2eaa040c352a9bf20ef3d817dbc2.jpg', 'Demon Slayer', 'Film', '2022-05-31'),
('49613353e94b603b5e0f94dd439af256.jpg', 'Bleach', 'recommandations', '2022-05-31'),
('4a5480deada068dc7b80d49f1149bc11.jpg', 'Jujutsu Kaisen', 'recommandations', '2022-05-31'),
('4dad51595f797cc003fbdb2e8b306ebc.jpg', 'Tokyo Ghoul', 'recommandations', '2022-05-31'),
('5d05f21b01358466d09b3ff9ea009d7f.jpg', 'Naruto', 'recommandations', '2022-05-31'),
('6334635b9e06cd36646b33ed58abba0a.jpg', 'Demon slayer', 'recommandations', '2022-05-31'),
('68ea577e5d86a30b13029d51012cdda2.jpg', 'Fairy Tail', 'recommandations', '2022-05-31'),
('7b6d2fbf04ad74a6070700e27387fbe0.jpg', 'One piece', 'recommandations', '2024-04-06'),
('94382ba55f6ec666d27313f68ca73197.jpg', 'DragonBall Z', 'recommandations', '2022-05-31'),
('b915c2564367cb6997eeed33aa25f211.jpg', 'Death note', 'recommandations', '2022-05-31'),
('cbf55b8645b19b093a00665b1a25db92.jpg', 'Naruto Shippuden', 'recommandations', '2022-05-31'),
('d8a77b8923a4a6c42a78759501aa13f0.jpg', 'Attaque des titans', 'recommandations', '2022-05-31'),
('e5b94344eb29db4022eea908a68e8b0e.jpg', 'One piece', 'recommandations', '2022-05-31'),
('f5bd836dcf20d2624240f8c616387c4a.jpg', 'One piece', 'Anime-VO', '2022-05-31');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int UNSIGNED NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `passwords` text,
  `date_creation_compte` datetime DEFAULT NULL,
  `code` mediumint NOT NULL,
  `status` text NOT NULL,
  `like_list` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `lastName`, `firstName`, `pseudo`, `email`, `passwords`, `date_creation_compte`, `code`, `status`, `like_list`) VALUES
(9, 'vsdv', 'Adrien', 'Admu Admin', 'admin@fictive.fr', '$argon2id$v=19$m=65536,t=4,p=1$a2VtRjg4ODJ2Q2NsV3c4Yw$pHqTjZtkr+ko52AraSJLv8dwgRbJbcvqP0OLZaXuvfI', '2022-06-05 12:55:45', 0, 'verified', 1),
(32, 'fsef', 'Adrien 2', 'Admu 2', 'admu@fictive.fr', '$argon2id$v=19$m=65536,t=4,p=1$Tkt4eUZKbC52cEhoRkZnTQ$sBKfr72nT2FC5/MjalCphEIz8xnAKCM8l6m2GMhagMg', '2022-06-05 12:54:44', 0, 'verified', 1),
(34, 'Ge', 'Mat', 'MG', 'mg@fictive.fr', '$argon2id$v=19$m=65536,t=4,p=1$VHBLYnBOcVpvcFJJSTJxaQ$03eLQuI69u+HnRC2188fTbpUEiv7Tq25kERokq6dD8U', '2024-11-24 19:25:11', 0, 'verified', 1);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `AnimeName` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `season` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `AnimeName`, `name`, `location`, `season`) VALUES
(1, 'Naruto', 'Naruto+-+1+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+1+VOSTFR.avi.mp4', 1),
(2, 'Naruto', 'Naruto+-+2+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+2+VOSTFR.avi.mp4', 1),
(3, 'Naruto', 'Naruto+-+3+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+3+VOSTFR.avi.mp4', 1),
(4, 'Naruto', 'Naruto+-+4+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+4+VOSTFR.avi.mp4', 1),
(5, 'Naruto', 'Naruto+-+5+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+5+VOSTFR.avi.mp4', 1),
(6, 'Naruto', 'Naruto+-+6+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+6+VOSTFR.avi.mp4', 1),
(7, 'Naruto', 'Naruto+-+7+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+7+VOSTFR.avi.mp4', 1),
(8, 'Naruto', 'Naruto+-+8+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+8+VOSTFR.avi.mp4', 1),
(9, 'Naruto', 'Naruto+-+9+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+9+VOSTFR.avi.mp4', 1),
(10, 'Naruto', 'Naruto+-+10+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+10+VOSTFR.avi.mp4', 1),
(11, 'Naruto', 'Naruto+-+11+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+11+VOSTFR.avi.mp4', 1),
(12, 'Naruto', 'Naruto+-+12+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+12+VOSTFR.avi.mp4', 1),
(13, 'Naruto', 'Naruto+-+13+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+13+VOSTFR.avi.mp4', 1),
(14, 'Naruto', 'Naruto+-+14+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+14+VOSTFR.avi.mp4', 1),
(15, 'Naruto', 'Naruto+-+15+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+15+VOSTFR.avi.mp4', 1),
(16, 'Naruto', 'Naruto+-+16+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+16+VOSTFR.avi.mp4', 1),
(17, 'Naruto', 'Naruto+-+17+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+17+VOSTFR.avi.mp4', 1),
(18, 'Naruto', 'Naruto+-+18+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+18+VOSTFR.avi.mp4', 1),
(19, 'Naruto', 'Naruto+-+19+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+19+VOSTFR.avi.mp4', 1),
(20, 'Naruto', 'Naruto+-+20+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+20+VOSTFR.avi.mp4', 1),
(21, 'Naruto', 'Naruto+-+21+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+21+VOSTFR.avi.mp4', 1),
(22, 'Naruto', 'Naruto+-+22+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+22+VOSTFR.avi.mp4', 1),
(23, 'Naruto', 'Naruto+-+23+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+23+VOSTFR.avi.mp4', 1),
(24, 'Naruto', 'Naruto+-+24+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+24+VOSTFR.avi.mp4', 1),
(25, 'Naruto', 'Naruto+-+25+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+25+VOSTFR.avi.mp4', 1),
(26, 'Naruto', 'Naruto+-+26+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+26+VOSTFR.avi.mp4', 1),
(27, 'Naruto', 'Naruto+-+27+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+27+VOSTFR.avi.mp4', 2),
(28, 'Naruto', 'Naruto+-+28+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+28+VOSTFR.avi.mp4', 2),
(29, 'Naruto', 'Naruto+-+29+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+29+VOSTFR.avi.mp4', 2),
(30, 'Naruto', 'Naruto+-+30+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+30+VOSTFR.avi.mp4', 2),
(31, 'Naruto', 'Naruto+-+31+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+31+VOSTFR.avi.mp4', 2),
(32, 'Naruto', 'Naruto+-+32+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+32+VOSTFR.avi.mp4', 2),
(33, 'Naruto', 'Naruto+-+33+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+33+VOSTFR.avi.mp4', 2),
(34, 'Naruto', 'Naruto+-+34+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+34+VOSTFR.avi.mp4', 2),
(35, 'Naruto', 'Naruto+-+35+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+35+VOSTFR.avi.mp4', 2),
(36, 'Naruto', 'Naruto+-+36+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+36+VOSTFR.avi.mp4', 2),
(37, 'Naruto', 'Naruto+-+37+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+37+VOSTFR.avi.mp4', 2),
(38, 'Naruto', 'Naruto+-+38+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+38+VOSTFR.avi.mp4', 2),
(39, 'Naruto', 'Naruto+-+39+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+39+VOSTFR.avi.mp4', 2),
(40, 'Naruto', 'Naruto+-+40+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+40+VOSTFR.avi.mp4', 2),
(41, 'Naruto', 'Naruto+-+41+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+41+VOSTFR.avi.mp4', 2),
(42, 'Naruto', 'Naruto+-+42+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+42+VOSTFR.avi.mp4', 2),
(43, 'Naruto', 'Naruto+-+43+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+43+VOSTFR.avi.mp4', 2),
(44, 'Naruto', 'Naruto+-+44+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+44+VOSTFR.avi.mp4', 2),
(45, 'Naruto', 'Naruto+-+45+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+45+VOSTFR.avi.mp4', 2),
(46, 'Naruto', 'Naruto+-+46+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+46+VOSTFR.avi.mp4', 2),
(47, 'Naruto', 'Naruto+-+47+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+47+VOSTFR.avi.mp4', 2),
(48, 'Naruto', 'Naruto+-+48+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+48+VOSTFR.avi.mp4', 2),
(49, 'Naruto', 'Naruto+-+49+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+49+VOSTFR.avi.mp4', 2),
(50, 'Naruto', 'Naruto+-+50+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+50+VOSTFR.avi.mp4', 2),
(51, 'Naruto', 'Naruto+-+51+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+51+VOSTFR.avi.mp4', 2),
(52, 'Naruto', 'Naruto+-+52+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+52+VOSTFR.avi.mp4', 2),
(53, 'Naruto', 'Naruto+-+53+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+53+VOSTFR.avi.mp4', 3),
(54, 'Naruto', 'Naruto+-+54+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+54+VOSTFR.avi.mp4', 3),
(55, 'Naruto', 'Naruto+-+55+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+55+VOSTFR.avi.mp4', 3),
(56, 'Naruto', 'Naruto+-+56+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+56+VOSTFR.avi.mp4', 3),
(57, 'Naruto', 'Naruto+-+57+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+57+VOSTFR.avi.mp4', 3),
(58, 'Naruto', 'Naruto+-+58+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+58+VOSTFR.avi.mp4', 3),
(59, 'Naruto', 'Naruto+-+59+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+59+VOSTFR.avi.mp4', 3),
(60, 'Naruto', 'Naruto+-+60+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+60+VOSTFR.avi.mp4', 3),
(61, 'Naruto', 'Naruto+-+61+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+61+VOSTFR.avi.mp4', 3),
(62, 'Naruto', 'Naruto+-+62+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+62+VOSTFR.avi.mp4', 3),
(63, 'Naruto', 'Naruto+-+63+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+63+VOSTFR.avi.mp4', 3),
(64, 'Naruto', 'Naruto+-+64+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+64+VOSTFR.avi.mp4', 3),
(65, 'Naruto', 'Naruto+-+65+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+65+VOSTFR.avi.mp4', 3),
(66, 'Naruto', 'Naruto+-+66+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+66+VOSTFR.avi.mp4', 3),
(67, 'Naruto', 'Naruto+-+67+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+67+VOSTFR.avi.mp4', 3),
(68, 'Naruto', 'Naruto+-+68+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+68+VOSTFR.avi.mp4', 3),
(69, 'Naruto', 'Naruto+-+69+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+69+VOSTFR.avi.mp4', 3),
(70, 'Naruto', 'Naruto+-+70+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+70+VOSTFR.avi.mp4', 3),
(71, 'Naruto', 'Naruto+-+71+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+71+VOSTFR.avi.mp4', 3),
(72, 'Naruto', 'Naruto+-+72+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+72+VOSTFR.avi.mp4', 3),
(73, 'Naruto', 'Naruto+-+73+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+73+VOSTFR.avi.mp4', 3),
(74, 'Naruto', 'Naruto+-+74+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+74+VOSTFR.avi.mp4', 3),
(75, 'Naruto', 'Naruto+-+75+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+75+VOSTFR.avi.mp4', 3),
(76, 'Naruto', 'Naruto+-+76+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+76+VOSTFR.avi.mp4', 3),
(77, 'Naruto', 'Naruto+-+77+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+77+VOSTFR.avi.mp4', 3),
(78, 'Naruto', 'Naruto+-+78+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+78+VOSTFR.avi.mp4', 3),
(79, 'Naruto', 'Naruto+-+79+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+79+VOSTFR.avi.mp4', 3),
(80, 'Naruto', 'Naruto+-+80+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+80+VOSTFR.avi.mp4', 3),
(81, 'Naruto', 'Naruto+-+81+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+81+VOSTFR.avi.mp4', 4),
(82, 'Naruto', 'Naruto+-+82+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+82+VOSTFR.avi.mp4', 4),
(83, 'Naruto', 'Naruto+-+83+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+83+VOSTFR.avi.mp4', 4),
(84, 'Naruto', 'Naruto+-+84+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+84+VOSTFR.avi.mp4', 4),
(85, 'Naruto', 'Naruto+-+85+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+85+VOSTFR.avi.mp4', 4),
(86, 'Naruto', 'Naruto+-+86+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+86+VOSTFR.avi.mp4', 4),
(87, 'Naruto', 'Naruto+-+87+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+87+VOSTFR.avi.mp4', 4),
(88, 'Naruto', 'Naruto+-+88+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+88+VOSTFR.avi.mp4', 4),
(89, 'Naruto', 'Naruto+-+89+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+89+VOSTFR.avi.mp4', 4),
(90, 'Naruto', 'Naruto+-+90+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+90+VOSTFR.avi.mp4', 4),
(91, 'Naruto', 'Naruto+-+91+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+91+VOSTFR.avi.mp4', 4),
(92, 'Naruto', 'Naruto+-+92+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+92+VOSTFR.avi.mp4', 4),
(93, 'Naruto', 'Naruto+-+93+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+93+VOSTFR.avi.mp4', 4),
(94, 'Naruto', 'Naruto+-+94+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+94+VOSTFR.avi.mp4', 4),
(95, 'Naruto', 'Naruto+-+95+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+95+VOSTFR.avi.mp4', 4),
(96, 'Naruto', 'Naruto+-+96+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+96+VOSTFR.avi.mp4', 4),
(97, 'Naruto', 'Naruto+-+97+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+97+VOSTFR.avi.mp4', 4),
(98, 'Naruto', 'Naruto+-+98+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+98+VOSTFR.avi.mp4', 4),
(99, 'Naruto', 'Naruto+-+99+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+99+VOSTFR.avi.mp4', 4),
(100, 'Naruto', 'Naruto+-+100+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+100+VOSTFR.avi.mp4', 4),
(101, 'Naruto', 'Naruto+-+101+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+101+VOSTFR.avi.mp4', 4),
(102, 'Naruto', 'Naruto+-+102+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+102+VOSTFR.avi.mp4', 4),
(103, 'Naruto', 'Naruto+-+103+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+103+VOSTFR.avi.mp4', 4),
(104, 'Naruto', 'Naruto+-+104+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+104+VOSTFR.avi.mp4', 4),
(105, 'Naruto', 'Naruto+-+105+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+105+VOSTFR.avi.mp4', 4),
(106, 'Naruto', 'Naruto+-+106+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+106+VOSTFR.avi.mp4', 4),
(107, 'Naruto', 'Naruto+-+107+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+107+VOSTFR.avi.mp4', 5),
(108, 'Naruto', 'Naruto+-+108+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+108+VOSTFR.avi.mp4', 5),
(109, 'Naruto', 'Naruto+-+109+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+109+VOSTFR.avi.mp4', 5),
(110, 'Naruto', 'Naruto+-+110+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+110+VOSTFR.avi.mp4', 5),
(111, 'Naruto', 'Naruto+-+111+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+111+VOSTFR.avi.mp4', 5),
(112, 'Naruto', 'Naruto+-+112+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+112+VOSTFR.avi.mp4', 5),
(113, 'Naruto', 'Naruto+-+113+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+113+VOSTFR.avi.mp4', 5),
(114, 'Naruto', 'Naruto+-+114+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+114+VOSTFR.avi.mp4', 5),
(115, 'Naruto', 'Naruto+-+115+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+115+VOSTFR.avi.mp4', 5),
(116, 'Naruto', 'Naruto+-+116+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+116+VOSTFR.avi.mp4', 5),
(117, 'Naruto', 'Naruto+-+117+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+117+VOSTFR.avi.mp4', 5),
(118, 'Naruto', 'Naruto+-+118+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+118+VOSTFR.avi.mp4', 5),
(119, 'Naruto', 'Naruto+-+119+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+119+VOSTFR.avi.mp4', 5),
(120, 'Naruto', 'Naruto+-+120+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+120+VOSTFR.avi.mp4', 5),
(121, 'Naruto', 'Naruto+-+121+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+121+VOSTFR.avi.mp4', 5),
(122, 'Naruto', 'Naruto+-+122+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+122+VOSTFR.avi.mp4', 5),
(123, 'Naruto', 'Naruto+-+123+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+123+VOSTFR.avi.mp4', 5),
(124, 'Naruto', 'Naruto+-+124+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+124+VOSTFR.avi.mp4', 5),
(125, 'Naruto', 'Naruto+-+125+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+125+VOSTFR.avi.mp4', 5),
(126, 'Naruto', 'Naruto+-+126+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+126+VOSTFR.avi.mp4', 5),
(127, 'Naruto', 'Naruto+-+127+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+127+VOSTFR.avi.mp4', 5),
(128, 'Naruto', 'Naruto+-+128+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+128+VOSTFR.avi.mp4', 5),
(129, 'Naruto', 'Naruto+-+129+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+129+VOSTFR.avi.mp4', 5),
(130, 'Naruto', 'Naruto+-+130+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+130+VOSTFR.avi.mp4', 5),
(131, 'Naruto', 'Naruto+-+131+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+131+VOSTFR.avi.mp4', 5),
(132, 'Naruto', 'Naruto+-+132+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+132+VOSTFR.avi.mp4', 5),
(133, 'Naruto', 'Naruto+-+133+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+133+VOSTFR.avi.mp4', 5),
(134, 'Naruto', 'Naruto+-+134+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+134+VOSTFR.avi.mp4', 5),
(135, 'Naruto', 'Naruto+-+135+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+135+VOSTFR.avi.mp4', 5),
(136, 'Naruto', 'Naruto+-+136+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+136+VOSTFR.avi.mp4', 6),
(137, 'Naruto', 'Naruto+-+137+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+137+VOSTFR.avi.mp4', 6),
(138, 'Naruto', 'Naruto+-+138+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+138+VOSTFR.avi.mp4', 6),
(139, 'Naruto', 'Naruto+-+139+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+139+VOSTFR.avi.mp4', 6),
(140, 'Naruto', 'Naruto+-+140+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+140+VOSTFR.avi.mp4', 6),
(141, 'Naruto', 'Naruto+-+141+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+141+VOSTFR.avi.mp4', 6),
(142, 'Naruto', 'Naruto+-+142+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+142+VOSTFR.avi.mp4', 6),
(143, 'Naruto', 'Naruto+-+143+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+143+VOSTFR.avi.mp4', 6),
(144, 'Naruto', 'Naruto+-+144+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+144+VOSTFR.avi.mp4', 6),
(145, 'Naruto', 'Naruto+-+145+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+145+VOSTFR.avi.mp4', 6),
(146, 'Naruto', 'Naruto+-+146+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+146+VOSTFR.avi.mp4', 6),
(147, 'Naruto', 'Naruto+-+147+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+147+VOSTFR.avi.mp4', 6),
(148, 'Naruto', 'Naruto+-+148+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+148+VOSTFR.avi.mp4', 6),
(149, 'Naruto', 'Naruto+-+149+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+149+VOSTFR.avi.mp4', 6),
(150, 'Naruto', 'Naruto+-+150+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+150+VOSTFR.avi.mp4', 6),
(151, 'Naruto', 'Naruto+-+151+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+151+VOSTFR.avi.mp4', 6),
(152, 'Naruto', 'Naruto+-+152+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+152+VOSTFR.avi.mp4', 6),
(153, 'Naruto', 'Naruto+-+153+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+153+VOSTFR.avi.mp4', 6),
(154, 'Naruto', 'Naruto+-+154+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+154+VOSTFR.avi.mp4', 6),
(155, 'Naruto', 'Naruto+-+155+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+155+VOSTFR.avi.mp4', 6),
(156, 'Naruto', 'Naruto+-+156+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+156+VOSTFR.avi.mp4', 6),
(157, 'Naruto', 'Naruto+-+157+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+157+VOSTFR.avi.mp4', 6),
(158, 'Naruto', 'Naruto+-+158+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+158+VOSTFR.avi.mp4', 6),
(159, 'Naruto', 'Naruto+-+159+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+159+VOSTFR.avi.mp4', 6),
(160, 'Naruto', 'Naruto+-+160+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+160+VOSTFR.avi.mp4', 6),
(161, 'Naruto', 'Naruto+-+161+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+161+VOSTFR.avi.mp4', 7),
(162, 'Naruto', 'Naruto+-+162+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+162+VOSTFR.avi.mp4', 7),
(163, 'Naruto', 'Naruto+-+163+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+163+VOSTFR.avi.mp4', 7),
(164, 'Naruto', 'Naruto+-+164+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+164+VOSTFR.avi.mp4', 7),
(165, 'Naruto', 'Naruto+-+165+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+165+VOSTFR.avi.mp4', 7),
(166, 'Naruto', 'Naruto+-+166+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+166+VOSTFR.avi.mp4', 7),
(167, 'Naruto', 'Naruto+-+167+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+167+VOSTFR.avi.mp4', 7),
(168, 'Naruto', 'Naruto+-+168+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+168+VOSTFR.avi.mp4', 7),
(169, 'Naruto', 'Naruto+-+169+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+169+VOSTFR.avi.mp4', 7),
(170, 'Naruto', 'Naruto+-+170+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+170+VOSTFR.avi.mp4', 7),
(171, 'Naruto', 'Naruto+-+171+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+171+VOSTFR.avi.mp4', 7),
(172, 'Naruto', 'Naruto+-+172+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+172+VOSTFR.avi.mp4', 7),
(173, 'Naruto', 'Naruto+-+173+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+173+VOSTFR.avi.mp4', 7),
(174, 'Naruto', 'Naruto+-+174+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+174+VOSTFR.avi.mp4', 7),
(175, 'Naruto', 'Naruto+-+175+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+175+VOSTFR.avi.mp4', 7),
(176, 'Naruto', 'Naruto+-+176+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+176+VOSTFR.avi.mp4', 7),
(177, 'Naruto', 'Naruto+-+177+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+177+VOSTFR.avi.mp4', 7),
(178, 'Naruto', 'Naruto+-+178+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+178+VOSTFR.avi.mp4', 7),
(179, 'Naruto', 'Naruto+-+179+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+179+VOSTFR.avi.mp4', 7),
(180, 'Naruto', 'Naruto+-+180+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+180+VOSTFR.avi.mp4', 7),
(181, 'Naruto', 'Naruto+-+181+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+181+VOSTFR.avi.mp4', 7),
(182, 'Naruto', 'Naruto+-+182+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+182+VOSTFR.avi.mp4', 7),
(183, 'Naruto', 'Naruto+-+183+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+183+VOSTFR.avi.mp4', 7),
(184, 'Naruto', 'Naruto+-+184+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+184+VOSTFR.avi.mp4', 7),
(185, 'Naruto', 'Naruto+-+185+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+185+VOSTFR.avi.mp4', 7),
(186, 'Naruto', 'Naruto+-+186+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+186+VOSTFR.avi.mp4', 7),
(187, 'Naruto', 'Naruto+-+187+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+187+VOSTFR.avi.mp4', 8),
(188, 'Naruto', 'Naruto+-+188+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+188+VOSTFR.avi.mp4', 8),
(189, 'Naruto', 'Naruto+-+189+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+189+VOSTFR.avi.mp4', 8),
(190, 'Naruto', 'Naruto+-+190+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+190+VOSTFR.avi.mp4', 8),
(191, 'Naruto', 'Naruto+-+191+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+191+VOSTFR.avi.mp4', 8),
(192, 'Naruto', 'Naruto+-+192+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+192+VOSTFR.avi.mp4', 8),
(193, 'Naruto', 'Naruto+-+193+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+193+VOSTFR.avi.mp4', 8),
(194, 'Naruto', 'Naruto+-+194+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+194+VOSTFR.avi.mp4', 8),
(195, 'Naruto', 'Naruto+-+195+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+195+VOSTFR.avi.mp4', 8),
(196, 'Naruto', 'Naruto+-+196+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+196+VOSTFR.avi.mp4', 8),
(197, 'Naruto', 'Naruto+-+197+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+197+VOSTFR.avi.mp4', 8),
(198, 'Naruto', 'Naruto+-+198+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+198+VOSTFR.avi.mp4', 8),
(199, 'Naruto', 'Naruto+-+199+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+199+VOSTFR.avi.mp4', 8),
(200, 'Naruto', 'Naruto+-+200+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+200+VOSTFR.avi.mp4', 8),
(201, 'Naruto', 'Naruto+-+201+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+201+VOSTFR.avi.mp4', 8),
(202, 'Naruto', 'Naruto+-+202+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+202+VOSTFR.avi.mp4', 8),
(203, 'Naruto', 'Naruto+-+203+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+203+VOSTFR.avi.mp4', 8),
(204, 'Naruto', 'Naruto+-+204+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+204+VOSTFR.avi.mp4', 8),
(205, 'Naruto', 'Naruto+-+205+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+205+VOSTFR.avi.mp4', 8),
(206, 'Naruto', 'Naruto+-+206+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+206+VOSTFR.avi.mp4', 8),
(207, 'Naruto', 'Naruto+-+207+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+207+VOSTFR.avi.mp4', 8),
(208, 'Naruto', 'Naruto+-+208+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+208+VOSTFR.avi.mp4', 8),
(209, 'Naruto', 'Naruto+-+209+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+209+VOSTFR.avi.mp4', 8),
(210, 'Naruto', 'Naruto+-+210+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+210+VOSTFR.avi.mp4', 8),
(211, 'Naruto', 'Naruto+-+211+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+211+VOSTFR.avi.mp4', 8),
(212, 'Naruto', 'Naruto+-+212+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+212+VOSTFR.avi.mp4', 8),
(213, 'Naruto', 'Naruto+-+213+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+213+VOSTFR.avi.mp4', 9),
(214, 'Naruto', 'Naruto+-+214+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+214+VOSTFR.avi.mp4', 9),
(215, 'Naruto', 'Naruto+-+215+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+215+VOSTFR.avi.mp4', 9),
(216, 'Naruto', 'Naruto+-+216+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+216+VOSTFR.avi.mp4', 9),
(217, 'Naruto', 'Naruto+-+217+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+217+VOSTFR.avi.mp4', 9),
(218, 'Naruto', 'Naruto+-+218+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+218+VOSTFR.avi.mp4', 9),
(219, 'Naruto', 'Naruto+-+219+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+219+VOSTFR.avi.mp4', 9),
(220, 'Naruto', 'Naruto+-+220+VOSTFR.avi.mp4', '../upload/videos/Naruto/Naruto+-+220+VOSTFR.avi.mp4', 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
