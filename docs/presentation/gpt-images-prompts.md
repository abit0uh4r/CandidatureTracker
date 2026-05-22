# Prompts GPT Images — Présentation CandidatureTracker

Objectif : créer des visuels 16:9 propres pour une présentation de soutenance, sans mentionner l'IA.

## Règle importante

GPT Images peut générer :

- des fonds de slides ;
- des compositions visuelles ;
- des placeholders propres ;
- des illustrations abstraites autour du suivi de candidatures.

GPT Images ne doit pas générer :

- le MCD final ;
- le MLD final ;
- une fausse capture Jira ;
- une fausse capture de l'application.

Ces éléments doivent être remplacés par des captures ou exports réels.

## Style global

À utiliser dans tous les prompts :

```text
Format 16:9, style présentation SaaS moderne, professionnel, sobre, fond blanc ou gris très clair, accents navy blue, cartes blanches, bordures subtiles, ombres légères, beaucoup d'espace, design propre pour soutenance, pas de texte illisible, pas de logo inventé, pas de mention d'IA.
```

## Conseil de méthode

Le plus propre :

1. Générer une image de fond/composition sans trop de texte.
2. Ajouter les vrais titres et textes dans PowerPoint, Canva ou Google Slides.
3. Garder le texte éditable.

Évite de demander à GPT Images de générer tout le texte des slides, car le texte dans les images peut être déformé.

## Slide 1 — Couverture

```text
Créer une slide de couverture 16:9 pour une soutenance de projet web nommé CandidatureTracker. Style SaaS moderne, fond navy profond, carte centrale subtile, accents blanc et bleu clair, ambiance professionnelle. Prévoir une zone centrale vide pour ajouter le titre, le nom de l'étudiant et le nom du formateur. Ne pas générer de texte. Ne pas ajouter de logo inventé.
```

## Slide 2 — Sommaire

```text
Créer un fond de slide 16:9 pour un sommaire de présentation SaaS. Fond blanc/gris très clair, six petites cartes alignées proprement, icônes abstraites discrètes, accents navy blue. Les cartes doivent être vides pour ajouter du texte ensuite. Style moderne, minimal, professionnel. Ne pas générer de texte.
```

## Slide 3 — Problématique

```text
Créer une illustration 16:9 pour représenter le problème d'une recherche d'emploi dispersée : notes, emails, plateformes, entretiens et documents éparpillés. Style SaaS moderne, fond clair, éléments abstraits organisés, couleur principale navy blue, pas de texte. Prévoir de l'espace à gauche pour ajouter 4 lignes de texte.
```

## Slide 4 — Solution

```text
Créer une slide 16:9 de présentation de solution SaaS, avec une grande zone vide à droite pour insérer plus tard une capture dashboard réelle. À gauche, prévoir une zone propre pour un titre et 3 courtes user stories. Style professionnel, fond gris très clair, cartes blanches, accents navy. Ne pas générer de texte.
```

## Slide 5 — MCD

```text
Créer une slide 16:9 très sobre pour afficher un Modèle Conceptuel des Données. Fond blanc, titre en haut à gauche à ajouter plus tard, grand cadre vide central avec bordure discrète pour remplacer par un export MCD réel. Ne pas créer de diagramme. Ne pas générer de texte.
```

## Slide 6 — MLD

```text
Créer une slide 16:9 très sobre pour afficher un Modèle Logique des Données. Fond blanc, grand cadre vide central avec bordure discrète pour remplacer par un export MLD réel. Style professionnel, accents navy blue. Ne pas créer de diagramme. Ne pas générer de texte.
```

## Slide 7 — Architecture & Stack technique

```text
Créer une slide 16:9 pour présenter l'architecture d'une application web Laravel. Style SaaS moderne, trois blocs visuels vides côte à côte : Stack, MVC, Outils. Icônes abstraites discrètes, fond clair, accents navy, cartes blanches. Ne pas générer de texte.
```

## Slide 8 — Méthodologie Agile

```text
Créer une slide 16:9 pour une méthodologie Kanban. À droite, grand cadre vide pour insérer une capture réelle de board Jira. À gauche, zone vide pour trois points clés. Style moderne, professionnel, fond clair, accents navy blue. Ne pas créer de faux board Jira. Ne pas générer de texte.
```

## Slide 9 — Démonstration

```text
Créer une slide 16:9 de transition très minimaliste pour une démonstration. Fond navy profond, composition sobre et élégante, une grande zone centrale vide pour ajouter le mot Démonstration ensuite. Aucun texte généré.
```

## Slide 10 — Conclusion

```text
Créer une slide 16:9 de conclusion pour un projet web SaaS. Fond blanc/gris très clair, trois cartes vides alignées : difficultés, apprentissages, prochaines étapes. Petite zone en bas pour ajouter un lien GitHub ou QR code. Style professionnel, accents navy, pas de texte généré.
```

## Prompt de contrôle final

Après avoir généré les visuels, utiliser ce contrôle :

```text
Vérifie que l'image respecte ces contraintes :
- format 16:9 ;
- aucun texte généré ou texte illisible ;
- pas de mention d'IA ;
- pas de faux MCD ;
- pas de faux MLD ;
- pas de faux board Jira ;
- assez d'espace pour ajouter le texte dans PowerPoint ;
- style cohérent avec une soutenance professionnelle.
```

