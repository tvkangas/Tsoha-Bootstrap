--Lisätään pari pelaajaa
--INSERT INTO Pelaaja (nimi, password, admin) VALUES ('Tuukka', 'ss', TRUE);
--INSERT INTO Pelaaja (nimi, password) VALUES ('Pasi', 'ss');
--INSERT INTO Pelaaja (nimi, password) VALUES ('Masi', 'ss');
--INSERT INTO Pelaaja (nimi, password) VALUES ('Lasi', 'ss');
--INSERT INTO Pelaaja (nimi, password) VALUES ('Kasi', 'ss');

--Lisätään muutama rata
--INSERT INTO Rata (nimi, sijainti, luokitus) VALUES ('Siltamaki', 'Helsinki', 'A2');
--INSERT INTO Rata (nimi, sijainti, luokitus) VALUES ('Munkkiniemi', 'Helsinki', 'C2');
--INSERT INTO Rata (nimi, sijainti, luokitus) VALUES ('Valko', 'Loviisa', 'A1');

--Lisätään radan väylille ihannetulokset 
--Siltamäki
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,1);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,2);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,3);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,4);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,5);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,6);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,7);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,8);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,9);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,10);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,11);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,12);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,13);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,14);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,15);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,16);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,3,17);
INSERT INTO Vayla (rataId, par, numero) VALUES (1,2,18);

--Munkka
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,1);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,2);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,3);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,4);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,5);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,6);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,7);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,8);
INSERT INTO Vayla (rataId, par, numero) VALUES (2,3,9);

--Valko
INSERT INTO Vayla (rataId, par, numero) VALUES (3,4,1);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,2);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,3);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,4);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,5);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,4,6);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,7);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,8);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,9);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,10);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,11);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,4,12);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,13);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,14);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,15);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,16);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,4,17);
INSERT INTO Vayla (rataId, par, numero) VALUES (3,3,18);

--Lisätään pari tulosta
INSERT INTO Tulos (rataId, pelaajaId, paivamaara, muistiinpanot) VALUES (1, 1, NOW(), 'Hyvin meni');
INSERT INTO Tulos (rataId, pelaajaId, paivamaara, muistiinpanot) VALUES (1, 2, NOW(), 'Kivasti meni');
INSERT INTO Tulos (rataId, pelaajaId, paivamaara, muistiinpanot) VALUES (1, 1, NOW(), 'Hyvin meni taas');
INSERT INTO Tulos (rataId, pelaajaId, paivamaara, muistiinpanot) VALUES (2, 3, NOW(), 'Jepajee');
INSERT INTO Tulos (rataId, pelaajaId, paivamaara, muistiinpanot) VALUES (3, 1, NOW(), 'Jeejee');

--Lisätään väylätulokset
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 1, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 2, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 3, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 4, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 5, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 6, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 7, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 8, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 9, 5);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 10, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 11, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 12, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 13, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 14, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 15, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 16, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 17, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (1, 18, 2);

INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 1, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 2, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 3, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 4, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 5, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 6, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 7, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 8, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 9, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 10, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 11, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 12, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 13, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 14, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 15, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 16, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 17, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (2, 18, 2);

INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 1, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 2, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 3, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 4, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 5, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 6, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 7, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 8, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 9, 5);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 10, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 11, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 12, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 13, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 14, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 15, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 16, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 17, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (3, 18, 2);

INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 1, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 2, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 3, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 4, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 5, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 6, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 7, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 8, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (4, 9, 2);

INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 1, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 2, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 3, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 4, 4);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 5, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 6, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 7, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 8, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 9, 5);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 10, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 11, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 12, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 13, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 14, 2);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 15, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 16, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 17, 3);
INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (5, 18, 2);
