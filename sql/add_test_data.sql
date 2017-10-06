-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Laskennan Mallit', 'TKT20005','Kurssi syventää opiskelijan tietoja laskettavuudesta.');
INSERT INTO Kurssi(nimi, kurssitunnus, kuvaus) VALUES('Tietoliikenteen Perusteet', 'TKT20004', 'Kurssin jälkeen opiskelija tietää tietoliikenteen ja Internetin toiminnan perusteet.');
INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('IoT','Internet of Things','Internet of Things, asioiden Internet.');
INSERT INTO Aihe(nimi, englanniksi, kuvaus) VALUES ('Tietoliikenne', 'Telecommunication', 'Tiedon siirtoa lähettäjältä vastaanottajalle.');
INSERT INTO Opiskelija(kayttajatunnus, salasana) VALUES ('Matti', 'Matti123');
INSERT INTO Termi(nimi, englanniksi,kuvaus) VALUES ('Protokolla', 'Protocol', 'Protokolla on tietokoneiden välinen käyttäytymismalli, jota seuraamalla koneet pystyvät kommunikoimaan keskenään.');
INSERT INTO Kurssiaihe(kurssi_id, aihe_id) VALUES('1','1');
INSERT INTO Kurssiaihe(kurssi_id, aihe_id) VALUES('2','1');
INSERT INTO Kurssiaihe(kurssi_id, aihe_id) VALUES('1','2');
INSERT INTO Termiaihe(termi_id, aihe_id) VALUES('1','2');
