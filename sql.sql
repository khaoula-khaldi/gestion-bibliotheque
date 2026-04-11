
CREATE DATABASE gestion_bibliotheque;
drop database gestion_bibliotheque;
USE gestion_bibliotheque;

-- ========================
-- TABLE USERS
-- ========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    role ENUM('lecteur', 'bibliothecaire') DEFAULT 'lecteur',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================
-- TABLE AUTEURS
-- ========================
CREATE TABLE auteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    date_naissance DATE,
    biographie TEXT
);

-- ========================
-- TABLE LIVRES
-- ========================
CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    isbn VARCHAR(50) UNIQUE,
    annee INT,
    type ENUM('free', 'premium') DEFAULT 'free',
    prix DECIMAL(8,2) DEFAULT 0,
    disponible BOOLEAN DEFAULT TRUE,
    auteur_id INT,
    FOREIGN KEY (auteur_id) REFERENCES auteurs(id)
);

-- ========================
-- TABLE EMPRUNTS
-- ========================
CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    livre_id INT,
    date_emprunt DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_retour DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (livre_id) REFERENCES livres(id)
);

-- ========================
-- TABLE ACHATS
-- ========================
CREATE TABLE achats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    livre_id INT,
    prix DECIMAL(8,2),
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (livre_id) REFERENCES livres(id)
);

-- ========================
-- TABLE SUBSCRIPTIONS
-- ========================
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('mensuel', 'annuel'),
    date_debut DATE,
    date_fin DATE,
    st('Chraïbi', 'Driss', '1926-07-15', 'Fondateur de la littérature marocaine moderne d expression française.', NOW(), NOW()),
('Ben Jelloun', 'Tahar', '1944-12-01', 'Poète et écrivain marocain de renommée internationale.', NOW(), NOW()),
('Camus', 'Albert', '1913-11-07', 'Philosophe et écrivain français, Prix Nobel.', NOW(), NOW()),
('Orwell', 'George', '1903-06-25', 'Célèbre pour ses œuvres dystopiques.', NOW(), NOW()),
('Hugo', 'Victor', '1802-02-26', 'Chef de file du romantisme français.', NOW(), NOW()),
('Coelho', 'Paulo', '1947-08-24', 'Auteur brésilien du célèbre Alchimiste.', NOW(), NOW()),
('Mernissi', 'Fatema', '1940-09-27', 'Sociologue et écrivaine féministe marocaine.', NOW(), NOW()),
('Kafka', 'Franz', '1883-07-03', 'Auteur majeur du XXème siècle.', NOW(), NOW()),
('Hemingway', 'Ernest', '1899-07-21', 'Écrivain et journaliste américain.', NOW(), NOW());

INSERT INTO livres (titre, isbn, annee, type, description, prix_achat, prix_emprunt, disponible, quantite, image, auteur_id, created_at, updated_at) VALUES 
('Léon l\'Africain', 'ISBN001', 1986, 'premium', 'Un récit de voyage époustouflant.', 150.00, 20.00, 1, 10, NULL, 1, NOW(), NOW()),
('Samarcande', 'ISBN002', 1988, 'premium', 'L histoire d un manuscrit perdu.', 140.00, 18.00, 1, 5, NULL, 1, NOW(), NOW()),
('Le Passé Simple', 'ISBN003', 1954, 'premium', 'Une révolte contre le patriarcat.', 110.00, 15.00, 1, 7, NULL, 2, NOW(), NOW()),
('La Civilisation ma Mère', 'ISBN004', 1972, 'free', 'Un hommage à la mère marocaine.', 90.00, 10.00, 1, 12, NULL, 2, NOW(), NOW()),
('L\'Enfant de Sable', 'ISBN005', 1985, 'premium', 'L histoire d une fille élevée comme un garçon.', 130.00, 25.00, 1, 4, NULL, 3, NOW(), NOW()),
('La Nuit Sacrée', 'ISBN006', 1987, 'premium', 'Suite de L Enfant de Sable.', 135.00, 22.00, 1, 6, NULL, 3, NOW(), NOW()),
('L\'Étranger', 'ISBN007', 1942, 'premium', 'Roman sur l absurde.', 100.00, 15.00, 1, 15, NULL, 4, NOW(), NOW()),
('La Peste', 'ISBN008', 1947, 'free', 'Chronique d une épidémie à Oran.', 115.00, 12.00, 1, 8, NULL, 4, NOW(), NOW()),
('1984', 'ISBN009', 1949, 'premium', 'Le monde sous Big Brother.', 125.00, 20.00, 1, 20, NULL, 5, NOW(), NOW()),
('La Ferme des Animaux', 'ISBN010', 1945, 'free', 'Fable satirique sur la révolution.', 85.00, 8.00, 1, 10, NULL, 5, NOW(), NOW()),
('Les Misérables', 'ISBN011', 1862, 'premium', 'Le destin de Jean Valjean.', 180.00, 30.00, 1, 5, NULL, 6, NOW(), NOW()),
('Notre-Dame de Paris', 'ISBN012', 1831, 'premium', 'L histoire de Quasimodo.', 160.00, 25.00, 1, 3, NULL, 6, NOW(), NOW()),
('L\'Alchimiste', 'ISBN013', 1988, 'premium', 'Suivez votre légende personnelle.', 95.00, 15.00, 1, 25, NULL, 7, NOW(), NOW()),
('Le Pèlerin de Compostelle', 'ISBN014', 1987, 'free', 'Un voyage spirituel.', 105.00, 14.00, 1, 9, NULL, 7, NOW(), NOW()),
('Sexe, Idéologie et Islam', 'ISBN015', 1983, 'premium', 'Étude sur la condition féminine.', 145.00, 20.00, 1, 2, NULL, 8, NOW(), NOW()),
('Rêves de Femmes', 'ISBN016', 1994, 'free', 'Une enfance au harem.', 120.00, 18.00, 1, 6, NULL, 8, NOW(), NOW()),
('Le Procès', 'ISBN017', 1925, 'premium', 'La bureaucratie poussée à l absurde.', 110.00, 15.00, 1, 4, NULL, 9, NOW(), NOW()),
('La Métamorphose', 'ISBN018', 1915, 'free', 'Grégoire Samsa devient un insecte.', 70.00, 5.00, 1, 30, NULL, 9, NOW(), NOW()),
('Le Vieil Homme et la Mer', 'ISBN019', 1952, 'premium', 'L homme face à la nature.', 105.00, 12.00, 1, 14, NULL, 10, NOW(), NOW()),
('Pour qui sonne le glas', 'ISBN020', 1940, 'premium', 'Récit de la guerre d Espagne.', 155.00, 22.00, 1, 5, NULL, 10, NOW(), NOW());atut ENUM('actif', 'expiré'),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (name, email, password, role) 
VALUES (
    'Admin', 
    'admin@gmail.com', 
    '$2y$12$8SYOOLSmaSwsWhYoBspgVOn0pFLuDl2ZiEVCVd/uMw01GRG66bvee', -- Hadi ghadi t-hashiha l-SHA256
    'admin'
);
INSERT INTO auteurs (nom, prenom, date_naissance, biographie, created_at, updated_at) VALUES 
('Maalouf', 'Amin', '1949-02-25', 'Écrivain franco-libanais, prix Goncourt 1993.', NOW(), NOW()),

DESCRIBE livres;

INSERT INTO subscriptions (user_id, type, date_debut, date_fin, statut, created_at, updated_at) 
VALUES (2, 'mensuel', '2025-04-01', '2026-04-07', 'actif', NOW(), NOW());
update users set password= password('123456789') where id=1;
select * from users where id=1;


-- Jib liya l-uniques titre dyal l-ktob lli t-kharjou bin 1900 o 2000,
-- o ikoun l-prix dyalhom kber mn 100 DH, o rttebhom men l-ghali l-rkhis."
select titre from livres where annee between 1900 and 2000 and prix_emprunt>100;
/*
Jib ghir l-ktob lli t-kharjou men be3d l-3am 1950.

Khass l-ktob ikounu Premium (type = 'premium').

Smiya dyal ktab (titre) khass ikoun fiha l-harf 'a' awla 'A'.

Rtteb l-ktob men l-idid l-qdim (annee DESC).

O f l-akhir, bghit ghir 3 d l-ktob l-lowlin.*/

select * from livres where annee>1950;

select * from livres WHERE type="premium";

select titre from livres where titre like 'A%';

select titre , annee from livres ORDER BY annee desc;
 select * from livres limit 3 ;

 select titre,annee from livres where annee>1950 and type='premium' and titre like 'B%' ORDER BY annee desc ;

 /*Gemini a dit
Nadi! Daba ghadi nchoufo wach hdemti had l-calculatrices dyal SQL mzyan. Ghadi n3tik 3 d l-challenges fihom l-ktab (syntaxe) o l-manteq (logic).

🏆 Challenge 1 : Ihsa'iyat l-Khizana (Basic)
Bghitk t-jib liya had l-m3loumat f ster wahed (Requête waheda):

Ch-hal men ktab 3ndna f l-base de données kamla? (COUNT)

Ch-hal l-mejmou3 d l-prix dyal l-ktob kamlin? (SUM)

Ch-hal howa l-mou3addal (moyenne) dyal l-prix? (AVG)*/

select count(*) , sum(prix_achat) , avg(prix_emprunt) from livres ;

/*🏆 Challenge 2 : L-ghali o l-Rkhis (Filtrage + Agrégation)
Hna bghina n-choufou ghir l-ktob lli Premium:
Arini l-prix dyal aghla ktab premium.
Arini l-prix dyal arkhis ktab premium.
O smi l-a3mida (columns) f l-natija b AS (Exemple: MAX(prix_achat) AS prix_max).*/
select max(prix_achat) as masPrix , min(prix_emprunt) as minPrix  from livres where type="premium";

/*🏆 Challenge 3 : L-Boss Level (Tkhmam)
Hadi chwiya s3iba:

Hseb ch-hal men ktab ktab l-auteur lli 3ndou id = 1.

O f nefs l-weqt, hseb ch-hal mn ktab ktab had l-auteur lli t-kharjou men be3d l-3am 1980.
*/

select count(*) as totalLivre from livres where auteur_id=1 

/*🚀 Challenge (L-itqan):
Kteb lya requête li kat-goulliya:
"Kola auteur_id, ch-hal howa akbar prix (MAX) dyal ktab ktabo?"

(Hint: SELECT auteur_id, MAX(...) ... GROUP BY ...)*/

select auteur_id , max(prix_achat) as maxLivres from livres group by auteur_id;

/*Daba melli fhemti had l-point, jarreb t-jma3 kolchi f had l-query:
"Kola auteur_id, ch-hal mou3addal (AVG) prix dyal l-ktob l-Premium 
dyalou, b shart ikoun had l-mou3addal kber men 100 DH."*/
select auteur_id , avg(prix_achat) as avgLivres 
from livres where type='premium'
GROUP BY auteur_id having avgLivres>100;

/*🚩 Situation 1 : L-Bilan dyal l-Bibliothécaire
L-bibliothécaire bgha i-talla3 wa7ed l-list dyal ga3 l-ktob lli 3ndna, walakin f blast ma i-chouf auteur_id, bgha i-chouf Smiya o l-Knya dyal l-auteur f deqqa wa7da.

Challenge:

Jbed titre, prix, o l-nom dyal l-auteur.

Moulahada: Dir JOIN bin livres o auteurs.*/

select l.titre , l.prix_achat ,a.nom from livres l
inner join auteurs a on l.auteur_id=a.id;

/*Situation 2 : Statistiques dyal l-Auteurs
Daba, bghina n-choufo kola auteur ch-hal k-teb men ktab f had l-bibliothèque.

L-hadaf:

Jbed l-Nom dyal l-auteur.

Hseb 3adad l-ktob (sta3mel COUNT(*)) dyalo.

Sta3mel GROUP BY bach t-jma3 l-hsab kola auteur bohdou.*/
select a.nom ,count(l.id) from auteurs a 
INNER join livres l on a.id=l.auteur_id
GROUP BY a.nom;

/*Situation 3 : Traçabilité dyal l-Emprunts (3 Tables)
Hada howa l-imti7an d l-besseh!
L-admin bgha i-chouf: Smiya d l-User o Titre d l-Ktab lli m-kery (emprunté).

Moulahada:

Khassk t-laqi users m3a emprunts (via user_id).

O t-laqi emprunts m3a livres (via livre_id).*/
select e.statut , u.name , l.titre 
from emprunts e inner join users u on e.user_id=u.id 
inner join livres l on e.livre_id=l.id 
where e.statut='en_cours';

/*🚩 Situation 4 : L-Revenue par Auteur (The Final Boss 🏆)
Hadi hiya l-query lli ghadi t-khallik t-ban "Senior" f l-SQL. Bghina n-choufo l-auteurs lli dakhla menhom l-flouss bzaf.

Challenge:

Jbed l-Nom dyal l-auteur.

Hseb SUM(l.prix) (mejmou3 as3ar l-ktob dyalo).

Dir INNER JOIN bin auteurs o livres.

Dir GROUP BY 3la l-auteur.

Filter (HAVING): Affichi ghir l-auteurs lli l-mejmou3 dyalhom kber men 200 DH.

Kteb l-code o mat-nsach l-moulahada lli dert lik 3la l-Alias f HAVING!*/
select a.nom,sum(l.prix_achat) as prix from auteurs a 
inner join livres l on a.id=l.auteur_id 
GROUP BY a.nom having prix>200;

select * from emprunts where day(date_emprunt) = 4 ;
select * from users where date(created_at)=CURDATE();

select*from users where year(created_at)=2026;

/*🚀 Challenge (Moyen): Statistiques d l-Fil Rouge
Bghina n-choufou "Ch-hal men ktab (COUNT) t-kra f l-3am d 2025".
Tartib d l-khammam:
SELECT l-hisab d l-stora.
FROM table l-kraya.
WHERE l-3am dyal l-date dyalha i-koun 2025.
Jarreb t-ktebha!*/

select count(*) from emprunts where year(date_emprunt)=2025;

/*🚀 Challenge: Niveau Moyen (Filtrage b "Intervalle")
Daba imagine l-admin bgha i-chouf l-ktob lli t-kraw f l-quartier 
l-lowel dyal l-3am (ya3ni men chhar 1 tal chhar 3 dyal 2026).
Hna 3ndek jouj d l-torok (khtat wa7da):
Tariqa 1: Khdem b BETWEEN.
Tariqa 2: Khdem b MONTH(date_emprunt) o dir IN (1, 2, 3).*/

select l.titre,count(e.id) from livres l inner join
 emprunts e on l.id=e.livre_id
  where MONTH(e.date_emprunt) in(1,2,3) group by l.titre;

  select l.titre,count(e.id) from livres l inner join
 achats e on l.id=e.livre_id
  where MONTH(e.date_achat)BETWEEN 1 and 5 group by l.titre ;

  /*Challenge 1 (Update): L-prix dyal ga3 l-ktob lli t-kraw f 2025 (Table livres) 
  khassna n-zidou fihom 10 DH. (Khtar UPDATE livres SET prix = prix + 10 WHERE ...).
Challenge 2 (Delete): Bghina n-ms7ou ga3 l-users lli role dyalhom 'lecteur' o baqi ma-darou 7ta kraya (Hadi s3iba chwiya, khemmem fiha!).*/

update livres 
set prix_emprunt = prix_emprunt+10
where id in (
    select livre_id from emprunts where year(date_emprunt)=1835
);
delete from users 
where role='lecteur' 
and id=
(select user_id from emprunts where date_emprunt is null);

DELETE FROM users 
WHERE role = 'lecteur' 
AND id NOT IN (SELECT user_id FROM emprunts);

/*Challenge (N-choufou wach fhemti l-manteq):
Bghina n-ms7ou (DELETE) ga3 l-ktob dyal l-auteur lli smitou "Camus".
Moulahada: Smyt l-auteur f table auteurs, walakin l-ktob f table livres.*/

delete from livres where auteur_id =(select id from auteurs where nom='Camus');

SELECT name FROM users
UNION all 
SELECT nom FROM auteurs;

select titre from livres where type='free'
union 
select titre from livres where type='Premium'
order by titre;