# O projektu

To je projekt, ki je bil začet kot maturitetni izdelek iz računalništva (original na voljo na [GitLab](https://gitlab.com/janmerhar/learn-spletna_ucilnica "Learn - spletna učilnica")). Tukaj je nadaljevanje te maturitetne naloge davno po njeni oddaji. Izdelek je bil nadgrajen z Bootstrap 4, ki prinaša osvežen izgled ter podporo mobilnim naprava skupaj s bolšjo dinamičnostjo layouta.

## Opis

### Spletna učilnica Neo learn

Odločil sem se, da bom izdelal svojo spletno učilnico. Do te odločitve sem prišel, ko sem iskal težave, ki so v slovenskem šolskem sistemu. Težava, ki mi je najbolj padla v oči, je bilo pisanje testov in pridobivanje zamujene snovi. Pri pisanju testov si dijaki med seboj nismo enaki. Nekateri pišejo lepo in počasi, spet drugi pa hitro in nečitljivo. Ker je pisanje testa običajno časovno omejeno, sem želel dejavnik pisanja omiliti. Tako sem se odločil, da bo spletna učilnica Learn vsebovala tudi reševanje testov z izbiro odgovorov na vprašanje. S tem pa sem tudi izničil delo profesorjev pri popravljanju testov, saj zato poskrbi kar sama spletna aplikacija.

## Uporabljena orodja

### Uporabljene tehnologije

- HTML
- CSS
- Knjižnica Boostrap 4
- JavaScript
- Knjižnica jQuery
- PHP
- Knjižnica PHPMailer
- MySQL

### Predpogoji za namestitev

- Apache strežnik
- MySQL strežnik
- PHP tolmač

### Namestitev

1. Kloniraj repozitorij na lokacijo, kjer Apache streže datoteke
1. Uvozi podatkovno bazo `baza/learn.sql`
1. V datoteki `php/dbconnect.php ` spremeni podatke za prijavo v MySQL
1. Zaženi začetno stran `indeks.php`

## ER diagram

Diagram ER za spletno učilnico Neo Learn je sestavljen iz naslednjih entitet:

- uporabnik,
- vclanjen,
- ucilnica,
- kategorija,
- sklop,
- vsebina,
- test,
- resuje,
- vprasanja in
- odgovori.

![ER diagram](READMESlike/ERDiagram.png?raw=true "ER Diagram")

Tabela `uporabnik` hrani uporabnikovo uporabniško ime, ime, priimek, ključ za potrditev uporabniškega računa, e-poštni naslov ter geslo v šifrirani obliki. V tabeli `vclanjen` hranim zapise o članstvu uporabnikov v učilnicah. Vsak `uporabnik` je lahko ali skrbnik učilnice ali član. Tabela `ucilnica` vsebuje vrsto učilnice, ki je lahko zasebna ali javna, ključ, če je zasebna, ime učilnice in kategorijo. Tabela `kategorija` vsebuje imena kategorij. V to tabelo ni možno dodajati vpisov znotraj spletne učilnice. V tabeli `sklop` so ime sklopa v učilnici in učilnico, v kateri je. Tabela `vsebina` hrani vsebino, ki je v sklopu. Ta vsebina je lahko več vrst: besedilo, slika, ali katera koli druga binarna datoteka. Tabela `test` hrani ime testa, kolika časa traja v minutah, število vprašanj, ali je viden in učilnico, v kateri je. Tabela `resuje` hrani podatke o uporabnikovem dosežene rezultatu na testu in kdaj je začel z reševanjem. Tabela `vprasanja` hrani samo vprašanje in koliko točk je vredno. Tabela `odgovori` se nanaša na tabelo `vprasanja` in hrani odgovore na vprašanje ter njihovo pravilnost.

## Vodič po učilnici

### Registracija in prijava uporabnika

Uporabnik pred uporabo spletne učilnice Learn naredi uporabniški račun, preko katerega se nato prijavi in začne uporabljati učilnico.

#### Registracija

![Obrazec za registracijo](READMESlike/RegisterForm.png?raw=true "Obrazec za registracijo")

Za registracijo uporabnik vnese svoje podatke v obrazec. Ti podatki so uporabniško ime, uporabnikovo ime in priimek, e-poštni naslov in geslo. Pred potrditvijo registracije aplikacija preveri, ali sta polji za geslo in e-poštni naslov enaki svojima dvojnikoma. Če se podatki ne ujemajo, označi neustrezna polja z rdečo obrobo. To stori s pomočjo programskega jezika JavaScript.

![Obrazec za registracijo z napako](READMESlike/RegisterError.png?raw=true "Obrazec za registracijo z napako")

Če uporabnik z vnesenim uporabniškim imenom ne obstaja, spletna aplikacija naredi nov uporabniški račun in pošlje potrditveno e-sporočilo na vneseni e-poštni naslov.

![Potrditveni e-mail](READMESlike/PotrditveniEmail.png?raw=true "Potrditveni e-mail")

S klikom za potrditev uporabniškega računa sprožim spremembo lastnost vkey v tabeli uporabnik na vrednost NULL oz. prazno polje.

#### Prijava v učilnico

Za prijavo uporabnik vnese samo svoje uporabniško ime ter geslo. Zatem spletna aplikacija preveri, ali uporabnik že obstaja. V primeru, da obstaja, začne preverjanje gesla. Geslo je v podatkovni bazi zapisano v šifrirani obliki, zato uporabim funkcijo password_verify za preverjanje pravilnosti geslo. Če je geslo pravilno aplikacija še preveri, ali je uporabnik potrdil svoj račun in ga prijavi.

![Obrazec za prijavo](READMESlike/LoginForm.png?raw=true "Obrazec za prijavo")

Pred vsako prijavo vključim v program knjižnico htmfunkcije.php in nato preverim, ali je uporabnik že prijavljen. Če je prijavljen ga preusmerim na indeks.php. V primeru, da ni, uvozim knjižnico dbconnect.php in s poizvedbo MySQL poiščem podatke o uporabniku ter preverim, ali obstaja in če je njegovo geslo pravilno. Nato še preverim, ali je uporabnikov račun potrjen, in ga pozovem, da ga potrdi, če ga še ni.

### Iskalnik učilnic

### Dodajanje učilnice in vrste članstva

#### Pregled uporabnikov in izpis iz učilnice

### Postavitev strani učilnice

#### Levi del učilnice

#### Srednji del učilnice

#### Desni del učilnice

### Vsebina učilnice

#### Dodajanje vsebine v učilnico

#### Odstranjevanje vsebine iz podatkovne baze

### Testi

#### Dodajanje testov

#### Reševanje testov

#### Pregled ocen

## Podatki za uporabo

### Uporabniško ime in geslo

| Uporabniško ime | Geslo   |
| --------------- | ------- |
| franch          | 456     |
| marikova        | 789     |
| markok          | 654     |
| **merjan**      | **123** |
| mlakarivan      | 987     |
| novakj          | 321     |
| zupanivan       | 654     |

**Skrbnik vseh učilnic**

### Gesla učilnic

| Učilnica            | Geslo |
| ------------------- | ----- |
| Zaklenjena učilnica | 123   |

<!--

Še nedotaknjena poglavja:

-> To je pa bolj ali manj samo še tutorial za uporaba (vodičc)


-->
