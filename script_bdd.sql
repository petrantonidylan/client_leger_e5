CREATE TABLE Categorie(
   categorie_id INT IDENTITY,
   categorie_nom VARCHAR(100)  NOT NULL,
   PRIMARY KEY(categorie_id),
   UNIQUE(categorie_nom)
);

CREATE TABLE Acteur(
   acteur_id INT IDENTITY,
   acteur_nom VARCHAR(100)  NOT NULL,
   acteur_prenom VARCHAR(100) ,
   PRIMARY KEY(acteur_id)
);

CREATE TABLE Film(
   film_id INT IDENTITY,
   film_titre VARCHAR(100)  NOT NULL,
   film_description VARCHAR(max),
   film_date DATE NOT NULL,
   film_image VARCHAR(255)  NOT NULL,
   film_note INT NOT NULL,
   film_lien VARCHAR(255) ,
   categorie_id INT NOT NULL,
   PRIMARY KEY(film_id),
   UNIQUE(film_titre),
   FOREIGN KEY(categorie_id) REFERENCES Categorie(categorie_id)
);

CREATE TABLE Jouer(
   film_id INT,
   acteur_id INT,
   cachet_tournage INT NOT NULL,
   PRIMARY KEY(film_id, acteur_id),
   FOREIGN KEY(film_id) REFERENCES Film(film_id),
   FOREIGN KEY(acteur_id) REFERENCES Acteur(acteur_id)
);

---------------------------------------------------------------------

INSERT INTO Categorie (categorie_nom)
VALUES ('Comédie');

INSERT INTO Categorie (categorie_nom)
VALUES ('Science-fiction');

INSERT INTO Film (
   film_titre,
   film_description,
   film_date,
   film_image,
   film_note,
   film_lien,
   categorie_id
)
VALUES (
   'Taxi 4',
   'Alors que la ville de Marseille n a d yeux que pour le foot, un très dangereux braqueur belge est transféré au commissariat dirigé par le commissaire Gibert avant d être envoyé au Congo pour y être jugé. Mais l incompétence et la maladresse de la brigade permet au criminel de s évader en toute tranquillité.',
   '2007-02-14',
   'taxi4.jpg',
   3,
   'https://www.youtube.com/embed/i6bdARrCQl4?si=vtnM5qcH7fp75WfW',
   1
),
(
   'Treize à la douzaine',
   'La famille Baker habitait Midland avant de déménager à Chicago à cause de M. Baker, qui y a trouvé le travail de ses rêves : entraîneur d une équipe de football américain.',
   '2003-12-25',
   'treize.jpg',
   5,
   'https://www.youtube.com/embed/wSK0ZszlWOU?si=igRaY2gKMkUm1WPk',
   1
),
(
   'Tenet',
   'Un agent de la CIA, le protagoniste (John David Washington), s infiltre au sein d une opération clandestine russe : le vol d un objet mystérieux, supposé être du plutonium, durant une prise d otages dans un opéra à Kiev.',
   '2020-08-26',
   'tenet.jpg',
   4,
   'https://www.youtube.com/embed/6UG5LJQNjts?si=-QmPYcdAJtzsT-aJ',
   2
),
(
   'Harry Potter 2',
   'Alors que l oncle Vernon, la tante Pétunia et son cousin Dudley reçoivent d importants invités à dîner, Harry Potter est contraint de passer la soirée dans sa chambre.',
   '2002-12-04',
   'hp2.jpg',
   3,
   'https://www.youtube.com/embed/Z3T8PuWuoL0?si=C4QuN4pByFjJJo__',
   2
),
(
   'Barbie',
   '---',
   '2023-12-04',
   'barbie.jpg',
   2,
   'https://www.youtube.com/embed/2oOzWcbVf1c?si=opJvoakkigLSyBrz',
   1
),
(
   'Charlie et la chocolaterie',
   '---',
   '2003-12-04',
   'ch.jpeg',
   4,
   'https://www.youtube.com/embed/qmqp7y1e2_E?si=Cg2SwYEj2PWyZC1F',
   2
),
(
   'Le voyage de Chihiro',
   '---',
   '2001-12-04',
   'undefined.jpg',
   4,
   'https://www.youtube.com/embed/EhIZrZQoHuA?si=5aYb6X72lAPCuTic',
   5
),
(
   'Avatar',
   '---',
   '2001-12-04',
   'avatar1.jpg',
   3,
   'https://www.youtube.com/embed/O1CzgULNRGs?si=vsCf0BQQl3mZr4Df',
   2
);

INSERT INTO Acteur (acteur_nom, acteur_prenom)
VALUES ('Naceri', 'Samy'),
('Diefenthal', 'Frédéric'),
('Welling', 'Tom'),
('Radcliff', 'Daniel'),
('Grint', 'Rupert');

INSERT INTO Jouer (film_id, acteur_id, cachet_tournage)
VALUES (1, 1, 4500),(1, 2, 4400),(6, 3, 12500),(10, 4, 125000);

CREATE TABLE Utilisateur(
   utilisateur_id INT IDENTITY,
   utilisateur_login VARCHAR(100)  NOT NULL,
   utilisateur_pass VARCHAR(300)  NOT NULL,
   PRIMARY KEY(utilisateur_id),
   UNIQUE(utilisateur_login)
);


INSERT INTO Utilisateur (utilisateur_login, utilisateur_pass)
VALUES ('Dylan', 'root')

CREATE TABLE Log(
   log_id INT IDENTITY,
   log_success BIT NOT NULL,
   log_date DATE NOT NULL,
   utilisateur_id INT NOT NULL,
   PRIMARY KEY(log_id),
   FOREIGN KEY(utilisateur_id) REFERENCES Utilisateur(utilisateur_id)
);

INSERT INTO Log (log_success, log_date, utilisateur_id)
VALUES (1, '2024-05-20', 1);

---------------------------------------------------------

--TRIGGERS

CREATE TRIGGER T_01_Categorie
ON Categorie
AFTER INSERT, UPDATE
AS
BEGIN
UPDATE
   Categorie
SET
   categorie_nom = UPPER(LEFT(inserted.categorie_nom, 1)) + LOWER(SUBSTRING(inserted.categorie_nom, 2, LEN(inserted.categorie_nom)))
FROM
   Categorie, inserted
WHERE
   Categorie.categorie_id = inserted.categorie_id
END