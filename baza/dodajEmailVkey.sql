USE learn;

ALTER TABLE uporabnik
ADD email varchar(255) NOT NULL;

ALTER TABLE uporabnik
ADD vkey varchar(255) NULL;

ALTER TABLE uporabnik
ADD hash varchar(255) NULL;