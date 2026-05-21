# CandidatureTracker

CandidatureTracker est une application Laravel personnelle pour suivre une recherche d'emploi.

Elle permet a un utilisateur connecte de gerer ses candidatures, ses entretiens, ses archives, ses filtres et ses documents lies a une opportunite.

## Fonctionnalites

- inscription, connexion et deconnexion avec Laravel Breeze
- liste des candidatures actives
- creation, detail, modification et archivage d'une candidature
- page Archives avec restauration
- filtres par statut et priorite
- ajout, modification et suppression des entretiens
- upload, telechargement et suppression de documents
- securite par utilisateur avec Policies
- validation via Form Requests
- tests Pest sur les regles metier principales

## Stack

- Laravel 13
- Laravel Breeze
- Blade
- Tailwind CSS
- MySQL en local
- Pest pour les tests
- Storage disk public pour les fichiers

## Installation

```powershell
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run build
```

Pendant le developpement :

```powershell
php artisan serve
npm run dev
```

Application locale :

```text
http://127.0.0.1:8000
```

## Tests

```powershell
php artisan test
```

Resultat attendu :

```text
31 tests OK
```

## Comptes et securite

Chaque ressource metier appartient a un utilisateur :

- `JobApplication` appartient a `User`
- `Interview` appartient a `JobApplication`
- `ApplicationDocument` appartient a `JobApplication`

Les Policies empechent un utilisateur de consulter, modifier, archiver, restaurer ou supprimer les donnees d'un autre utilisateur.

## Documentation

Le dossier `docs/` contient les notes de soutenance :

- `docs/soutenance.md`
