-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 jan. 2023 à 22:08
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `Titre` text DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`Titre`, `contenu`, `image`, `ID`) VALUES
('Nos petits compagnons les dinosaures', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rutrum vehicula felis, fringilla tempor orci tincidunt vitae. In sodales tincidunt lectus et laoreet. Vivamus sit amet nibh tellus. Vivamus ac efficitur massa. In accumsan ante et faucibus pretium. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer nec. ', '0', 0),
('Ouverture', 'Notre bibliothèque est maintenant ouverte au public', '0', 1);

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `ID` int(11) NOT NULL,
  `valide` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`ID`, `valide`) VALUES
(0, 20230112),
(1, 20230112),
(2, 20230112);

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `ID_Member` int(11) NOT NULL,
  `ID_Book` int(11) NOT NULL,
  `Date` int(11) NOT NULL,
  `Return_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`ID_Member`, `ID_Book`, `Date`, `Return_date`) VALUES
(0, 0, 20220112, 20220119),
(2, 2, 20220112, 20220119),
(1, 2, 20220112, 20220119);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `ID_Member` int(11) NOT NULL,
  `ID_Book` int(11) NOT NULL,
  `Date` int(11) NOT NULL,
  `Return_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`ID_Member`, `ID_Book`, `Date`, `Return_date`) VALUES
(1, 0, 20220112, 20220112),
(1, 1, 20220110, 20220112);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `Titre` text DEFAULT NULL,
  `ID` int(11) NOT NULL DEFAULT 0,
  `Auteur` text DEFAULT NULL,
  `Date de sortie` date DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`Titre`, `ID`, `Auteur`, `Date de sortie`, `description`) VALUES
('le temps des tempetes', 0, 'Nicolas Sarkozy', '2020-07-25', 'magnifique livre écrit par un grand homme'),
('Le livre extraordinaire des dinosaures', 1, 'Tom Jackson', '2017-05-21', 'Et si on regardait ce tricératops de plus près ? Quelle était la vitesse de pointe du vélociraptor ? Combien de kilos de viande le tyrannosaure pouvait-il avaler en une seule bouchée ?'),
('Imagerie des dinosaures et de la préhistoire', 2, 'Émilie Beaumont', '1997-02-15', 'permet aux enfants de découvir les dinosaures');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_Member` int(11) NOT NULL,
  `ID_Book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `ID_Book` int(11) NOT NULL,
  `Number` int(11) NOT NULL,
  `Available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`ID_Book`, `Number`, `Available`) VALUES
(0, 5, 4),
(1, 8, 8),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `identifiant` text DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `Nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `mot de passe` text DEFAULT NULL,
  `ADMIN` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`identifiant`, `ID`, `Nom`, `prenom`, `mail`, `mot de passe`, `ADMIN`) VALUES
('Gwen.ts', 0, 'Tillaite-Stabwond', 'Gwen', 'GWS@gmail.com', 'STABYSTAB', 1),
('nounourse85', 1, 'Legrand', 'Xavier', 'blabla@gmail.com', 'pattate', 0),
('jj72', 2, 'jean', 'jean', 'jj@jjmail.jj', 'jj', 1),
('JP72', 3, 'Patrique', 'Jean', 'jp@jjmail.jj', 'JPLES', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_Book`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
