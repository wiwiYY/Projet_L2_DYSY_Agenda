-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 04 avr. 2019 à 12:50
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dysy_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_events` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `begining` datetime NOT NULL,
  `ending` datetime NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `color` varchar(20) NOT NULL DEFAULT '#0071c5',
  PRIMARY KEY (`id_events`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_events`, `name`, `begining`, `ending`, `comment`, `id_user`, `color`) VALUES
(1, 'Test1', '2019-04-01 01:01:00', '2019-04-02 02:02:00', 'Premier test', 1, '#0071c5'),
(3, 'Test2bis', '2019-04-03 01:58:00', '2019-04-01 02:02:00', 'Test2bis', 1, '#FFD700'),
(4, 'Test3', '2019-04-01 01:01:00', '2019-04-07 02:02:00', 'Test3', 2, '#008000'),
(5, 'Test Bouton addevent 2', '2019-04-03 01:01:00', '2019-04-04 02:02:00', 'azertyuiop', 4, '#40E0D0'),
(6, 'yyytest', '2019-04-08 14:15:00', '2019-04-21 21:06:00', 'Test2 btn OK', 3, '#40E0D0'),
(7, 'test', '2019-04-11 04:05:00', '2019-04-11 14:04:00', 'dcfvgbhnj,k', 4, '#40E0D0'),
(8, 'test 2', '2019-04-19 11:11:00', '2019-04-20 21:59:00', 'wxcvbn,', 4, '#000');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `name`, `firstname`, `email`, `password`) VALUES
(1, 'Test', 'William', 'test@hotmail.fr', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(2, 'Test2', 'Willy', 'test2@hotmail.fr', '7c222fb2927d828af22f592134e8932480637c0d'),
(3, 'Test3', 'Wii', 'test3@hotmail.fr', '7c222fb2927d828af22f592134e8932480637c0d'),
(4, 'Testf', 'TestF', 'testf@hotmail.fr', '7c222fb2927d828af22f592134e8932480637c0d');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
