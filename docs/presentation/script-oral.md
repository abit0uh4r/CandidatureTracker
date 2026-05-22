# Script oral — 10 minutes

Ce script est volontairement court. Il sert à parler naturellement sans lire les slides.

## Slide 1 — Couverture, 15 secondes

Bonjour, je vais vous présenter CandidatureTracker, mon application Laravel de suivi de recherche d'emploi.

## Slide 2 — Sommaire, 15 secondes

Je vais d'abord présenter la problématique, puis la solution, la conception, l'architecture, ma méthode de travail, une démonstration, et enfin la conclusion.

## Slide 3 — Problématique, 1 minute

La recherche d'emploi demande de gérer beaucoup d'informations en parallèle : entreprises, postes, statuts, relances, entretiens et documents.
Pour un jeune diplômé, ce suivi est souvent fait avec des notes ou mentalement.
Cette méthode montre vite ses limites : on peut oublier une relance, confondre deux entretiens ou perdre l'URL d'une offre.
Le besoin est donc d'avoir un outil simple, centralisé et sécurisé.

## Slide 4 — Solution, 1 minute

CandidatureTracker répond à ce besoin en regroupant les candidatures dans une application web.
L'utilisateur peut créer une candidature, choisir son statut et sa priorité, ajouter des entretiens et joindre des documents.
Il peut aussi archiver une candidature terminée sans perdre l'historique, puis la restaurer si besoin.
La capture montre l'interface principale, et je reviendrai sur ces actions pendant la démonstration.

## Slide 5 — MCD, 1 minute

Au niveau conceptuel, le projet repose sur quatre entités principales.
Un utilisateur possède plusieurs candidatures.
Une candidature peut avoir plusieurs entretiens et plusieurs documents.
Le MCD reste volontairement métier : il montre les entités, les attributs importants et les cardinalités, sans types techniques.

## Slide 6 — MLD, 1 minute

Le MLD traduit ce modèle en tables.
On retrouve les clés primaires, les clés étrangères et les types de colonnes.
La table job_applications contient deleted_at, qui permet l'archivage avec Soft Deletes.
Les relations assurent que les entretiens et documents restent attachés à une candidature.

## Slide 7 — Architecture & Stack, 1 minute

L'application est développée avec Laravel 13, PHP 8.3, Breeze pour l'authentification, Blade pour les vues et MySQL pour la base de données.
L'architecture suit le pattern MVC.
Les Models gèrent les données et relations, les Views affichent l'interface, et les Controllers orchestrent les actions.
J'ai aussi utilisé GitHub avec une branche par feature et Jira pour organiser les tâches.

## Slide 8 — Méthodologie, 1 minute

J'ai travaillé avec une logique Kanban.
Les User Stories ont été transformées en tickets Jira, puis développées feature par feature.
Chaque évolution a été versionnée dans GitHub avec des commits dédiés.
Cette organisation m'a permis d'avancer progressivement tout en gardant une vision claire de l'état du projet.

## Slide 9 — Démonstration, 3 minutes

Je passe maintenant à la démonstration.
Je vais me connecter, créer une candidature, ajouter un entretien, archiver la candidature, puis la restaurer.
J'ouvrirai aussi Debugbar pour montrer que l'application fonctionne avec une structure Laravel claire.

## Slide 10 — Conclusion, 1 minute

Les principales difficultés ont été la sécurité par utilisateur, l'archivage sans suppression définitive et le risque de N+1 sur les pages avec relations.
J'ai répondu à ces points avec les Policies, Soft Deletes et l'eager loading.
Ce projet m'a permis d'approfondir Laravel, les Form Requests, les Policies, la méthode Merise, l'organisation Kanban et les tests Pest.
Pour la suite, j'ajouterais des rappels de relance, un calendrier et un export CSV.

