# Prompts GPT Images — Présentation CandidatureTracker

Objectif : générer les visuels de la présentation slide par slide avec GPT Images.

Important : ne mentionner nulle part l'IA, ChatGPT, GPT Images, OpenAI ou un assistant.

## Méthode conseillée

Travaille slide par slide, pas toute la présentation d'un coup.

Pourquoi :

- tu contrôles mieux la cohérence ;
- tu peux corriger une seule slide sans refaire les autres ;
- les slides MCD et MLD demandent des consignes différentes ;
- les captures dashboard et Jira seront remplacées par de vraies captures.

Format à demander à chaque fois :

```text
Image 16:9, qualité présentation professionnelle, lisible sur vidéoprojecteur, style SaaS moderne, fond blanc ou gris très clair, accents navy blue, design sobre, cartes blanches, bordures subtiles, ombres légères, deux couleurs maximum en dehors du neutre, aucun logo inventé, aucune mention d'IA.
```

## Slide 1 — Couverture

Prompt à copier :

```text
Créer une slide de couverture 16:9 pour une soutenance de projet web.

Projet : CandidatureTracker.

Style :
- SaaS moderne ;
- fond navy profond ;
- composition centrée ;
- grande carte subtile ou zone centrale élégante ;
- accents blanc et bleu clair ;
- rendu professionnel et sobre.

Texte à afficher, bien lisible :
CandidatureTracker
[Ton nom complet]
[Nom du formateur]

Contraintes :
- ne pas ajouter de paragraphe ;
- ne pas ajouter de logo inventé ;
- ne pas mentionner l'IA ;
- texte parfaitement lisible ;
- aucune décoration qui gêne la lecture.
```

## Slide 2 — Sommaire

Prompt à copier :

```text
Créer une slide de sommaire 16:9 pour une soutenance de projet web.

Style :
- fond blanc ou gris très clair ;
- six éléments propres, alignés, dans des cartes ou blocs sobres ;
- accents navy blue ;
- rendu professionnel.

Titre :
Sommaire

Contenu visible :
Problématique
Solution
Conception
Architecture & Méthodologie
Démonstration
Conclusion

Contraintes :
- maximum 6 éléments ;
- texte très lisible ;
- pas de paragraphe ;
- ne pas mentionner l'IA.
```

## Slide 3 — Problématique

Prompt à copier :

```text
Créer une slide 16:9 intitulée Problématique.

Contexte :
Un jeune diplômé postule à plusieurs entreprises et doit suivre beaucoup d'informations : entreprises, postes, statuts, entretiens, documents et relances.

Texte visible, maximum 4 lignes :
Un jeune diplômé multiplie les candidatures sur plusieurs canaux.
Les notes simples deviennent vite difficiles à suivre.
Résultat : relances oubliées, entretiens confondus, informations perdues.
Il faut une vue claire, fiable et sécurisée de chaque opportunité.

Visuel :
À droite, une illustration professionnelle représentant un suivi dispersé : notes, emails, plateformes, documents.

Style :
fond clair, accents navy, composition moderne, lisible, pas de surcharge.

Contraintes :
- texte très lisible ;
- ne pas mentionner l'IA ;
- ne pas ajouter d'autres idées.
```

## Slide 4 — Solution

Prompt à copier :

```text
Créer une slide 16:9 intitulée Solution.

Texte visible :
CandidatureTracker centralise le suivi personnel de recherche d'emploi.

En tant qu'utilisateur, je peux créer une candidature.
Je peux ajouter des entretiens et des documents.
Je peux archiver, restaurer et filtrer mes candidatures.

Visuel :
À droite, prévoir un grand cadre propre avec le texte :
[Capture dashboard à insérer]

Style :
SaaS dashboard moderne, fond gris très clair, cartes blanches, accents navy blue.

Contraintes :
- ne pas créer une fausse capture de l'application ;
- garder le cadre vide pour remplacer par une vraie capture ;
- texte lisible ;
- ne pas mentionner l'IA.
```

## Slide 5 — MCD complet

Prompt à copier si tu veux laisser GPT Images faire le schéma MCD :

```text
Créer une slide 16:9 professionnelle avec un MCD Merise complet pour CandidatureTracker.

Titre exact :
Modèle Conceptuel des Données — Méthode Merise

Règles MCD :
- niveau conceptuel uniquement ;
- ne pas afficher les types de données ;
- ne pas afficher les clés étrangères ;
- ne pas afficher id, created_at, updated_at, deleted_at ;
- afficher seulement les entités, attributs métier, associations et cardinalités ;
- ne pas mélanger MCD et MLD.

Entités et attributs :

Utilisateur :
- nom
- email
- mot de passe

Candidature :
- entreprise
- poste visé
- URL de l'offre
- statut
- priorité
- notes
- date de candidature

Entretien :
- type
- date et heure planifiée
- notes de préparation
- résultat

Document :
- nom original
- chemin du fichier
- type MIME
- taille

Associations et cardinalités :
- Utilisateur (1,1) — possède — Candidature (0,N)
- Candidature (1,1) — planifie — Entretien (0,N)
- Candidature (1,1) — contient — Document (0,N)

Design :
- fond blanc ;
- boîtes sobres ;
- relations très lisibles ;
- cardinalités visibles près des relations ;
- couleur principale navy blue ;
- texte net et lisible ;
- format compatible avec une slide de soutenance.

Contraintes :
- ne pas ajouter d'entités ;
- ne pas ajouter de colonnes techniques ;
- ne pas mentionner l'IA.
```

## Slide 6 — MLD complet

Prompt à copier si tu veux laisser GPT Images faire le schéma MLD :

```text
Créer une slide 16:9 professionnelle avec un MLD complet pour CandidatureTracker.

Titre exact :
Modèle Logique des Données — Méthode Merise

Règles MLD :
- afficher les tables ;
- afficher les colonnes ;
- afficher les types ;
- afficher les clés primaires PK ;
- afficher les clés étrangères FK ;
- afficher les relations entre les tables ;
- la colonne deleted_at doit être visible dans job_applications ;
- ne pas mélanger avec le MCD.

Tables :

users :
- id BIGINT PK
- name VARCHAR(255)
- email VARCHAR(255) UNIQUE
- password VARCHAR(255)
- created_at TIMESTAMP
- updated_at TIMESTAMP

job_applications :
- id BIGINT PK
- user_id BIGINT FK -> users.id
- company_name VARCHAR(255)
- position_title VARCHAR(255)
- offer_url VARCHAR(255) NULL
- status VARCHAR(50)
- priority VARCHAR(50)
- notes TEXT NULL
- applied_at DATE
- deleted_at TIMESTAMP NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP

interviews :
- id BIGINT PK
- job_application_id BIGINT FK -> job_applications.id
- type VARCHAR(255)
- scheduled_at DATETIME
- preparation_notes TEXT NULL
- result TEXT NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP

application_documents :
- id BIGINT PK
- job_application_id BIGINT FK -> job_applications.id
- original_name VARCHAR(255)
- file_path VARCHAR(255)
- mime_type VARCHAR(255)
- size BIGINT
- created_at TIMESTAMP
- updated_at TIMESTAMP

Relations :
- job_applications.user_id -> users.id
- interviews.job_application_id -> job_applications.id
- application_documents.job_application_id -> job_applications.id

Design :
- fond blanc ;
- quatre tables bien espacées ;
- flèches de relation lisibles ;
- texte net ;
- couleur principale navy blue ;
- rendu propre pour une soutenance.

Contraintes :
- ne pas ajouter de tables ;
- ne pas oublier deleted_at ;
- ne pas mentionner l'IA.
```

## Slide 7 — Architecture & Stack technique

Prompt à copier :

```text
Créer une slide 16:9 intitulée Architecture & Stack technique.

Créer trois blocs visuels propres.

Bloc 1 :
Stack
Laravel 13 · PHP 8.3 · Breeze · Blade · MySQL · Debugbar

Bloc 2 :
Architecture
MVC — Models, Views, Controllers

Bloc 3 :
Outils
GitHub par branches · Jira Kanban · tickets liés aux commits

Style :
- SaaS moderne ;
- fond clair ;
- cartes blanches ;
- accents navy blue ;
- icônes discrètes ;
- présentation professionnelle.

Contraintes :
- texte lisible ;
- pas de code ;
- ne pas mentionner l'IA.
```

## Slide 8 — Méthodologie Agile

Prompt à copier :

```text
Créer une slide 16:9 intitulée Méthodologie Agile.

Texte visible :
Cadre utilisé : Kanban
User Stories transformées en tickets Jira
Développement par feature
Commits liés aux tickets

Visuel :
À droite, prévoir un grand cadre vide avec le texte :
[Capture board Jira à insérer]

Style :
fond clair, cartes blanches, accents navy blue, rendu professionnel.

Contraintes :
- ne pas créer de faux board Jira ;
- garder le cadre pour remplacer par une vraie capture ;
- texte lisible ;
- ne pas mentionner l'IA.
```

## Slide 9 — Démonstration

Prompt à copier :

```text
Créer une slide de transition 16:9 très sobre.

Fond :
navy profond, composition minimaliste et professionnelle.

Texte visible :
Démonstration

Contraintes :
- un seul mot ;
- texte très lisible ;
- aucune autre phrase ;
- ne pas mentionner l'IA.
```

## Slide 10 — Conclusion

Prompt à copier :

```text
Créer une slide 16:9 intitulée Conclusion.

Créer trois blocs sobres.

Bloc 1 :
Difficultés
N+1, sécurité par utilisateur, archivage sans suppression

Bloc 2 :
Solutions
Eager loading, Policies, Soft Deletes

Bloc 3 :
Suite
Rappels de relance, calendrier, export CSV

Ajouter en bas une petite zone :
GitHub : abit0uh4r/CandidatureTracker

Style :
fond blanc ou gris très clair, cartes blanches, accents navy blue, rendu professionnel.

Contraintes :
- maximum 5 lignes principales ;
- texte lisible ;
- ne pas mentionner l'IA.
```

## Prompt de vérification après chaque image

À utiliser après chaque génération :

```text
Vérifie cette slide :
- format 16:9 ;
- texte lisible ;
- pas de texte coupé ;
- pas de chevauchement ;
- pas de mention d'IA ;
- pas d'élément inventé hors contexte ;
- style professionnel et cohérent avec les autres slides.

Si un problème existe, corrige uniquement cette slide.
```

## Vérification spéciale MCD

```text
Vérifie le MCD :
- aucun type de données ;
- aucune clé étrangère ;
- aucune colonne technique id, created_at, updated_at, deleted_at ;
- entités correctes : Utilisateur, Candidature, Entretien, Document ;
- cardinalités visibles et correctes ;
- relations lisibles ;
- aucune entité ajoutée.

Corrige le schéma si nécessaire.
```

## Vérification spéciale MLD

```text
Vérifie le MLD :
- toutes les tables sont présentes ;
- les types sont visibles ;
- les PK sont visibles ;
- les FK sont visibles ;
- deleted_at est bien visible dans job_applications ;
- les relations sont lisibles ;
- aucune table inventée.

Corrige le schéma si nécessaire.
```

