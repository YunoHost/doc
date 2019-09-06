# Guide Markdown

Le Markdown est un langage de balisage créé par en 2004, de nombreux add-on développant les possibilités de ce langage existent. L'objectif de ce guide est de tendre vers l'exaustivité des possibilités de ce langage dans le cadre de la documentation de Yunohost et non du langage Markdown en général.

Markdown permet de formater du texte à l'aide de balises, il permet une lecture *humaine* du texte même avec le formatage. Même si un unique bloc note est nécessaire il existe de nombreux logiciels markdowns (Markdown sur [framalibre.org](https://framalibre.org/recherche-par-crit-res?keys=markdown)). Sa prise en main est relativement facile.

## Les différents niveaux de titres

En rédigeant ça : 
```markdown
# Titre de niveau 1
## Titre de niveau 2
### Titre de niveau 3
#### Titre de niveau 4
##### Titre de niveau 5
###### Titre de niveau 6
```

On peut lire ça :
# Titre de niveau 1
## Titre de niveau 2
### Titre de niveau 3
#### Titre de niveau 4
##### Titre de niveau 5
###### Titre de niveau 6

## Formatage dans les paragraphes

Pour taper un retour à la ligne sans créer de nouveau paragraphe, il est nécessaire de taper **deux espaces** sans cela, le texte continuera à la suite. Suivant le style général de la page.

En rédigeant ça : 

```markdown
Pour du texte en *italique il faut encadrer par une étoiles*  
Pour rédiger du **texte en gras par deux étoiles**  
On peut aussi ~~barrer le texte~~
```

On peut lire ça :

Pour du texte en *italique il faut encadrer par une étoiles*  
Pour rédiger du **texte en gras par deux étoiles**
On peut aussi ~~barrer le texte~~

## Créer des liens
Pour créer un lien vers un site hors de la documentation de Yunohost :  
```[Texte à afficher](https://lelien.tld)```

s'affichera comme tel :  
[Texte à afficher](https://lelien.tld)

C'est identique pour les pages de la documentation excepté que le lien est interne. Il renvoi au fichier du wiki sans extension de fichier (le .md) :  
```[Page du wiki](write_documentation_fr)```  
[Page du wiki](write_documentation)

### Créer des ancres
Une ancre permet de faire un lien vers un point précis dans une page, c'est comme ça que fonctionne les index en haut de pages. Pour créer une ancre il faut insérer du code à l'endroit de l'ancre sous la forme suivante :  

```
<a name="NomDeLAncre"> Du texte qui sera ne sait même pas qu'il a une ancre</a>
```

Ce qui s'affiche :  

<a name="NomDeLAncre"> Du texte qui sera ne sait même pas qu'il a une ancre</a>

Il ne reste plus qu'à désigner l'ancre au texte que l'on souhaite interactif :  
```
[Mon titre qui renvoi](#NomDeLAncre)
```
[Mon titre qui renvoi](#NomDeLAncre)

## Afficher des images
Pour afficher des images le principe est identiques aux liens excepté l'ajout d'un `!` avant le texte à afficher qui est ici considéré comme le texte à afficher en cas d'impossibilité de chargement de l'image. Une description de l'image convient.

```
![Logo Yunohost](/images/logo.png)
```
![Logo Yunohost](/images/logo.png)

Il est possible de faire un lien avec une image, exemple : 
```
[![Logo Yunohost](/images/logo.png)](write_documentation)
```
[![Logo Yunohost](/images/logo.png)](write_documentation)

## Formater une citation

## Les listes

Les listes permettent d'afficher une suite de textes dans une présentation facile, c'est ainsi que son rédiger les index tel que celui de la page de la [documentation contributeur](contributordoc). 

### Ordonnées

Les listes ordonnées peuvent s'incrémenter autant que vous désirez, vous n'êtes pas obligé de donner le bonne correspondance au nombre. Il est possible de tous noter avec des `1` et installer trois espaces pour marquer l'incrémentation.

```
1. Liste 1
1. Liste 2
1. liste 3
   1. Liste 3a
   1. Liste 3b
      1. Liste 3b1
      1. Liste 3b2
      1. Liste 3b3
         1. Liste 1
         1. Liste 2
         1. liste 3
1. Liste 4
1. Liste 5
1. liste 6
```

On obtient :  

1. Liste 1
1. Liste 2
1. liste 3
   1. Liste 3a
   1. Liste 3b
      1. Liste 3b1
      1. Liste 3b2
      1. Liste 3b3
         1. Liste 1
         1. Liste 2
         1. liste 3
1. Liste 4
1. Liste 5
1. liste 6

### Non ordonnées

Pour créer une liste non ordonnée il faut utiliser les symboles `*`, `+` ou `*`. Cela ne changera pas l'apparence du marqueur dans la restitution du texte. C'est l'incrementation de la liste qui definira le visuel. Pour une meilleur lecture du texte brut, il peut être bien d'utiliser les symboles pour marquer l'incrementation, mais c'est bien les trois espaces avant la sous-liste qui désignera l'incrementation.  
Comme tel : 
```
+ Liste 1
+ Liste 2
+ liste 3
   + Liste 3a
   + Liste 3b
      + Liste 3b1
      + Liste 3b2
      + Liste 3b3
         - Liste 1
         - Liste 2
         * liste 3
- Liste 4
* Liste 5
+ liste 6
```

Ce qui affichera :   
+ Liste 1
+ Liste 2
+ liste 3
   + Liste 3a
   + Liste 3b
      + Liste 3b1
      + Liste 3b2
      + Liste 3b3
         - Liste 1
         - Liste 2
         * liste 3
- Liste 4
* Liste 5
+ liste 6

## les tableaux

Pour créer un tableau il faut utiliser les barres `|` et les tirets `-` il est important d'ajouter une ligne de tiret sous la première ligne du tableau. il n'y aucune contrainte dans la taille de ce dernier. Il est possible de formater le tableau avec les `:` dans la seconde ligne du tableau, trois options s'offrent à vous :

| Colonne alignée à gauche | Colonne centrée | Colonne alignée à droite |
|:-------------------------|:---------------:|-------------------------:|
|`:-----` | `:----:` | `-----:` |

```
| **Un tableau** | Une colonne | Une seconde | Autant que l'on veut |
|:--------------:|:-----------:|:-----------:|:--------------------:|
| Une ligne formatée | | Et du **textes en gras** | Ou en *italique* |
| D'autres lignes | |![une image](/images/cd.jpg) | [Ou un lien]( contributordoc) |
```
Ce qui afficherait ça :  

| **Un tableau** | Une colonne | Une seconde | Autant que l'on veut |
|:--------------:|:-----------:|:-----------:|:--------------------:|
| Une ligne formatée | | Et du **textes en gras** | Ou en *italique* |
| D'autres lignes | |![une image](/images/cd.jpg) | [Ou un lien]( contributordoc) |

Il existe bien d'autres possibilités d'utiliser la syntax markdown, n'hésitez pas à contribuer et ajouter vos utilisations. Si vous avez observé des manques et/ou que vous avez des questions contactez-nous sur [le forum](https://forum.yunohost.org) ou par message directe en IRC: #yunohost-doc sur irc.freenode.net.
