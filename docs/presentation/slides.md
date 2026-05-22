# Slides — CandidatureTracker

Format cible : 10 slides · 10 minutes · soutenance jury blanc.

## Slide 1 — Couverture

Texte visible :

```text
CandidatureTracker
[Ton nom complet]
[Nom du formateur]
```

Note orale : aucune explication longue. Présenter le titre et passer.

## Slide 2 — Sommaire

Texte visible :

```text
Problématique
Solution
Conception
Architecture & Méthodologie
Démonstration
Conclusion
```

Note orale : annoncer simplement le plan, environ 15 secondes.

## Slide 3 — Problématique

Texte visible :

```text
Un jeune diplômé multiplie les candidatures sur plusieurs canaux.
Les notes simples deviennent vite difficiles à suivre.
Résultat : relances oubliées, entretiens confondus, informations perdues.
Il faut une vue claire, fiable et sécurisée de chaque opportunité.
```

Note orale : insister sur un problème concret d'organisation, pas sur une définition générale.

## Slide 4 — Solution

Texte visible :

```text
CandidatureTracker centralise le suivi personnel de recherche d'emploi.

En tant qu'utilisateur, je peux créer une candidature.
Je peux ajouter des entretiens et des documents.
Je peux archiver, restaurer et filtrer mes candidatures.
```

Visuel à intégrer : `assets/dashboard.png`

Note orale : présenter l'application comme fonctionnelle, puis annoncer que la démo montrera le parcours complet.

## Slide 5 — Conception : MCD

Titre exact :

```text
Modèle Conceptuel des Données — Méthode Merise
```

Contenu visible :

```text
Insérer ici l'export MCD depuis un outil dédié.
```

Visuel à intégrer : `assets/mcd.png`

Note orale :

```text
Le MCD montre les entités métier : utilisateur, candidature, entretien et document.
Un utilisateur possède plusieurs candidatures.
Une candidature peut avoir plusieurs entretiens et plusieurs documents.
```

## Slide 6 — Conception : MLD

Titre exact :

```text
Modèle Logique des Données — Méthode Merise
```

Contenu visible :

```text
Insérer ici l'export MLD depuis un outil dédié.
```

Visuel à intégrer : `assets/mld.png`

Note orale :

```text
Le MLD traduit le modèle en tables, colonnes, clés primaires et clés étrangères.
La colonne deleted_at est présente sur job_applications pour gérer l'archivage.
```

## Slide 7 — Architecture & Stack technique

Texte visible :

```text
Stack : Laravel 13 · PHP 8.3 · Breeze · Blade · MySQL · Debugbar
Architecture : MVC — Modèles, Vues, Controllers
Outils : GitHub par branches · Jira Kanban · lien tickets/commits
```

Note orale :

```text
Les Models portent les données et relations.
Les Views affichent l'interface Blade.
Les Controllers orchestrent les requêtes, avec validation et autorisation séparées.
```

## Slide 8 — Méthodologie Agile

Texte visible :

```text
Cadre utilisé : Kanban
User Stories transformées en tickets Jira
Développement par feature et commits liés aux tickets
Suivi visuel : To Do · In Progress · Done
```

Visuel à intégrer : `assets/jira-board.png`

Note orale : expliquer que Kanban correspond bien à un projet individuel avec flux de tâches continu.

## Slide 9 — Démonstration

Texte visible :

```text
Démonstration
```

Note orale : ne pas expliquer la slide. Ouvrir le navigateur et suivre le parcours préparé.

## Slide 10 — Conclusion

Texte visible :

```text
Difficultés : N+1, sécurité par utilisateur, archivage sans suppression.
Solutions : eager loading, Policies, Soft Deletes.
Apports : MVC, Form Requests, Merise, Kanban, tests Pest.
Suite : rappels de relance, calendrier, export CSV.
```

Note orale : conclure sur ce qui est livré, ce qui a été appris, puis les pistes d'amélioration.

