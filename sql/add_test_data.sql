-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Laskennan Mallit', 'TKT20005','Kurssi syventää opiskelijan tietoja laskettavuudesta.');
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Tietoliikenteen Perusteet', 'TKT20004', 'Kurssin jälkeen opiskelija tietää tietoliikenteen ja Internetin toiminnan perusteet.');
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Tietokoneen Toiminta','TKT10005', 'Kurssilla perehdytään tietokoneohjelman suoritukseen, tietokonelaitteiston komponentteihin sekä laitteiston ja käyttöjärjestelmän luomaan ohjelman suoritusympäristöön.');
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Tietokantasovellus Harjoitustyö', 'TKT20011', 'Kurssilla harjoitellaan tietokantaohjelmointia käytännössä ja opitaan samalla web-sovellusohjelmoinnin perusteet.');
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Johdatus Yliopistomatematiikkaan','AYMAT11001', 'Joukko-opin perusteetmerkintätapoineen sekä erityyppiset todistustekniikat. Matemaattinen ajattelu sekä suullinen ja kirjallinen viestintä.');
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Tietokantojen Perusteet','TKT10004', 'Kurssilla tutustutaan tietokantojen suunnitteluun');

INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('IoT','Internet of Things','Internet of Things, asioiden Internet.');
INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('Tietoliikenne', 'Telecommunication', 'Tiedon siirtoa lähettäjältä vastaanottajalle.');
INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('Tietokanta', 'Database', 'Tietokoneen muistissa oleva tietojen kooste. Koottuja tiedostokokoelmia määrättyä tarkoitusta varten.');
INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('Joukko-oppi','Set Theory', 'Joukkoja tutkiva matematiikan haara');
INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('Käyttöjärjestelmä','Operating system','Hallinnoi tietokoneen resursseja, luo laitteiston yksityiskohdista riippumattoman operointialusta ja järjestelmäkutsut.');

INSERT INTO Termi(nimi, englanniksi,kuvaus) VALUES ('Protokolla', 'Protocol', 'Protokolla on tietokoneiden välinen käyttäytymismalli, jota seuraamalla koneet pystyvät kommunikoimaan keskenään.');
INSERT INTO Termi(nimi, englanniksi,kuvaus) VALUES ('Eheys','Consistency','Tietojen keskinäinen yhteensopivuus ja oikeellisuus.');
INSERT INTO Termi(nimi, englanniksi,kuvaus) VALUES ('Tietokannanhallintajärjestelmä', 'Database Software', 'Ohjelmisto, joka mahdollistaa tietokannan perustamisen ja ylläpidon.');
INSERT INTO Termi(nimi, englanniksi,kuvaus) VALUES ('Muistihaku', 'Fetch', 'Prosessori hakee muistista käskyn');

INSERT INTO Opiskelija(kayttajatunnus, salasana) VALUES ('Matti', 'Matti123');

INSERT INTO Kurssiaihe(kurssi_id, aihe_id) VALUES('1','1');
INSERT INTO Kurssiaihe(kurssi_id, aihe_id) VALUES('2','1');
INSERT INTO Kurssiaihe(kurssi_id, aihe_id) VALUES('1','2');
INSERT INTO Termiaihe(termi_id, aihe_id) VALUES('1','2');
