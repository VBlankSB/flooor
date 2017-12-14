# Flooor

Starter Theme personnel pour la création de thèmes personnalisés WordPress

Version WP requise: 4.0  
Testé jusqu'à: 4.9  
Projet sous License: [MIT](http://opensource.org/licenses/MIT)  et [CC BY 3.0 FR.](https://creativecommons.org/licenses/by/3.0/fr/) *Copyright (c) 2017 Valérie Blanchard*

## Description

La création du **Theme Flooor** est un **projet personnel** ayant pour but de faciliter mon flux de travail pour la création de thèmes personnalisés.

Il est conçu pour pouvoir être utilisé en tant que *Starter Thème* ou *Thème parent*. Il constitue un point de départ de création de nouveaux thèmes s'enrichissant au fur et à mesure de l'acquisition de connaissances. Il me permet de ne pas repartir de zéro à chaque fois, selon une idée développée par [G.Poupard](https://github.com/ffoodd "Compte Github ffoodd") avec sa création de thème extensible ffeeeedd.  

Flooor a été élaboré en étudiant le Starter Theme [Underscores](https://github.com/Automattic/_s) d'Automatics et les thèmes [Twenty](https://github.com/WordPress/WordPress/tree/master/wp-content/themes) par défaut. Le but étant de faire une compilation de ce dont j'ai réellement besoin, et d'implémenter uniquement ce que je comprends parfaitement à un instant T pour le manipuler facilement.

J'utilise ce thème en tant que Thème Parent pour le moment. Il n'inclus que du CSS de base (sous Sass) à des fins de normalisation et d'utilisation des classes générées par le Core de WordPress. Pas de Design ou Layout => les CSS créant la mise en page spécifique d'un thème pouvant avoir des orientations très différentes je réserve cette partie pour différents types de thèmes enfant de Flooor.
Voir les thèmes **flooor-simple**, **flooor-notebook** : bientôt disponible ici.

## Ce que contient Flooor

- Balisage HTML5 comportant
    - microformat hEntry
    - Microdata [schema.org](http://schema.org/)
    - balisage ARIA 
- CSS de base organisé via SASS (inspiré des [conventions proposées par Hugo Giraudel](https://github.com/HugoGiraudel/sass-boilerplate))
- Utilisation des Icones [Genericons](https://github.com/Automattic/Genericons)
- Mise à disposition de 2 Menus : 
    - Menu Principal
    - Menu Social (incluant l'ajout automatique d'icones)
- Mise à disposition d'une sidebar dite principale
- Fonctionnalités php additionnelles dans dossier inc/ pour :
    - sécuriser l'installation : *inc/securize-wordpress.php*
    - ~~optimiser l'installation : *inc/optimize-wordpress.php*~~ (supprimé du thème et déplacé dans un plugin [flooor-init-project](https://github.com/VBlankSB/flooor-init-project))
    - customiser le header : *inc/custom-header.php*
    - alléger les fichiers de template et éviter les duplications de code: *inc/template-tags.php*
    - modifier la façon dont s'ajoute les thumbnails et les commentaires: *inc/template-functions.php*
    - Fonction de customisation du theme pour l'onglet personnaliser: *inc/customizer.php*
    - *inc/jetpack.php*
- Fonctionnalités js pour :
    - Rendre html5 fonctionnel sur IE6 a IE8 avec html5shiv.js
    - Gérer des skip link d'accessibilité avec skip-link-focus.js
    - Améliorer la visibilité des changements de focus avec flying-focus.js

## Points à améliorer
- [x] Déplacer l'optimisation du thème dans un plugin d'initialisation de projet **flooor-init-project**
- [ ] Améliorer l'accessibilité du thème
- [ ] Différencier les fonctions partie admin des fonctions d'affichage en front
- [ ] Améliorer les données structurées Schema.org
- [ ] Utiliser les transients

## Utiliser Flooor comme Starter Theme

Exemple de changement du nom "floor" pour "incredible"

1. Récupérer le dépôt et changer le nom du projet **flooor** pour **incredible**
2. Dans les dossiers du projet:
    - Faire une recherche ``flooor`` pour remplacer par ``incredible`` : Modifie le text-domain, les préfixes de fonctions.
    - Faire une recherche ``Flooor`` pour remplacer par ``Incredible`` : Modifie le nom du Package présent en entête des fichiers.
    - Faire une recherche ``FLOOOR_VERSION`` pour remplacer par ``INCREDIBLE_VERSION`` : Modifie la constante de version.
3. Sécificité du dossier languages
    - Comme le text domain sera changé par le votre vous ne conserverez pas les traductions de chaines de flooor.
    - Supprimer les .pot .mo et .po déjà présents et régénérez les votres avec PoEdit.
4. Changer les attributions dans le fichier sass/style.sccs et le footer
5. Supprimer ce README.md
    
## Utiliser Flooor comme Theme Parent

Bientôt disponible des thèmes enfant pour flooor ...

## Changelog

- 1.0   
Première version

## Credits

Ce projet a pu voir le jour grâce aux lectures de différentes contributions de la communauté WordPress

Ce thème utilise entre autre:

* [Underscores](http://underscores.me/), (C) 2012-2016 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* [normalize.css](http://necolas.github.io/normalize.css/), (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
* [Flying focus](https://github.com/NV/flying-focus "Flying focus on Github") Thanks to Nikita Vasilyev
* [html5shiv](https://github.com/aFarkas/html5shiv/ "html5shiv on Github") Thanks to Sjoerd Visscher 
* D'autres credits sont placés directement dans les fichiers.
