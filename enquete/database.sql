-- Create database
CREATE DATABASE enquete_database;

-- Use the database
USE enquete_database;

-- Create the table
CREATE TABLE survey_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vraag TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    opties TEXT
);

-- Add sample data
INSERT INTO survey_questions (vraag, type, opties) VALUES
('Wat is uw favoriete kleur?', 'radio', 'Rood,Blauw,Groen'),
('Beschrijf uzelf in één woord.', 'text', NULL),
('Welke hobby\'s heeft u?', 'checkbox', 'Lezen,Reizen,Sporten'),
('Kies een land waar u zou willen wonen.', 'dropdown', 'Nederland,België,Duitsland');
