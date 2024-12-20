DROP DATABASE IF EXISTS LMS_Veiligheid;
CREATE DATABASE IF NOT EXISTS LMS_Veiligheid;

USE LMS_Veiligheid;

-- Tabelen --

CREATE TABLE Rollen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Rechten (
    naam VARCHAR(50) PRIMARY KEY
);

CREATE TABLE Rollen_rechten (
    rol_id INT, 
    recht_naam VARCHAR(50),
    PRIMARY KEY (rol_id, recht_naam),
    FOREIGN KEY (rol_id) REFERENCES Rollen(id) ON DELETE CASCADE,
    FOREIGN KEY (recht_naam) REFERENCES Rechten(naam) ON DELETE CASCADE
);

CREATE TABLE Gebruikers (
    e_mail VARCHAR(255) PRIMARY KEY,
    voor_naam VARCHAR(50) NOT NULL,
    tussenvoegsel VARCHAR(20),
    achter_naam VARCHAR(50) NOT NULL,
    foto VARCHAR(255),
    wachtwoord VARCHAR(255) NOT NULL,  -- Verwacht gehashte wachtwoorden
    telefoon_nummer VARCHAR(20) CHECK (telefoon_nummer REGEXP '^[0-9]+$'),
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CHECK (e_mail LIKE '%_@__%.__%') -- Zorgt voor validatie van e-mails
);

CREATE TABLE Gebruikers_rollen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikers_e_mail VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL,
    toegevoeg_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (gebruikers_e_mail, rol_id),
    FOREIGN KEY (gebruikers_e_mail) REFERENCES Gebruikers(e_mail) ON DELETE CASCADE,
    FOREIGN KEY (rol_id) REFERENCES Rollen(id) ON DELETE CASCADE
);

CREATE TABLE Categorieën (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Rollen_categorieën (
    rol_id INT,
    categorie_id INT,
    PRIMARY KEY (rol_id, categorie_id),
    FOREIGN KEY (rol_id) REFERENCES Rollen(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES Categorieën(id) ON DELETE CASCADE
);

CREATE TABLE Meldingen_categorieën (
    melding_nummer INT,
    categorie_id INT,
    PRIMARY KEY (melding_nummer, categorie_id),
    FOREIGN KEY (melding_nummer) REFERENCES Meldingen(melding_nummer) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES Categorieën(id) ON DELETE CASCADE
);

CREATE TABLE Meldingen (
    melding_nummer INT AUTO_INCREMENT PRIMARY KEY,
    gebruikers_email VARCHAR(255) NOT NULL,
    melding_onderwerp VARCHAR(150),
    melding_info TEXT,
    datum_van_melding TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    afgehandeld BOOLEAN DEFAULT 0,
    prioriteit INT(1) NOT NULL CHECK (prioriteit BETWEEN 1 AND 5),      
    toren VARCHAR(1) NOT NULL,       
    verdieping INT(2) NOT NULL,      
    klas_ruimte VARCHAR(64) NOT NULL,
    FOREIGN KEY (gebruikers_email) REFERENCES Gebruikers(e_mail)
);

CREATE TABLE Melding_fotos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    link VARCHAR(255),
    melding_id INT,
    FOREIGN KEY (melding_id) REFERENCES Meldingen(melding_nummer) ON DELETE CASCADE
);

CREATE TABLE Acties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    omschrijving VARCHAR(255),
    melding_nummer INT,
    gebruiker_e_mail VARCHAR(255),
    FOREIGN KEY (melding_nummer) REFERENCES Meldingen(melding_nummer) ON DELETE CASCADE,
    FOREIGN KEY (gebruiker_e_mail) REFERENCES Gebruikers(e_mail) ON DELETE SET NULL
);

CREATE TABLE News (
    id INT AUTO_INCREMENT PRIMARY KEY,
    foto VARCHAR(255),
    title VARCHAR(255),
    text TEXT
);

-- Dummy data --

INSERT INTO Rollen (naam) VALUES 
('Admin'),
('User'),
('Manager');

INSERT INTO Rechten (naam) VALUES 
('view_reports'),
('edit_users'),
('manage_incidents');

INSERT INTO Rollen_rechten (rol_id, recht_naam) VALUES 
(1, 'view_reports'),
(1, 'edit_users'),
(1, 'manage_incidents'),
(2, 'view_reports'),
(3, 'manage_incidents');

INSERT INTO Gebruikers (e_mail, voor_naam, tussenvoegsel, achter_naam, foto, wachtwoord, telefoon_nummer) VALUES 
('admin@example.com', 'John', NULL, 'Doe', 'john.jpg', 'password123', '1234567890'),
('user1@example.com', 'Jane', 'van', 'Smith', 'jane.jpg', 'password456', '2345678901'),
('manager@example.com', 'Alex', NULL, 'Johnson', 'alex.jpg', 'password789', '3456789012');

INSERT INTO Gebruikers_rollen (gebruikers_e_mail, rol_id) VALUES
('admin@example.com', 1),
('admin@example.com', 2),
('user1@example.com', 2),
('manager@example.com', 3);

INSERT INTO Categorieën (naam) VALUES
('Beveiliging'),
('Economie'),
('Docent'),
('Conciërge');

INSERT INTO Rollen_categorieën (rol_id, categorie_id) VALUES
(1, 1),  -- Admin kan alle categorieën zien
(2, 2),  -- User (bijvoorbeeld docenten) kan bijvoorbeeld alleen de Economie categorie zien
(3, 3),  -- Manager kan de Docent categorie zien
(3, 4);  -- Manager kan de Conciërge categorie zien

INSERT INTO Meldingen (gebruikers_email, melding_onderwerp, melding_info, datum_van_melding, afgehandeld, prioriteit, toren, verdieping, klas_ruimte)
VALUES 
('admin@example.com', 'Beveiligingstoegang verlopen', 'De beveiligingstoegang is verlopen voor gebouw A.', '2023-11-27 09:00:00', 0, 1, 'A', 1, 'S101'),
('user1@example.com', 'Economie lesmateriaal', 'Er is een probleem met het lesmateriaal van Economie.', '2023-11-27 10:00:00', 0, 2, 'B', 2, 'E202');

INSERT INTO Meldingen_categorieën (melding_nummer, categorie_id) VALUES 
(1, 1),  -- Beveiligingstoegang melding naar de Beveiliging categorie
(2, 2),  -- Lesmateriaal melding naar de Economie categorie
(1, 2);  -- Beveiligingstoegang melding ook naar de Economie categorie (meerdere categorieën per melding)

INSERT INTO Melding_fotos (link, melding_id) VALUES 
('http://example.com/photo1.jpg', 1),
('http://example.com/photo2.jpg', 2);

INSERT INTO Acties (omschrijving, melding_nummer, gebruiker_e_mail) VALUES 
('Beveiligingstoegang hersteld', 1, 'admin@example.com'),
('Lesmateriaal geüpdatet', 2, 'user1@example.com');

INSERT INTO News (foto, title, text) VALUES 
('news1.jpg', 'New Office Opening', 'We are excited to announce the opening of our new office.'),
('news2.jpg', 'Annual Company Picnic', 'Join us for the annual company picnic this weekend.');

-- Query's --

SELECT * FROM Rollen;
SELECT * FROM Rechten;
SELECT * FROM Rollen_rechten;
SELECT * FROM Gebruikers;
SELECT * FROM Gebruikers_rollen;
SELECT * FROM Meldingen;
SELECT * FROM Melding_fotos;
SELECT * FROM Acties;
SELECT * FROM News;

-- Voorbeeld: Krijg alle meldingen die toegankelijk zijn voor de rol 'Manager' (Rol ID 3)
SELECT Melding_nummer, melding_onderwerp, melding_info, datum_van_melding
FROM Meldingen M
JOIN Meldingen_categorieën MC ON M.melding_nummer = MC.melding_nummer
JOIN Rollen_categorieën RC ON MC.categorie_id = RC.categorie_id
WHERE RC.rol_id = 3;

