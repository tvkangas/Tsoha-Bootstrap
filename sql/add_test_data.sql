--Lisätään pari pelaajaa
INSERT INTO Pelaaja (nimi, password) VALUES ('Tuukka', 'ss');
INSERT INTO Pelaaja (nimi, password) VALUES ('Pasi', 'ss');

--Lisätään muutama rata
INSERT INTO Rata (nimi, sijainti, luokitus) VALUES ('Siltamaki', 'Helsinki', 'A2');
INSERT INTO Rata (nimi, sijainti, luokitus) VALUES ('Munkkiniemi', 'Helsinki', 'C2');
INSERT INTO Rata (nimi, sijainti, luokitus) VALUES ('Valko', 'Loviisa', 'A1');

--Lisätään radoille ihannetulokset
INSERT INTO RadanIhannetulokset (rata_id, vayla1, vayla2, vayla3, vayla4, vayla5, vayla6, vayla7, vayla8, vayla9, vayla10, vayla11, vayla12, vayla13, vayla14, vayla15, vayla16, vayla17, vayla18) VALUES ( (SELECT id FROM Rata WHERE nimi='Siltamaki'), 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 2);
INSERT INTO RadanIhannetulokset (rata_id, vayla1, vayla2, vayla3, vayla4, vayla5, vayla6, vayla7, vayla8, vayla9, vayla10, vayla11, vayla12, vayla13, vayla14, vayla15, vayla16, vayla17, vayla18) VALUES ( (SELECT id FROM Rata WHERE nimi='Munkkiniemi'), 3, 3, 3, 3, 3, 3, 3, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO RadanIhannetulokset (rata_id, vayla1, vayla2, vayla3, vayla4, vayla5, vayla6, vayla7, vayla8, vayla9, vayla10, vayla11, vayla12, vayla13, vayla14, vayla15, vayla16, vayla17, vayla18) VALUES ( (SELECT id FROM Rata WHERE nimi='Valko'), 4, 3, 3, 3, 3, 4, 3, 3, 3, 3, 3, 4, 3, 3, 3, 3, 4, 3);

--Lisätään parit tulokset
INSERT INTO TuloksetVaylittain (rata_id, vayla1, vayla2, vayla3, vayla4, vayla5, vayla6, vayla7, vayla8, vayla9, vayla10, vayla11, vayla12, vayla13, vayla14, vayla15, vayla16, vayla17, vayla18) VALUES ( (SELECT id FROM Rata WHERE nimi='Siltamaki'), 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 2);
INSERT INTO RadanIhannetulokset (rata_id, vayla1, vayla2, vayla3, vayla4, vayla5, vayla6, vayla7, vayla8, vayla9, vayla10, vayla11, vayla12, vayla13, vayla14, vayla15, vayla16, vayla17, vayla18) VALUES ( (SELECT id FROM Rata WHERE nimi='Siltamaki'), 2, 3, 3, 5, 3, 3, 3, 3, 3, 3, 1, 3, 4, 3, 3, 3, 3, 2);
