CREATE TABLE Pelaaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	password varchar(50) NOT NULL,
        admin boolean DEFAULT FALSE
);

CREATE TABLE Rata(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	sijainti varchar(50) NOT NULL,
        luokitus varchar(5)
);

CREATE TABLE Tulos(
	id SERIAL PRIMARY KEY,	
	rataId INTEGER REFERENCES Rata(id) ON DELETE CASCADE,
	pelaajaId INTEGER REFERENCES Pelaaja(id) ON DELETE CASCADE,
	paivamaara TIMESTAMP DEFAULT now(),
	muistiinpanot varchar(300)
);

CREATE TABLE RadanPelaajat(
	rataId INTEGER REFERENCES Rata(id) ON DELETE CASCADE,
	pelaajaId INTEGER REFERENCES Pelaaja(id) ON DELETE CASCADE
);

CREATE TABLE Vayla(
    id SERIAL PRIMARY KEY,
    rataId INTEGER REFERENCES Rata(id) ON DELETE CASCADE,
    par INTEGER NOT NULL DEFAULT 3,
    numero INTEGER NOT NULL,
    UNIQUE(rataId, numero)
);
CREATE TABLE VaylaTulos(
    tulosId INTEGER REFERENCES Tulos(id) ON DELETE CASCADE,
    vaylaId INTEGER REFERENCES Vayla(id) ON DELETE CASCADE,
    heitot INTEGER NOT NULL
);
