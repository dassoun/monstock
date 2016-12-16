-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Décembre 2016 à 17:02
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `monstock`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `designation` varchar(256) NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `designation`, `image`, `categorie_id`) VALUES
(1, 'Panneau Sapin 200x60', NULL, 1),
(2, 'Raspberry Pi Carte Mère 3 Model B  Quad Core CPU 1.2 GHz 1 Go RAM', NULL, 4),
(3, 'Pied de pcb - Blanc (x4)', NULL, 7),
(4, 'Amplificateur Audio Stéréo', NULL, 2),
(5, 'Sanwa Joystick JLF-TP-8YT', NULL, 2),
(6, 'Cablage JLF-H avec connecteur pour  PCB', NULL, 3),
(7, 'Cablage GPIO 2.8mm - RaspBerry', NULL, 3),
(8, 'Poignées pour borne', NULL, 7),
(9, 'Dexlan Cordon électrique secteur  standard 1.8 m Noir', NULL, 3),
(10, 'Carte Mémoire microSDHC SanDisk  Ultra 64 Go Classe 10 pour Android. ', NULL, 4),
(11, 'Dissipateurs Raspberry  Thermiques en Aluminium pour  Raspberry Pi 3,Pi 2,Pi Model B+, Noir, 6  Pièces', NULL, 4),
(12, 'Official 5V 2.5A Power Adapter for the  Raspberry Pi 3 (White) ', NULL, 3),
(13, 'Neutrik NAUSB-W-B Adaptateur USB  réversible (type A / type B) Noir', NULL, 4),
(14, 'USB 2,0 Haute Vitesse câble Imprimeur  Cordon A Vers B Noir 0,5 m 50 cm', NULL, 4),
(15, 'TOOGOO(R) Fiche d''alimentation male  AC 10A 250V IEC320 C14', NULL, 3),
(16, 'Ugreen Câble HDMI Mâle vers DVI 24+1  DVI-D Mâle Haute Vitesse Adaptateur  Vidéo Plaqué or 1080P pour TVHD,  Plasma, DVD et Projecteur, 3ft/1m ', NULL, 4),
(17, 'Fiimi Support mural pour TV écran plat  de 33 à 61 cm, charge maximale 8 kg,  VESA 75/100', NULL, 7),
(18, 'Ecran IIYAMA E1980SD-B1 19IN LED  1280x1024 VGA DVI MM', NULL, 4),
(19, 'Kenwood KFC-E1365 Haut-parleurs 2  voies - 1', NULL, 3),
(20, 'Mélaminé 3mm', NULL, 1),
(21, 'Panneau Bois 100x150', NULL, 1),
(22, 'Charnières', NULL, 7),
(23, 'Tasseaux 18x18 mm', NULL, 1),
(24, 'Prise multiple', NULL, 3),
(25, 'Panel Button', NULL, 7),
(26, 'test', 'C:\\www\\upload\\PanelPerso.png', 1),
(27, 'test2', 'C:\\www\\MesProjets\\TestZF1\\public\\upload\\PanelPerso.png', 1),
(28, 'test3', 'C:\\www\\MesProjets\\TestZF1\\public\\upload\\PanelPerso.png', 1),
(29, 'Fil à câbler souple 0.50 mm²', 'Array', 3),
(30, 'machin', 'Array', 1),
(31, 'sdfsdfsdfs<df', 'Array', 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_fournisseur`
--

CREATE TABLE `article_fournisseur` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `ref_fournisseur` varchar(64) NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `page_web` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article_fournisseur`
--

INSERT INTO `article_fournisseur` (`id`, `article_id`, `fournisseur_id`, `ref_fournisseur`, `prix`, `page_web`) VALUES
(1, 1, 2, '', '9.90', '');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Bois'),
(2, 'Electronique'),
(3, 'Electricité'),
(4, 'Informatique'),
(7, 'Quincaillerie');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `ville` varchar(64) DEFAULT NULL,
  `site_web` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `ville`, `site_web`) VALUES
(1, 'Amazon', '', 'amazon.fr'),
(2, 'Castorama', '', 'http://www.castorama.fr'),
(3, 'SmallCab', '', 'http://smallcab.net/'),
(4, 'Go Tronic', 'Blagny', 'http://www.gotronic.fr'),
(5, 'Leroy Merlin', 'Osny', 'http://www.leroymerlin.fr/');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `article_fournisseur`
--
ALTER TABLE `article_fournisseur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `fourniseur_id` (`fournisseur_id`),
  ADD KEY `ref_fournisseur` (`ref_fournisseur`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_web` (`site_web`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `article_fournisseur`
--
ALTER TABLE `article_fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
