# O projektu

To je projekt, ki je bil začet kot maturitetni izdelek iz računalništva (original na voljo na [GitLab](https://gitlab.com/janmerhar/learn-spletna_ucilnica "Learn - spletna učilnica")). Tukaj je nadaljevanje te maturitetne naloge davno po njeni oddaji. Izdelek je bil nadgrajen z Bootstrap 4, ki prinaša osvežen izgled ter podporo mobilnim naprava skupaj s bolšjo dinamičnostjo layouta.

## Spletna učilnica Neo learn

Odločil sem se, da bom izdelal svojo spletno učilnico. Do te odločitve sem prišel, ko sem iskal težave, ki so v slovenskem šolskem sistemu. Težava, ki mi je najbolj padla v oči, je bilo pisanje testov in pridobivanje zamujene snovi. Pri pisanju testov si dijaki med seboj nismo enaki. Nekateri pišejo lepo in počasi, spet drugi pa hitro in nečitljivo. Ker je pisanje testa običajno časovno omejeno, sem želel dejavnik pisanja omiliti. Tako sem se odločil, da bo spletna učilnica Learn vsebovala tudi reševanje testov z izbiro odgovorov na vprašanje. S tem pa sem tudi izničil delo profesorjev pri popravljanju testov, saj zato poskrbi kar sama spletna aplikacija.

## Uporabljena orodja

## Uporabljene tehnologije

- HTML
- CSS
- Knjižnica Boostrap 4
- JavaScript
- Knjižnica jQuery
- PHP
- Knjižnica PHPMailer
- MySQL

## Predpogoji za namestitev

- Apache strežnik
- MySQL strežnik
- PHP tolmač

## Namestitev

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

## Podatki za uporabo

### Uporabniško ime in geslo

| Uporabniško ime | Geslo   |
| --------------- | ------- |
| franch          | 456     |
| marikova        | 789     |
| markok          | 654     |
| **merjan**      | **123** |
| mlakarivan      | 987     |
| novakj          | -       |
| zupanivan       | 654     |

**Skrbnik vseh učilnic**

### Gesla učilnic

| Učilnica            | Geslo |
| ------------------- | ----- |
| Zaklenjena učilnica | 123   |

<!--

Še nedotaknjena poglavja:

-> To je pa bolj ali manj samo še tutorial za uporaba (vodičc)
5.	Registracija in prijava uporabnika	14
5.1	Registracija	14
5.2     Prijava v učilnico	16
6.	Iskalnik učilnic	19
7.	Dodajanje učilnice in vrste članstva	20
7.1	Pregled uporabnikov in izpis iz učilnice	21
8.	Postavitev strani učilnice	21
8.1     Levi del učilnice	22
8.2     Srednji del učilnice	23
8.3     Desni del učilnice	23
9.	Vsebina učilnice	24
9.1	Dodajanje vsebine v učilnico	24
9.2	Odstranjevanje vsebine iz podatkovne baze	26
9.     Testi	27
9.1     Dodajanje testov	27
9.2     Reševanje testov	28
9.3     Pregled ocen	29

-->
