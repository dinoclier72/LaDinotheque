-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 08 déc. 2021 à 11:29
-- Version du serveur :  10.4.12-MariaDB-log
-- Version de PHP : 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e191136`
--

-- --------------------------------------------------------

--
-- Structure de la table `Articles`
--

CREATE TABLE `Articles` (
  `Titre` text DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Articles`
--

INSERT INTO `Articles` (`Titre`, `contenu`, `image`, `ID`) VALUES
('Nos petits compagnons les dinosaures', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rutrum vehicula felis, fringilla tempor orci tincidunt vitae. In sodales tincidunt lectus et laoreet. Vivamus sit amet nibh tellus. Vivamus ac efficitur massa. In accumsan ante et faucibus pretium. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer nec. ', '0', 5);

-- --------------------------------------------------------

--
-- Structure de la table `Dinosaures`
--

CREATE TABLE `Dinosaures` (
  `Nom` text NOT NULL,
  `Age` int(11) NOT NULL,
  `Anniversaire` date NOT NULL,
  `Statut` text NOT NULL DEFAULT 'Disponible',
  `Espèce` text NOT NULL,
  `image` text NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Dinosaures`
--

INSERT INTO `Dinosaures` (`Nom`, `Age`, `Anniversaire`, `Statut`, `Espèce`, `image`, `ID`) VALUES
('Maya', 25, '2003-12-04', 'Disponible', 'Stégausaure', '', 11283569),
('Terry', 12, '2021-12-06', 'Emprunté', 'T-Rex', '', 12457896),
('Doug', 25, '2003-04-10', 'Disponible', 'Diplodocus', '', 45289674),
('Richard', 30, '2021-06-22', 'Emprunté', 'Raptor', '', 74895612);

-- --------------------------------------------------------

--
-- Structure de la table `Livres`
--

CREATE TABLE `Livres` (
  `Titre` text DEFAULT NULL,
  `ID` int(11) NOT NULL DEFAULT 0,
  `Auteur` text DEFAULT NULL,
  `Date de sortie` date DEFAULT NULL,
  `nombre en stock` int(11) NOT NULL DEFAULT 0,
  `nombre disponible` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Livres`
--

INSERT INTO `Livres` (`Titre`, `ID`, `Auteur`, `Date de sortie`, `nombre en stock`, `nombre disponible`) VALUES
('le temps des tempetes', 14785629, 'Nicolas Sarkozy', '2020-07-24', 25, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `identifiant` text DEFAULT NULL,
  `Numero Carte` int(11) NOT NULL DEFAULT 0,
  `Nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `mot de passe` text DEFAULT NULL,
  `emprunts` text DEFAULT NULL,
  `ADMIN` text NOT NULL DEFAULT 'NON'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`identifiant`, `Numero Carte`, `Nom`, `prenom`, `mail`, `mot de passe`, `emprunts`, `ADMIN`) VALUES
('nounourse85', 11448596, 'Legrand', 'Xavier', 'blabla@gmail.com', 'pattate', 'rien', 'NON'),
('Gwen.ts', 25147796, 'Tillaite-Stabwond', 'Gwen', 'GWS@gmail.com', 'STABYSTAB', 'rien', 'OUI');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Dinosaures`
--
ALTER TABLE `Dinosaures`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Livres`
--
ALTER TABLE `Livres`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Numero Carte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
