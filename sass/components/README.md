# Components

Ce dossier contient les composants à réutiliser à volonté patout dans le site comme slider, loader, widgets, thumbnails etc ... Appelé aussi parfois dossier modules.

L’application entière devrait être essentiellement constituée de petits modules.

Exemple : components/button.scss
- un bouton
- les variantes de boutons
- ses différents états
- ses descendants (enfants) si nécessaire

Si vous souhaitez rendre vos composants personnalisables de façon externe, limitez les déclarations aux styles structurels comme les dimensions (width, height), marges (padding, margin), alignements, etc. Évitez les styles graphiques comme les couleurs, ombres, fonds, règles de typographie, etc.

Un fichier de composant peut inclure des variables, placeholders et mêmes mixins et fonctions du moment que ceux-ci sont spécifiques au dit composant.

Voir [Sass Guideline](https://sass-guidelin.es/fr/#architecture)
