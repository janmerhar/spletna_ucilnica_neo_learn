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

1. Kloniraj repozitorij na lokacijo, kjer Apache strežnik streže datoteke
1. Uvozi podatkovno bazo [baza/learn.sql](baza/learn.sql)
1. V datoteki [php/dbconnect.php](php/dbconnect.php) spremeni podatke za prijavo v MySQL
1. Zaženi začetno stran [php/dbconnect.php](php/dbconnect.php)

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

![Iskalnik učilnic](READMESlike/SearchPage.png?raw=true "Iskalnik učilnic")

Takoj po prijavi uporabnika ga spletna aplikacija preusmeri na stran indeks.php. Ta stran prikaže uporabniku razpoložljive učilnice, njihove kategorije in vrsto učilnice ter gumb za dodajanje nove učilnice. Če je učilnica javna, uporabnik ne potrebuje gesla, sicer pa ga aplikacija vpraša zanj pred vstopom v zasebno učilnico.

![Geslo za vstop](READMESlike/PrivateClassroom.png?raw=true "Geslo za vstop")

### Dodajanje učilnice in vrste članstva

Ob kliku na gumb za dodajanje nove učilnice na strani indeks.php se uporabniku pojavi obrazec, v katerega vnese ime novonastale učilnice in geslo, če se odloči, da bo učilnica zasebna. Polje za geslo se pojavi, če je obkljukan parameter DA ob polju za zasebno učilnico.

![Dodaj učilnico](READMESlike/CreateClassroom.png?raw=true "Dodaj učilnico")

Ob dodajanju učilnice je uporabniku, ki je ustvaril učilnico dodeljen status skrbnika nad to učilnico. Za vsako učilnico obstaja le en skrbnik medtem, ko so vsi ostali le člani. Skrbniki učilnice imajo možnost dodajanja testov, pregleda testov in ocen, spreminjanja vidnosti testov, odstranjevanje uporabnikov iz učilnice ter dodajanje vsebine v učilnico. Člani učilnice lahko rešujejo teste, pregledajo svoje ocene in pregledujejo vsebino učilnice.

#### Pregled uporabnikov in izpis iz učilnice

Vsak član učilnice se lahko iz nje izpiše. Izjema pri izpisu je le skrbnik, saj on nima pravice do izpisa. Ima pa pravico do brisanja ostalih uporabnikov iz učilnice. To lahko stori preko strani s pregledom včlanjenih uporabnikov in jih tam tudi izbriše.

![Včlanjeni uporabniki](READMESlike/EnrolledUsers.png?raw=true "Včlanjeni uporabniki")

### Postavitev strani učilnice

Pogledi učilnic spletne učilnice Learn so razdeljene na tri različne navpične dele. Vsak izmed njih se različno obnaša in njihova funkcionalnost se spreminja glede na vrsto članstva uporabnika, ki si ogleduje učilnico.

![Prazna učilnico](READMESlike/EmptyClassroom.png?raw=true "Prazna učilnico")

#### Levi del učilnice

Levi del učilnice je viden vsem včlanjenim uporabnikom in prav tako dostopen vsem. Uporabniku omogoča reševanje in pregled testov in izpis iz učilnice. Iz učilnice se lahko izpišejo le člani.

![Prazna učilnico](READMESlike/ExamOverview.png?raw=true "Prazna učilnico")

#### Srednji del učilnice

Srednji del učilnice je prav tako viden vsem članom učilnice, vendar se njegova funkcionalnost spreminja glede na vrsto članstva. Člani učilnice imajo dostop do branja besedila, ogleda in prenašanja datotek, medtem ko imajo skrbniki učilnice še dovoljenje za dodajanja vsebine v učilnico preko vnosnega obrazca in brisanje že dodane vsebine.

![Skrbnikov pogled na učilnico](READMESlike/AdminView.png?raw=true "Skrbnikov pogled na učilnico")

#### Desni del učilnice

Za razliko od ostalih delov učilnice je ta na voljo le skrbnikom učilnice. Omogoča mu dodajanje novega testa, pregled ocen in vnesenih testov v učilnici, pregled včlanjenih ter izbris le-teh.

### Vsebina učilnice

Vsaka spletna učilnica ima domačo stran, na kateri je shranjena vsebina. Vsebino lahko briše in dodaja le skrbnik učilnice, tisti, ki jo je tudi ustvaril. Vsebina je prikazana po sklopih in vsak sklop vsebuje elemente različnih vrst. Elemente delimo na besedilne, slikovne in na dokumente. Vse pa naložimo preko istega obrazca, narejenega s pomočjo programskega jezika javascript, ki omogoča dinamično dodajanje vnosnih polj.

#### Dodajanje vsebine v učilnico

Pri dodajanju je uporabljen obrazec, v katerega vnašamo vsebino. Vsebuje polje, v katero vnesemo ime sklopa ter tri gumbe za dodajanje polj. S klikom na gumb se v obrazec doda novo vnosno polje. Vrste teh polj so odvisne od vsebine, ki se vnaša. Polje za besedilo bo uporabniku omogočilo vnos besedila medtem, ko bosta polji za vnos slik in dokumentov dovolili nalaganje slik in dokumentov. Če v polje za nalaganje slik ne vnesemo slike, se vnesena datoteka tudi ne bo naložila v učilnico. Naložene datoteke se hranijo na strežniku v mapi uploads.

![Učilnica z vsebino](READMESlike/UcilnicaZVsebino.png?raw=true "Učilnica z vsebino")

Izvedba nalaganja datotek je zapisana v insert_sklop.php. V tem delu programa se preveri, če so naložene kakšne binarne datoteke ter jih zatem naloži v mapo uploads. Hkrati pa naredi zapis v podatkovno bazo o lokaciji in imenu naložene datoteke z že prej pripravljeno poizvedbo MySQL. Funkcija dodajStevilo preimenuje datoteko na ta način, da ji pred končnico pripne zaporedno številko v primeru, da že obstaja datoteka na strežniku z istim imenom. Funkcija extractStevilo pa vrne tisti del niza, v katerem so številke. S to funkcijo iz imena polja asociativne tabele $\_FILES dobim podatke za vnos v podatkovno bazo.

#### Odstranjevanje vsebine iz podatkovne baze

Skrbnik lahko odstrani elemente ali cele sklope učilnice le s klikom na rdeče obarvan gumb. Če pritisne na gumb ob elementu, bo izbrisal samo tisti element. Ko pa pritisne na gumb ob imenu sklopa, pa izbriše celoten sklop skupaj z njegovimi elementi.

V datoteki ajax.php je zapisana koda, ki se uporablja za brisanje vsebine iz učilnice. V prvem stavku if preverjam, če je za izbris izbran samo en element sklopa ter nato pripravim poizvedbo MySQL in ga izbrišem. V primeru, da gre za brisanje celotnega sklopa pa najprej s pomočjo poizvedbe MySQL izbrišem vsak element sklopa posamično, šele nato pa preostanek sklopa. Pri brisanju datotek uporabljam funkcijo unlink, ki izbriše datoteko iz strežnika.

### Testi

Eden izmed glavnih delov spletne učilnice Learn so ravno testi in njihovo reševanje. Dostop do reševanja testov imajo vsi člani učilnice, vendar do dodajanja in spreminja pa le skrbnik učilnice. Vsak uporabnik lahko rešuje isti test samo enkrat. Vprašanja na testu so pravilna le v primeru, da so vsi izbrani odgovori pravilni, sicer se vprašanje točkuje z 0 točkami.

#### Dodajanje testov

Pravico do dodajanja testov ima le skrbnik učilnice. Ima možnost dodajanja neomejenega števila testov in spreminjanja njihovih vidnosti. Pri vnosu skrbnik določi ime testa, koliko časa bo trajal v minutah in število vprašanj. Nato začne z dodajanjem vprašanj in odgovorov ter z določanjem pravilnosti odgovorov.

![Ustvari test](READMESlike/CreateTest.png?raw=true "Ustvari test")

#### Reševanje testov

Če je skrbnik učilnice spremenil vidnost testov, da so na voljo za reševanje, jih lahko začnejo reševati vsi uporabniki, ki so v učilnici in še niso rešili teh testov. Pri reševanju uporabniki izbirajo pravilne odgovore na vprašanja. So časovno omejeni in lahko vidijo odštevanje časa, ki je na voljo za reševanje. Ko se ta čas izteče, se reševanje zaključi in so trenutni odgovori poslani v ocenjevanje.

![Reševanje testa](READMESlike/SolveTest.png?raw=true "Reševanje testa")

#### Pregled ocen

Pregled ocen je ločen na dva dela. Prvi je za vse člane učilnice, drugi pa le za skrbnike. Člani lahko pogledajo svoje ocene medtem, ko imajo skrbniki pogled na vse ocene včlanjenih uporabnikov.

![Skrbnikov pogled na ocene testov](READMESlike/AdminTestOverview.png?raw=true "Skrbnikov pogled na ocene testov")

![Uporabnikov pogled na ocene testov](READMESlike/UserTestOverview.png?raw=true "Uporabnikov pogled na ocene testov")

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
