-- Création de la base de données
CREATE DATABASE IF NOT EXISTS DataWare;
USE DataWare;

-- Création de la table Équipes
CREATE TABLE Equipes (
    ID_Equipe INT PRIMARY KEY,
    Nom_Equipe VARCHAR(255),
    Date_Creation DATE
);

-- Création de la table Membres du Personnel
CREATE TABLE Membres_Personnel (
    ID_Membre INT PRIMARY KEY,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    Email VARCHAR(255),
    Telephone VARCHAR(15),
    Role VARCHAR(50),
    Equipe INT,
    Statut VARCHAR(50),
    FOREIGN KEY (Equipe) REFERENCES Equipes(ID_Equipe)
);

-- Ajout de données initiales pour les équipes
INSERT INTO Equipes (ID_Equipe, Nom_Equipe, Date_Creation) VALUES
(1, 'Equipe A', '2023-01-01'),
(2, 'Equipe B', '2023-02-01');

-- Ajout de données initiales pour les membres du personnel
INSERT INTO Membres_Personnel (ID_Membre, Nom, Prenom, Email, Telephone, Role, Equipe, Statut) VALUES
(1, 'Doe', 'John', 'john.doe@example.com', '123456789', 'Développeur', 1, 'Actif'),
(2, 'Smith', 'Jane', 'jane.smith@example.com', '987654321', 'Analyste', 2, 'Inactif');
