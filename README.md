Examen WEBDEV-I augustus 2018
=============================

Vul **eerst** je gegevens in:

- Student: **«mijn-naam-en-voornaam»**
- Studentennummer: **«mijn-studentennummer»**

> **Tip**
>
> `«` en `»` laat je weg!

Docenten:

- Dieter De Weirdt (Databases)
- Olivier Parent (Development)

Toegelaten externe bronnen:

- <https://www.gdm.gent/1718-webdev1/>
- <https://php.net/manual/en/>
- <https://lumen.laravel.com/docs/5.6>
- <https://laravel.com/docs/5.6/database>
- <https://laravel.com/docs/5.6/queries>
- <https://dev.mysql.com/doc/refman/5.7/en/sql-syntax.html>

## 1 Setup en installatie

    PS> c
    PS> git clone …
    PS> c 1718-webdev1-2ek
    PS> cd lumen
    PS> composer create-project
    PS> composer update
    PS> artisan migrate:reset
    PS> artisan migrate --seed
    PS> php -S localhost:8080 -t public

<http://localhost:8080>

## 2 Mappen

```
- 1718-webdev1-2ek/
  - lumen/
    - app
      - Http/
        - Controllers/
          - BackOffice/
            - AdminsController.php
            - AuthController.php
            - DashBoardController.php
            - OutfitsController.php
            - PiecesController.php
    - resources/
      - views/
        - back-office/
          - admins/
          - auth/
          - pieces/
          - partials/
          - outfits/
  - README.md
```

## 3 Accounts

| Veld         | Gebruiker        | Beheerder        |
|--------------|------------------|------------------|
| **e-mail**   | `user@gdm.gent`  | `admin@gdm.gent` |
| **password** | `secret`         | `secret`         |

## 4 Vragen

> **Tips**
>
> - Gebruik bij voorkeur PhpStorm (zie de tabblad `6: TODO` linksonder het scherm).
> - Schrijf je antwoord tussen de aanduidingen `antwoord »` en `« antwoord`.
> - Gebruik in PHP enkel de *nieuwe* array syntaxis!
> - Gebruik in PHP *array destructuring* waar het kan.
> - Pas *enkel waar aangegeven* de code aan, want de overige code is al correct.
> - Gebruik de al aanwezige *constanten* voor tabelnamen en -sleutels.

---

### 4.1 Databases (DEEL 1)

> **Tips**
>
> Voor dit onderdeel heb je **ongeveer 1 uur** ter beschikking.  
> Je hebt tijd tot `15:45`. Dit wordt automatisch afgesloten dus **push regelmatig!**  
> Dit deel staat op **34 %** van de punten.

Ga naar <http://localhost:8080> en klik op het hangsloticoontje om naar de backoffice te gaan.

#### 4.1.1 Vraag 1

Open `./lumen/Http/Controllers/DashboardController.php`
en vul aan bij:

- `@todo VRAAG 1 - QUERY: outfit top 10.`

#### 4.1.2 Vraag 2

Open `./lumen/Http/Controllers/DashboardController.php`
en vul aan bij:

- `@todo VRAAG 2 - QUERY: overzicht 7 dagen terug in de tijd.`
 
#### 4.1.3 Vraag 3

Open `./lumen/Http/Controllers/DashboardController.php`
en vul aan bij:

- `@todo VRAAG 3 - Schakel authenticatie override terug uit.`

#### 4.1.4 Vraag 4

**Zie examenblad!**

---

### 4.2 Development (DEEL 2)

> **Tips**
>
> Voor dit onderdeel heb je **ongeveer 3 uur** ter beschikking.  
> Je hebt tijd tot `15:45`. Dit wordt automatisch afgesloten dus **push regelmatig!**  
> Dit deel staat op **66 %** van de punten.

Ga naar <http://localhost:8080> en klik op het hangsloticoontje om naar de backoffice te gaan.

#### 4.2.1 Vraag 5

Open `lumen/app/Http/Controllers/BackOffice/AuthController.php`
en vul aan bij:

- `@todo VRAAG 5.A - READ: valideer formulier.`
- `@todo VRAAG 5.B - READ: haal informatie uit het formulier.`
- `@todo VRAAG 5.C - READ: voer query uit om gegevens op te vragen.`
- `@todo VRAAG 5.D - Controleer wachtwoord.`

#### 4.2.2 Vraag 6

Open `lumen/app/Http/Controllers/BackOffice/AdminsController.php`
en vul aan bij:

- `@todo VRAAG 6 - READ: voer query uit om gegevens op te halen.`

#### 4.2.3 Vraag 7

Ga naar <http://localhost:8080/back-office/pieces>,
open `lumen/app/Http/Controllers/BackOffice/PiecesController.php`
en vul aan bij:

- `@todo VRAAG 7.A - READ: voer query uit om gegevens op te halen.`
- `@todo VRAAG 7.B - CREATE: valideer formulier.`
- `@todo VRAAG 7.C - CREATE: haal informatie uit het formulier.`
- `@todo VRAAG 7.D - CREATE: voer query uit om gegevens op te slaan.`
- `@todo VRAAG 7.E - READ: voer query uit om gegevens op te halen.`
- `@todo VRAAG 7.F - UPDATE: valideer formulier.`
- `@todo VRAAG 7.G - UPDATE: haal informatie uit het formulier.`
- `@todo VRAAG 7.H - UPDATE: voer query uit om gegevens bij te werken.`
- `@todo VRAAG 7.I - DELETE: verwijder gegevens.`

#### 4.2.4 Vraag 8

Ga naar <http://localhost:8080/back-office/outfits>,
open `lumen/app/Http/Controllers/BackOffice/OutfitsController.php`
en vul aan bij:

- `@todo VRAAG 8.A - READ: voer query uit om gegevens op te halen.`
- `@todo VRAAG 8.B - CREATE: valideer formulier.`
- `@todo VRAAG 8.C - CREATE: haal informatie uit het formulier.`
- `@todo VRAAG 8.D - CREATE: voer query uit om gegevens op te slaan.`
- `@todo VRAAG 8.E - CREATE: haal informatie uit het formulier.`
- `@todo VRAAG 8.F - CREATE: combineer informatie.`
- `@todo VRAAG 8.G - CREATE: voer query uit om gegevens op te slaan.`
- `@todo VRAAG 8.H - READ: voer query uit om gegeven op te halen.`
- `@todo VRAAG 8.I - READ: bewerk opgehaalde gegevens.`
- `@todo VRAAG 8.J - READ: voer query uit om gegeven op te halen.`
- `@todo VRAAG 8.K - DELETE: voer query uit om gegevens op te halen.`
- `@todo VRAAG 8.L - DELETE: voer query uit om gegevens te verwijderen.`