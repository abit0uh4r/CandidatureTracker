# Source MCD — Méthode Merise

Ce fichier sert à produire le MCD dans draw.io, Lucidchart ou un outil équivalent.

Important pour la slide 5 :

- ne pas afficher les types de données ;
- ne pas afficher les clés étrangères ;
- ne pas afficher `deleted_at` comme détail technique ;
- afficher les entités, attributs métier, relations et cardinalités.

## Entités

### Utilisateur

- nom
- email
- mot de passe

### Candidature

- entreprise
- poste visé
- URL de l'offre
- statut
- priorité
- notes
- date de candidature

### Entretien

- type
- date et heure planifiée
- notes de préparation
- résultat

### Document

- nom original
- chemin du fichier
- type MIME
- taille

## Associations et cardinalités

```text
Utilisateur (1,1) — possède — (0,N) Candidature
Candidature (1,1) — planifie — (0,N) Entretien
Candidature (1,1) — contient — (0,N) Document
```

## Conseils de mise en page

- Placer `Candidature` au centre.
- Placer `Utilisateur` à gauche.
- Placer `Entretien` et `Document` à droite.
- Afficher les cardinalités près des extrémités des relations.
- Exporter en PNG sous `docs/presentation/assets/mcd.png`.

