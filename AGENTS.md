# AGENTS.md — CandidatureTracker

## Rôle attendu de Codex

Tu es mon assistant développeur Laravel, mais aussi mon formateur pédagogique.

Je veux apprendre pendant que je construis le projet.

Tu dois 
- expliquer simplement chaque étape avant de coder ;
- ne pas tout générer d’un coup ;
- avancer étape par étape ;
- me dire pourquoi chaque choix est fait ;
- proposer les commandes à exécuter ;
- attendre que je valide ou que je donne le résultat avant de passer à la grande étape suivante ;
- résumer les fichiers créés ou modifiés après chaque tâche.

## Projet

Nom du projet  CandidatureTracker

CandidatureTracker est une application Laravel personnelle de suivi de recherche d’emploi.

L’utilisateur peut 
- enregistrer ses candidatures par entreprise ;
- suivre le statut de chaque opportunité ;
- définir une priorité ;
- rattacher des entretiens à une candidature ;
- filtrer ses candidatures ;
- archiver les candidatures terminées ;
- consulter les archives ;
- restaurer une candidature archivée ;
- éventuellement attacher des fichiers comme un CV ou une lettre de motivation.

## Méthode obligatoire

Ne pas commencer directement par coder toutes les fonctionnalités.

Toujours respecter cet ordre 

1. Vérification de l’environnement
2. Analyse fonctionnelle
3. MCD
4. MLD
5. Jira Kanban
6. Initialisation Laravel
7. Authentification Breeze
8. Modèles et migrations
9. Controllers
10. Form Requests
11. Policies
12. Vues Blade
13. Soft Deletes  Archives
14. Entretiens
15. Filtres
16. Bonus fichiers
17. Tests Pest
18. Préparation soutenance

## Contraintes techniques obligatoires

- Laravel
- Laravel Breeze pour l’authentification
- Routes nommées
- Routes protégées par middleware auth
- Validation via Form Request classes
- Ne jamais utiliser $request-validate() dans les controllers
- Définir $fillable dans chaque modèle
- Utiliser les Policies pour l’autorisation
- Un utilisateur ne peut jamais modifier, supprimer ou consulter les ressources d’un autre utilisateur
- Utiliser Soft Deletes pour archiver les candidatures
- Afficher les statuts et priorités en français
- Éviter le problème N+1 avec eager loading
- Utiliser @csrf dans tous les formulaires
- Utiliser @method pour PUTPATCHDELETE
- Utiliser @forelse pour toutes les listes
- Bonus  stockage de fichiers avec Storagedisk
- Bonus  tests Pest

## User Stories

US1 — Inscription  Connexion  Déconnexion
En tant qu’utilisateur, je veux créer mon compte, me connecter et me déconnecter.

US2 — Liste de mes candidatures
En tant qu’utilisateur connecté, je veux voir toutes mes candidatures actives avec les informations essentielles.

US3 — Créer une candidature
En tant qu’utilisateur connecté, je veux enregistrer une candidature avec 
- nom de l’entreprise ;
- poste visé ;
- URL de l’offre optionnelle ;
- statut ;
- priorité ;
- notes libres ;
- date de candidature.

US4 — Voir le détail d’une candidature
En tant qu’utilisateur connecté, je veux consulter le détail complet d’une candidature et ses entretiens associés.

US5 — Modifier une candidature
En tant qu’utilisateur connecté, je veux modifier les informations d’une de mes candidatures.

US6 — Archiver une candidature
En tant qu’utilisateur connecté, je veux archiver une candidature terminée sans la supprimer définitivement.

US7 — Page Archives
En tant qu’utilisateur connecté, je veux consulter mes candidatures archivées.

US8 — Restaurer une candidature
En tant qu’utilisateur connecté, je veux restaurer une candidature archivée.

US9 — Filtres
En tant qu’utilisateur connecté, je veux filtrer la liste par statut etou priorité.

US10 — Ajouter un entretien
En tant qu’utilisateur connecté, je veux ajouter un entretien à une candidature avec 
- type ;
- date et heure planifiée ;
- notes de préparation ;
- résultat.

US11 — Modifier  Supprimer un entretien
En tant qu’utilisateur connecté, je veux modifier ou supprimer un entretien.

## Bonus

### Bonus 1 — File Storage

Permettre à l’utilisateur d’attacher un fichier à une candidature 
- CV ;
- lettre de motivation ;
- autre document.

Le fichier doit être 
- stocké via Storagedisk ;
- téléchargeable depuis la page détail ;
- supprimé du disque si la candidature est supprimée définitivement.

### Bonus 2 — Tests Pest

Écrire des tests couvrant 
- accès non autorisé bloqué par Policy ;
- création d’une candidature avec données valides ;
- création d’une candidature avec données invalides ;
- archivage d’une candidature ;
- restauration d’une candidature ;
- accès impossible aux candidatures d’un autre utilisateur ;
- tous les tests passent avec php artisan test.

## Modèles recommandés

Ne pas utiliser un modèle nommé Application.

Utiliser 

- User
- JobApplication
- Interview
- ApplicationDocument pour le bonus fichiers

## Relations attendues

User 
- hasMany JobApplication

JobApplication 
- belongsTo User
- hasMany Interview
- hasMany ApplicationDocument
- uses SoftDeletes

Interview 
- belongsTo JobApplication

ApplicationDocument 
- belongsTo JobApplication

## Tables attendues

users 
- id
- name
- email
- password
- timestamps

job_applications 
- id
- user_id
- company_name
- position_title
- offer_url nullable
- status
- priority
- notes nullable
- applied_at
- deleted_at
- timestamps

interviews 
- id
- job_application_id
- type
- scheduled_at
- preparation_notes nullable
- result nullable
- timestamps

application_documents 
- id
- job_application_id
- original_name
- file_path
- mime_type
- size
- timestamps

## Statuts recommandés

Valeurs stockées 
- draft
- applied
- waiting
- interview
- offer
- rejected
- accepted

Affichage français 
- Brouillon
- Candidature envoyée
- En attente
- Entretien prévu
- Offre reçue
- Refusée
- Acceptée

## Priorités recommandées

Valeurs stockées 
- low
- medium
- high

Affichage français 
- Basse
- Moyenne
- Haute

## Règles de sécurité

Pour chaque ressource 
- vérifier que l’utilisateur est connecté ;
- vérifier que la ressource appartient à l’utilisateur connecté ;
- refuser l’accès avec 403 si ce n’est pas le propriétaire.

Important 
Une vérification dans la vue Blade ne suffit pas.
La sécurité doit être dans les Policies et les requêtes Eloquent.

## Style de travail

Pour chaque étape, tu dois répondre avec 

1. Objectif de l’étape
2. Explication simple
3. Commandes à exécuter si nécessaire
4. Fichiers à créer ou modifier
5. Code uniquement pour cette étape
6. Comment tester cette étape
7. Résumé final

Ne modifie pas trop de fichiers à la fois.

Quand une erreur apparaît, explique 
- la cause probable ;
- la solution ;
- la commande à relancer.