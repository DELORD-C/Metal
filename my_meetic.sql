-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 25 Juillet 2018 à 17:15
-- Version du serveur :  5.7.22-0ubuntu18.04.1
-- Version de PHP :  7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my_meetic`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL,
  `sender` varchar(30) NOT NULL,
  `receiver` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`ID`, `sender`, `receiver`, `message`, `date`) VALUES
(1, 'Administrateur', 'Fleurdelys', 'Je suis trÃ©s attirÃ© par vous madame !\r\n', '2018-07-19 17:58:51'),
(3, 'Administrateur', 'Fleurdelys', 'Ouesh madame t\'es charmante Ã§a te dirais une glace Ã  la menthe ?', '2018-07-19 18:00:15'),
(5, 'Administrateur', 'Tracteurstyx', 'Je t\'aime !\r\n', '2018-07-20 13:41:16'),
(6, 'Nazidu45', 'Administrateur', 'Salut Toi !', '2018-07-20 13:48:06'),
(7, 'Nazidu45', 'Administrateur', 'T\'es minion !', '2018-07-20 13:48:11'),
(8, 'Nazidu45', 'Administrateur', 'beaugoss va !', '2018-07-20 13:48:15'),
(10, 'Yoloswagter', 'Administrateur', 'Wesh poto !', '2018-07-20 13:49:39'),
(12, 'Yoloswagter', 'Nazidu45', 'hÃ© t\'es nazi !', '2018-07-20 15:59:05'),
(13, 'Raphou37', 'Yoloswagter', 'Salut mon beau', '2018-07-20 16:08:14'),
(14, 'Yoloswagter', 'Raphou37', 'Salut toi ;)', '2018-07-20 16:09:02'),
(15, 'Raphou37', 'Raphou37', 't\'es beau\r\n', '2018-07-20 16:09:36'),
(16, 'Administrateur', 'Tracteurstyx', 'wesh', '2018-07-20 16:37:10');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nick` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `search` tinyint(1) NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `imgurl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pika.gif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nick`, `lastname`, `firstname`, `email`, `gender`, `search`, `password`, `town`, `birthdate`, `imgurl`) VALUES
(4, 'Administrateur', 'ClÃ©ment', 'DELORD', 'clement.delord@epitech.eu', 0, 1, 'c315d37f8aa768d76e8a74593340fa4d', 'Lyon', '1999-10-10', 'venom.gif'),
(5, 'Jessdelatess', 'Jessica', 'FERRARY', 'j.ferrary@gmail.com', 1, 0, 'c16a86465476c3560f3f9aee5d1bc1da', 'LYON', '1999-01-01', 'cavalier.png'),
(6, 'Hervelebeaugoss', 'Herve', 'MANITO', 'hervelebeaugoss@gmail.com', 0, 1, '0daa1bba583193233a6bf7d036a99ecc', 'LYON', '1967-12-24', 'pika.gif'),
(7, 'Fleurdelys', 'Selena', 'GOMEZ', 'gomez.s@aol.com', 1, 0, '0daa1bba583193233a6bf7d036a99ecc', 'LYON', '1988-03-06', 'pika.gif'),
(8, 'Quentine', 'Quantouze', 'CHTOUM', 'quantouze.partouze@yahoo.fr', 1, 0, 'ca86d4f515e4da2c99a7d41d583bcf06', 'LYON', '1997-11-11', 'pika.gif'),
(9, 'Tracteurstyx', 'Billie', 'MOULIN', 'billie_moulin@hotmail.fr', 1, 0, '4e58006e7749676f231bfe09509b1459', 'LYON', '1997-08-13', 'Robot.png'),
(10, 'Homurachan', 'ThÃ©o', 'BERTIN', 'homurachan@cock.li', 0, 1, '75e4d1caa46ca1a061b1a0a1867348ae', 'LYON', '1998-03-01', 'homura.png'),
(11, 'Nazidu45', 'Greta', 'STTRUDLE', 'g.struddle@ss.nazi', 1, 0, '978e3fa3066e999d1bfee326045761d2', 'BERLIN', '1945-07-14', 'CF1.jpg'),
(12, 'Yoloswagter', 'Swagter', 'YOLO', 'Yoloswagter@aol.com', 0, 2, '0daa1bba583193233a6bf7d036a99ecc', 'LYON', '1993-01-01', 'nier.jpeg'),
(13, 'Samantha', 'Samantha', 'SAPHYR', 'sam.saphyr@gmail.com', 1, 2, '0daa1bba583193233a6bf7d036a99ecc', 'LYON', '1986-02-27', 'deepmind.png'),
(14, 'Escargot', 'Got', 'ESCAR', 'escar.got@gmail.com', 2, 2, '0daa1bba583193233a6bf7d036a99ecc', 'LYON', '1991-04-29', 'profil.png'),
(15, 'Raphou37', 'Raf', 'GOMEZ', 'gomez@hotmail.fr', 0, 2, '0daa1bba583193233a6bf7d036a99ecc', 'TOURS', '1994-09-09', 'Robot.png'),
(16, 'MacAaron', 'Jean', 'CULE', 'macaaron@yahoo.fr', 2, 2, '17c23454c779d29b0d07b2f61ca16736', 'THEOLAND', '1999-02-28', 'echecs.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
