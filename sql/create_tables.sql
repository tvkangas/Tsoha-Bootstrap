CREATE TABLE Pelaaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Rata(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	sijainti varchar(50) NOT NULL,
        luokitus varchar(10)
);

CREATE TABLE Tulos(
	id SERIAL PRIMARY KEY,	
	rata_id INTEGER REFERENCES Rata(id),
	pelaaja_id INTEGER REFERENCES Pelaaja(id),
	paivamaara varchar,
	muistiinpanot varchar(200)
);

CREATE TABLE RadanIhannetulokset(
id SERIAL PRIMARY KEY,	
	rata_id INTEGER REFERENCES Rata(id),
	vayla1 INT DEFAULT 3,
	vayla2 INT DEFAULT 3,
	vayla3 INT DEFAULT 3,
	vayla4 INT DEFAULT 3,
	vayla5 INT DEFAULT 3,
	vayla6 INT DEFAULT 3,
	vayla7 INT DEFAULT 3,
	vayla8 INT DEFAULT 3,
	vayla9 INT DEFAULT 3,
	vayla10 INT DEFAULT 3,
	vayla11 INT DEFAULT 3,
	vayla12 INT DEFAULT 3,
	vayla13 INT DEFAULT 3,
	vayla14 INT DEFAULT 3,
	vayla15 INT DEFAULT 3,
	vayla16 INT DEFAULT 3,
	vayla17 INT DEFAULT 3,
	vayla18 INT DEFAULT 3
);

CREATE TABLE RadanPelaajat(
	rata_id INTEGER REFERENCES Rata(id),
	pelaaja_id INTEGER REFERENCES Pelaaja(id)
);


CREATE TABLE TuloksetVaylittain(
id SERIAL PRIMARY KEY,	
	tulos_id INTEGER REFERENCES Tulos(id),
	vayla1 INT DEFAULT 3,
	vayla2 INT DEFAULT 3,
	vayla3 INT DEFAULT 3,
	vayla4 INT DEFAULT 3,
	vayla5 INT DEFAULT 3,
	vayla6 INT DEFAULT 3,
	vayla7 INT DEFAULT 3,
	vayla8 INT DEFAULT 3,
	vayla9 INT DEFAULT 3,
	vayla10 INT DEFAULT 3,
	vayla11 INT DEFAULT 3,
	vayla12 INT DEFAULT 3,
	vayla13 INT DEFAULT 3,
	vayla14 INT DEFAULT 3,
	vayla15 INT DEFAULT 3,
	vayla16 INT DEFAULT 3,
	vayla17 INT DEFAULT 3,
	vayla18 INT DEFAULT 3
);
