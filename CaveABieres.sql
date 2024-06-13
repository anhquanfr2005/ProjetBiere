BEGIN TRANSACTION;
CREATE TABLE Biere (
	NoBiere INTEGER PRIMARY KEY  DEFAULT (null) ,
	Brasseur VARCHAR(40) NOT NULL  DEFAULT (null) ,
	Type_Biere VARCHAR(10) NOT NULL CHECK (Type_Biere IN ('blanche','blonde','ambree','abbaye','aromatisee')),
	Pays VARCHAR(30) NOT NULL,
	prix FLOAT DEFAULT (null));
CREATE TABLE Stock_cave (
	NoStock SERIAL PRIMARY KEY ,
	Quantite INTEGER NOT NULL ,
	NoBiere INTEGER NOT NULL  DEFAULT (null),
	CONSTRAINT fk_NoBiere FOREIGN KEY (NoBiere) REFERENCES Biere (NoBiere) ON DELETE CASCADE ON UPDATE CASCADE,
	);

insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (1,'duff', 'blonde', 'France', 5.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (2,'leffe', 'blanche', 'Espagne', 7.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (3,'ar-men', 'abbaye', 'Suisse', 4.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (4,'desperados', 'aromatisee', 'Belge', 6.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (5,'corona', 'blonde', 'Allemagne', 4.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (6,'grimbergen', 'blonde', 'Allemagne', 9.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (7,'1673', 'blonde', 'Allemagne', 11.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (8,'unibrou', 'blonde', 'Allemagne', 10.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (9,'ken', 'blonde', 'Allemagne', 7.99);
insert into Biere (NoBiere, Brasseur, Type_Biere, Pays, prix) values (10,'saint-colomb', 'blonde', 'Allemagne', 3.99);

insert into Stock_cave (NoStock, Quantite, NoBiere) values (1,3,1);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (2,12,2);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (3,96,3);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (4,51,4);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (5,28,5);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (6,75,6);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (7,104,7);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (8,7,8);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (9,19,9);
insert into Stock_cave (NoStock, Quantite, NoBiere) values (10,61,10);
