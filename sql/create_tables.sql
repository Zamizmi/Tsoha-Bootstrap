-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kurssi(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	kurssitunnus varchar(50) NOT NULL,
	kuvaus varchar(500) NOT NULL
);

CREATE TABLE Aihe(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	englanniksi varchar(50) NOT NULL,
	kuvaus varchar(500) NOT NULL
);

CREATE TABLE Opiskelija(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	salasana varchar(50) NOT NULL
);

CREATE TABLE Termi(
	id SERIAL PRIMARY KEY,
	opiskelija_id INTEGER REFERENCES Opiskelija(id),
	nimi varchar(50) NOT NULL,
	englanniksi varchar(50) NOT NULL,
	kuvaus varchar(500) NOT NULL
);

CREATE TABLE Termiaihe(
	termi_id INTEGER REFERENCES Termi(id),
	aihe_id INTEGER REFERENCES Aihe(id)
);

CREATE TABLE Kurssiaihe(
	kurssi_id INTEGER REFERENCES Kurssi(id),
	aihe_id INTEGER REFERENCES Aihe(id)
);