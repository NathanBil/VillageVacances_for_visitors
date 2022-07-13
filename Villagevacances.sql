DROP TABLE IF EXISTS village CASCADE;
DROP TABLE IF EXISTS type CASCADE;
DROP TABLE IF EXISTS logement CASCADE;
DROP TABLE IF EXISTS vacances CASCADE;
DROP TABLE IF EXISTS reservation CASCADE;
DROP TABLE IF EXISTS employe CASCADE;
DROP TABLE IF EXISTS service CASCADE;
DROP TABLE IF EXISTS dispose CASCADE;

CREATE TABLE village(
	idvilla serial primary key,
	nom varchar(25) NOT NULL,
	ville varchar(200) NOT NULL,
	region varchar(200) NOT NULL,
	superficiekm2 decimal NOT NULL,
	description text
);

INSERT INTO village(nom,ville,region,superficiekm2) VALUES ('Aqualagon', 'Rennes','Bretagne', '50');
INSERT INTO village(nom,ville,region,superficiekm2) VALUES ('Aiguèze', 'Bagnols-sur-Cèze','Gard', '40');
INSERT INTO village(nom,ville,region,superficiekm2) VALUES ('Pantoise', 'Yves-sur-Seine','Bourgogne', '80');
INSERT INTO village(nom,ville,region,superficiekm2) VALUES ('Angles-sur-Anglin', 'Vienne','Nouvelle-Aquitaine', '63');



CREATE TABLE type(
	idtype serial primary key,
	prix decimal NOT NULL,
	gamme VARCHAR(50) NOT NULL CHECK(gamme = 'haut' OR gamme = 'bas' OR gamme ='milieu'),
	nbplace int NOT NULL
);

INSERT INTO type(prix,gamme,nbplace) VALUES ('500', 'haut', '5');
INSERT INTO type(prix,gamme,nbplace) VALUES ('450', 'milieu', '4');
INSERT INTO type(prix,gamme,nbplace) VALUES ('400', 'bas', '2');

CREATE TABLE logement(
	idlog serial primary key,
	idvilla int REFERENCES village(idvilla) 
	ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	idtype int REFERENCES type(idtype)
	ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	superficiem2 decimal NOT NULL,
	nblit int NOT NULL,
	nbchambre int NOT NULL,
	description text
);

INSERT INTO logement(superficiem2,nblit,nbchambre,description,idtype,idvilla) VALUES ('40', '2', '2', 'Entrée, douche et wc, 2 chambres à 2 lits avec coin toilette et balcon.','1','1');
INSERT INTO logement(superficiem2,nblit,nbchambre,description,idtype,idvilla) VALUES ('40', '1', '1', ' 3 lits séparés par une cloison mobile avec coin toilette, wc, douche.','1','1');
INSERT INTO logement(superficiem2,nblit,nbchambre,description,idtype,idvilla) VALUES ('40', '3', '4', 'Adapté pour les personnes a mobilité réduite .','1','2');
INSERT INTO logement(superficiem2,nblit,nbchambre,description,idtype,idvilla) VALUES ('40', '1', '2', 'Entrée, douche et wc, 1 lit double .','1','3');
INSERT INTO logement(superficiem2,nblit,nbchambre,description,idtype,idvilla) VALUES ('40', '2', '3', 'Entrée, douche et wc, 1 lit double .','2','4');

CREATE TABLE employe(
	ide serial primary key,
	nom VARCHAR(50) NOT NULL,
	prenom VARCHAR(20) NOT NULL,
	mdp VARCHAR(20) NOT NULL,
	login VARCHAR(20) UNIQUE NOT NULL,
	titre VARCHAR(10) NOT NULL CHECK(titre = 'admin' OR titre = 'user')
);
INSERT INTO employe(nom,prenom,mdp,login,titre) VALUES ('John', 'Doe','2456', 'JohnDoe','user');
INSERT INTO employe(nom,prenom,mdp,login,titre) VALUES ('John', 'Doe','2357', 'JohnDoe2','user');
INSERT INTO employe(nom,prenom,mdp,login,titre) VALUES ('Bruel', 'Patrick','3333', 'Patstar','user');
INSERT INTO employe(nom,prenom,mdp,login,titre) VALUES ('Jean', 'Castex','7899', 'JCX','admin');
INSERT INTO employe(nom,prenom,mdp,login,titre) VALUES ('Nolan', 'Christopher','8756', 'ChrisNol','user');

CREATE TABLE vacances(
	idv serial primary key,
	datedebut date NOT NULL,
	datefin date NOT NULL CHECK(datefin > datedebut),
	nom VARCHAR(100) NOT NULL,
	localisation VARCHAR(100) NOT NULL,
	zone VARCHAR(100) NOT NULL,
	annee_scolaire VARCHAR(50) NOT NULL,
	CONSTRAINT vacances_unique UNIQUE (datedebut,datefin,nom,zone,annee_scolaire,localisation)
);

INSERT INTO vacances(datedebut,datefin,nom,localisation,zone,annee_scolaire) VALUES ('21/12/2009', '04/01/2010','Vacances de Noël', 'Corse','Corse','2009-2010');
CREATE TABLE reservation(
	idr serial primary key,
	ide int REFERENCES employe(ide)
ON DELETE CASCADE ON UPDATE CASCADE NOT NULL, 
    	idlog int REFERENCES logement(idlog)
ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	idtype int REFERENCES type(idtype)
ON DELETE CASCADE ON UPDATE CASCADE NOT NULL, 
	idv int REFERENCES vacances(idv)
ON DELETE CASCADE ON UPDATE CASCADE NOT NULL, 
	prix decimal NOT NULL,
	datereserv date NOT NULL,
	datedebut date NOT NULL CHECK(datedebut >= datereserv),
	datefin date NOT NULL CHECK(datefin = datedebut+7),
	statut VARCHAR(15) NOT NULL CHECK(statut = 'valide' OR statut = 'invalide' OR statut ='en cours'),
	CONSTRAINT reservation_unique UNIQUE (datedebut,datefin,idlog)
);
INSERT INTO reservation(ide,idlog,idtype,prix,datereserv,datedebut,datefin,statut,idv) VALUES ('1', '1','1', '500','2013-07-21','2020-08-22', '2020-08-29','en cours','1');
INSERT INTO reservation(ide,idlog,idtype,prix,datereserv,datedebut,datefin,statut,idv) VALUES ('1', '2','2', '450','2013-07-20','2020-07-21','2020-07-28','valide','1');
INSERT INTO reservation(ide,idlog,idtype,prix,datereserv,datedebut,datefin,statut,idv) VALUES ('3', '3','3', '400','2013-07-26','2020-08-05','2020-08-12','invalide','1');
INSERT INTO reservation(ide,idlog,idtype,prix,datereserv,datedebut,datefin,statut,idv) VALUES ('4', '4','3', '400','2013-07-28','2020-08-18','2020-08-25','invalide','1');

CREATE TABLE service(
	ids SERIAL PRIMARY KEY,
	nom VARCHAR(50) NOT NULL,
	description text
);
INSERT INTO service(nom,description) VALUES ('Internet', 'Connexion wifi disponible');
INSERT INTO service(nom,description) VALUES ('Ordinateur', 'Windows 10, Office');
INSERT INTO service(nom,description) VALUES ('Imprimante', 'Imprimante laser');
INSERT INTO service(nom) VALUES ('demi-pension');
INSERT INTO service(nom) VALUES ('pension complète');
INSERT INTO service(nom) VALUES ('ménage fin de séjour');

CREATE TABLE dispose(
    ids int REFERENCES service(ids)
ON DELETE CASCADE ON UPDATE CASCADE NOT NULL, 
    idr int REFERENCES reservation(idr)
ON DELETE CASCADE ON UPDATE CASCADE NOT NULL, 
    CONSTRAINT PKEY_dispose PRIMARY KEY(ids,idr)
    
);

INSERT INTO dispose(idr,ids) VALUES ('1', '1');
INSERT INTO dispose(idr,ids) VALUES ('2', '2');
INSERT INTO dispose(idr,ids) VALUES ('2', '3');
INSERT INTO dispose(idr,ids) VALUES ('3', '2');


