USE learn;

/* Vnos podatkov v tabelo KATEGORIJA */
INSERT INTO kategorija VALUES('Programiranje');
INSERT INTO kategorija VALUES('Poslovanje');
INSERT INTO kategorija VALUES('Finance');
INSERT INTO kategorija VALUES('Pisarniška produktivnost');
INSERT INTO kategorija VALUES('Osebnostini razvoj');
INSERT INTO kategorija VALUES('Grafično oblikovanje');
INSERT INTO kategorija VALUES('Življenski slog');
INSERT INTO kategorija VALUES('Fotografija');
INSERT INTO kategorija VALUES('Zdravje in vadba');
INSERT INTO kategorija VALUES('Glasba');
INSERT INTO kategorija VALUES('Učenje');

/* Vnos uporabnikov v tabelo UPORABNIK */
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('merjan', '123', 'Jan', 'Merhar');
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('novakj', '321', 'Janez', 'Novak');
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('franch', '456', 'Franc', 'Horvat');
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('markok', '654', 'Marko', 'Kovačič');
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('zupanivan', '654', 'Ivan', 'Župančič');
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('marikova', '789', 'Marija', 'Kovač');
INSERT INTO uporabnik(upime, geslo, ime, priimek)
VALUES('mlakarivan', '987', 'Ivan', 'Mlakar');