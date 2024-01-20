-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 29 Mai 2016 à 17:30
-- Version du serveur :  10.1.10-MariaDB
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mxgp`
--

-- --------------------------------------------------------

--
-- Structure de la table `mxg_particulier`
--

CREATE TABLE `mxg_particulier` (
  `par_ID` int(11) NOT NULL,
  `par_nom` varchar(100) NOT NULL,
  `par_prenom` varchar(100) NOT NULL,
  `par_pseudo` varchar(100) NOT NULL,
  `par_email` varchar(100) NOT NULL,
  `par_password` varchar(128) NOT NULL,
  `par_postparam` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mxg_particulier`
--

INSERT INTO `mxg_particulier` (`par_ID`, `par_nom`, `par_prenom`, `par_pseudo`, `par_email`, `par_password`, `par_postparam`) VALUES
(1, 'COQUARD', 'Guillaume', 'Guiz', 'guizillanet@yahoo.fr', 'c7b41b0a6bceedffd418b33e05e55813', 0),
(2, 'SELLIER', 'Téo', 'Mxke', 'sellierteo@gmail.com', 'ce15f590ff51693e4dc9737df10a8e3f', 0),
(3, 'COQUARD', 'Eric', 'Xtreem', 'netboxlive@gmail.com', 'd80a98a07b2656ac5aacb5a02f85c14f', 0),
(4, 'Yves', 'Yves', 'Yves', 'Yves@Yves', 'f244ef6f0accec870f785e4f6c85c645', 0),
(5, 'MKGZ', 'PROJECT', 'MKGZ', 'info@mkgz.com', 'bf5d738638deeabfc1a5430ac4e8732c', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mxg_projects`
--

CREATE TABLE `mxg_projects` (
  `pro_ID` int(11) NOT NULL,
  `par_ID` int(11) NOT NULL,
  `par_pseudo` varchar(100) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_descrip` text NOT NULL,
  `pro_img` text NOT NULL,
  `pro_link` varchar(100) NOT NULL,
  `pro_emp` int(11) NOT NULL,
  `pro_postparam` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mxg_projects`
--

INSERT INTO `mxg_projects` (`pro_ID`, `par_ID`, `par_pseudo`, `pro_name`, `pro_descrip`, `pro_img`, `pro_link`, `pro_emp`, `pro_postparam`) VALUES
(1, 5, 'MKGZ', 'MKGZ Project', 'Mike x Guiz Project permettra aux personnes qui s''inscrivent de faire parler de leurs projets Ã  grande Ã©chelle.', 'medias/img/project/MKGZ_MKGZ Project.png', 'http://localhost/', 2, 1),
(2, 1, 'Guiz', 'GUIZILLA', 'Site de Photographie.', 'medias/img/project/Guiz_GUIZILLA.png', 'http://www.guizilla.net/', 3, 1),
(3, 3, 'Xtreem', 'Cl@ss Internet', 'Site gÃ©nÃ©raliste sur l''informatique et annuaire de sites et services utiles.', 'medias/img/project/Xtreem_Cl@ss Internet.PNG', 'http://www.classinternet.net/', 1, 1),
(4, 2, 'Mxke', 'MXKE GAMING', 'ChaÃ®ne YouTube de Mxke', 'medias/img/project/Mxke_MXKE GAMING.JPG', '', 4, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `mxg_particulier`
--
ALTER TABLE `mxg_particulier`
  ADD PRIMARY KEY (`par_ID`),
  ADD UNIQUE KEY `par_pseudo` (`par_pseudo`),
  ADD UNIQUE KEY `par_email` (`par_email`);

--
-- Index pour la table `mxg_projects`
--
ALTER TABLE `mxg_projects`
  ADD PRIMARY KEY (`pro_ID`),
  ADD UNIQUE KEY `pro_name` (`pro_name`),
  ADD UNIQUE KEY `pro_emp` (`pro_emp`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `mxg_particulier`
--
ALTER TABLE `mxg_particulier`
  MODIFY `par_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `mxg_projects`
--
ALTER TABLE `mxg_projects`
  MODIFY `pro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
