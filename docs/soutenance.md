# Soutenance CandidatureTracker

## 1. Contexte

La recherche d'emploi demande de suivre beaucoup d'informations : entreprises, postes, statuts, relances, entretiens, documents et decisions finales.

Avec des notes simples, on perd vite le fil. CandidatureTracker centralise ces informations dans une application Laravel personnelle.

## 2. Problematique

Un jeune diplome peut postuler a plusieurs startups, agences et grandes entreprises en meme temps. Sans outil adapte, il risque :

- d'oublier une relance
- de confondre deux entretiens
- de perdre une URL d'offre
- de ne plus savoir quelles candidatures sont actives
- de melanger les documents envoyes

## 3. Objectif

L'objectif du projet est de construire une application web Laravel qui permet a un utilisateur de suivre ses candidatures de facon claire et securisee.

L'utilisateur peut :

- creer une candidature
- suivre son statut et sa priorite
- ajouter des entretiens
- archiver les candidatures terminees
- restaurer une candidature archivee
- joindre des documents
- filtrer sa liste active

## 4. User Stories Couvertes

| US | Fonctionnalite | Statut |
| --- | --- | --- |
| US1 | Inscription, connexion, deconnexion | Fait |
| US2 | Liste des candidatures actives | Fait |
| US3 | Creation d'une candidature | Fait |
| US4 | Detail d'une candidature | Fait |
| US5 | Modification d'une candidature | Fait |
| US6 | Archivage d'une candidature | Fait |
| US7 | Page Archives | Fait |
| US8 | Restauration d'une candidature | Fait |
| US9 | Filtres statut et priorite | Fait |
| US10 | Ajout d'un entretien | Fait |
| US11 | Modification et suppression d'un entretien | Fait |
| Bonus 1 | Documents avec Storage | Fait |
| Bonus 2 | Tests Pest | Fait |

## 5. MCD

```text
User
  id
  name
  email
  password

JobApplication
  id
  user_id
  company_name
  position_title
  offer_url
  status
  priority
  notes
  applied_at
  deleted_at

Interview
  id
  job_application_id
  type
  scheduled_at
  preparation_notes
  result

ApplicationDocument
  id
  job_application_id
  original_name
  file_path
  mime_type
  size
```

Relations :

```text
User 1,N JobApplication
JobApplication 1,N Interview
JobApplication 1,N ApplicationDocument
```

## 6. MLD

```text
users(
  id PK,
  name,
  email,
  password,
  created_at,
  updated_at
)

job_applications(
  id PK,
  user_id FK -> users.id,
  company_name,
  position_title,
  offer_url nullable,
  status,
  priority,
  notes nullable,
  applied_at,
  deleted_at nullable,
  created_at,
  updated_at
)

interviews(
  id PK,
  job_application_id FK -> job_applications.id,
  type,
  scheduled_at,
  preparation_notes nullable,
  result nullable,
  created_at,
  updated_at
)

application_documents(
  id PK,
  job_application_id FK -> job_applications.id,
  original_name,
  file_path,
  mime_type,
  size,
  created_at,
  updated_at
)
```

## 7. Choix Techniques

### Laravel Breeze

Breeze fournit une authentification simple et propre : inscription, connexion, deconnexion, profil et middleware `auth`.

### Form Requests

Les controllers ne contiennent pas de `$request->validate()`.

La validation est separee dans :

- `StoreJobApplicationRequest`
- `UpdateJobApplicationRequest`
- `FilterJobApplicationsRequest`
- `StoreInterviewRequest`
- `UpdateInterviewRequest`
- `StoreApplicationDocumentRequest`

### Policies

Les Policies protegent les donnees par proprietaire :

- `JobApplicationPolicy`
- `InterviewPolicy`
- `ApplicationDocumentPolicy`

Un utilisateur ne peut pas ouvrir, modifier ou supprimer une ressource appartenant a quelqu'un d'autre.

### Soft Deletes

L'archivage utilise `SoftDeletes` sur `JobApplication`.

Quand l'utilisateur archive une candidature, Laravel remplit `deleted_at`. La candidature sort de la liste active, mais reste disponible dans la page Archives.

### Eager Loading

La page detail charge les relations avec `load()` :

```php
$jobApplication->load([
    'documents' => fn ($query) => $query->latest(),
    'interviews' => fn ($query) => $query->latest('scheduled_at'),
]);
```

Ce choix evite le probleme N+1 sur les entretiens et documents.

### Storage

Les documents sont stockes avec :

```php
Storage::disk('public')
```

Le controller gere :

- upload
- telechargement
- suppression du fichier disque

## 8. Statuts Et Priorites

Valeurs stockees pour les statuts :

```text
draft, applied, waiting, interview, offer, rejected, accepted
```

Affichage francais :

```text
Brouillon, Candidature envoyee, En attente, Entretien prevu, Offre recue, Refusee, Acceptee
```

Valeurs stockees pour les priorites :

```text
low, medium, high
```

Affichage francais :

```text
Basse, Moyenne, Haute
```

## 9. Parcours De Demonstration

1. Ouvrir l'application.
2. Creer un compte.
3. Aller dans Candidatures.
4. Creer une candidature.
5. Voir la page detail.
6. Modifier la candidature.
7. Ajouter un entretien.
8. Modifier puis supprimer l'entretien.
9. Ajouter un document.
10. Telecharger le document.
11. Supprimer le document.
12. Filtrer les candidatures par statut ou priorite.
13. Archiver la candidature.
14. Ouvrir Archives.
15. Restaurer la candidature.
16. Lancer `php artisan test`.

## 10. Tests

Les tests Pest couvrent :

- acces non autorise bloque par Policy
- creation avec donnees valides
- creation avec donnees invalides
- archivage d'une candidature
- restauration d'une candidature
- impossibilite d'acceder aux candidatures d'un autre utilisateur

Commande :

```powershell
php artisan test
```

## 11. Questions Possibles

### Pourquoi utiliser les Policies ?

Les Policies placent la securite cote serveur. Une verification dans Blade cacherait seulement un bouton. Un utilisateur pourrait encore appeler une route a la main.

### Pourquoi utiliser Form Requests ?

Les Form Requests gardent les controllers lisibles. Chaque classe porte une responsabilite claire : valider une creation, une modification ou un filtre.

### Pourquoi Soft Deletes ?

Une candidature terminee garde une valeur historique. Soft Deletes permet de la retirer de la liste active sans perdre ses informations.

### Pourquoi stocker les statuts en anglais ?

Les valeurs stockees restent stables pour le code. Le modele fournit les libelles francais pour l'interface.

### Comment l'application evite le N+1 ?

La page detail charge les relations `interviews` et `documents` en une fois avec eager loading.

## 12. Limites Et Ameliorations

Pistes possibles :

- ajouter des rappels de relance
- ajouter une recherche par entreprise
- exporter les candidatures en CSV
- ajouter un calendrier des entretiens
- ajouter un tableau de statistiques
- ajouter des tests pour les documents et les entretiens

