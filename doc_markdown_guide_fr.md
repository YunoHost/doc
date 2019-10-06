# Guide Markdown

**Index**  
 - [Les différents niveaux de titres](#NiveauxTitres)  
 - [Formatage dans les paragraphes](#FormatageParagraphe)  
 - [Créer des liens](#CreerLiens)  
    + [Créer des ancres](#LiensAncres)  
 - [Afficher des images](#AfficherImages)  
 - [Formater une citation](#FormaterCitation)  
 - [Les listes](#UtiliserListes)  
    + [Listes ordonnées](#ListesOrdonnees)  
    + [Listes non ordonnées](#ListesNonOrdonnees)  
 - [Les tableaux](#UtiliserTableaux)  
 - [Bloc de Codes](#BlockCodes)

Le Markdown est un langage de balisage créé en 2004, de nombreux add-on développant les possibilités de ce langage existent. L'objectif de ce guide est de tendre vers l'exaustivité des possibilités de ce langage de formatage dans le cadre de la documentation de Yunohost et non du langage Markdown en général.

Markdown permet de formater du texte à l'aide de balises, il permet une lecture *humaine* du texte ; même avec le formatage. Même si un unique bloc note est nécessaire il existe de nombreux logiciels markdowns (Markdown sur [framalibre.org](https://framalibre.org/recherche-par-crit-res?keys=markdown)). Sa prise en main est relativement facile.

## Les différents niveaux de titres <a name="NiveauxTitres"></a>

En rédigeant des titres comme suit :
```markdown
# Titre de niveau 1
## Titre de niveau 2
### Titre de niveau 3
#### Titre de niveau 4
##### Titre de niveau 5
###### Titre de niveau 6
```

Ils apparaissent comme cela :
# Titre de niveau 1
## Titre de niveau 2
### Titre de niveau 3
#### Titre de niveau 4
##### Titre de niveau 5
###### Titre de niveau 6

## Formatage dans les paragraphes <a name="FormatageParagraphe"></a>

Pour taper un retour à la ligne sans créer de nouveau paragraphe, il est nécessaire de taper **deux espaces consécutifs**.Sans cela, le texte continuera à la suite en respectant les contraintes générales du style de la page.

En rédigeant ça :

```markdown
Pour du texte en *italique il faut encadrer par un astérique`*`*  
Pour rédiger du **texte en gras par deux astériques**  
On peut aussi ~~barrer le texte~~ en encadrant avec deux tildes `~`
```

On peut lire ça :

Pour du texte en *italique il faut encadrer par un astérique `*` *  
Pour rédiger du **texte en gras par deux astériques**
On peut aussi ~~barrer le texte~~ en encadrant avec deux tildes `~`

## Créer des liens <a name="CreerLiens"></a>

Pour créer un lien vers un site hors de la documentation de Yunohost :  

```markdown
[Texte à afficher](https://lelien.tld)
```

s'affichera comme tel :  
[Texte à afficher](https://lelien.tld)

C'est identique pour les pages de la documentation, excepté que le lien est interne. Il renvoie au fichier du wiki, sans extension de fichier (le `.md`) :  
```
[Page du wiki](write_documentation_fr)
```  
[Page du wiki](write_documentation)

### Créer des ancres <a name="LiensAncres"></a>
Une ancre permet de faire un lien vers un point précis dans une page, c'est comme ça que fonctionnent les index en haut de page. Pour créer une ancre, il faut insérer du code à l'endroit de l'ancre sous la forme suivante :  

```
Du texte qui sera ne sait même pas qu'il a une ancre <a name="NomDeLAncre"></a>
```

Ce qui s'affiche :  
Du texte qui sera ne sait même pas qu'il a une ancre <a name="NomDeLAncre"></a>  

Il ne reste plus qu'à désigner l'ancre au texte que l'on souhaite rendre interactif :  

```
[Mon titre qui renvoie](#NomDeLAncre)
```

[Mon titre qui renvoie](#NomDeLAncre)

## Afficher des images <a name="AfficherImages"></a>

Pour afficher des images, le principe est identique aux liens, excepté l'ajout d'un `!` avant le texte à afficher qui est ici considéré comme le texte à afficher en cas d'impossibilité de chargement de l'image. Une description de l'image convient.

```
![Logo Yunohost](/images/logo.png)
```
![Logo Yunohost](/images/logo.png)

Il est possible de faire un lien avec une image, exemple :
```
[![Logo Yunohost](/images/logo.png)](write_documentation)
```
[![Logo Yunohost](/images/logo.png)](write_documentation)

L'encart de *texte à afficher en cas d'impossibilité de chargement de l'image* n'est pas obligatoire mais fortement recommandé.

## Formater une citation <a name="FormaterCitation"></a>

Les citations permettent de mettre en valeur un propos tenu par une autre personne, le wiki gère lui même la façon dont c'est valorisé. Markdown utilise un chevron fermant, ce symbole : `>`, pour annoncer une citation. Il suffit de les rajouter avant la citation, comme tel :
```
>Du texte de citation du premier niveau
>qui peut être formaté en différentes lignes

>> Et une seconde citation
>> avec des doubles chevrons
```  
S'affichera :  

>Du texte de citation du premier niveau
>qui peut être formaté en différentes lignes

>> Et une seconde citation
>> avec des doubles chevrons

## Les listes <a name="UtiliserListes"></a>

Les listes permettent d'afficher une suite de textes dans une présentation facile, c'est ainsi que sont rédiger les index tels que celui de la page de la [documentation contributeur](contributordoc).

### Listes ordonnées <a name="ListesOrdonnees"></a>

Les listes ordonnées peuvent s'incrémenter autant que vous le désirez, il n'est pas obligé de donner la bonne correspondance au nombre. Il est possible de noter avec des `1.` comme des `7.` et installer trois espaces pour marquer l'incrémentation. Pour une meilleure compréhension du texte brut, il peut être bien d'utiliser les chiffres de manières croissantes pour marquer l'incrémentation, mais c'est bien les trois `espaces` conséquents avant la sous-liste qui désigneront l'incrémentation.  

```
1. Liste 1
1. Liste 2
1. liste 3
   1. Liste 3a
   1. Liste 3b
      3. Liste 3b1
      3. Liste 3b2
      3. Liste 3b3
         4. Liste 1
         4. Liste 2
         4. liste 3
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
      3. Liste 3b1
      3. Liste 3b2
      3. Liste 3b3
         4. Liste 1
         4. Liste 2
         4. liste 3
5. Liste 4
3. Liste 5
4. liste 6

### Listes non ordonnées <a name="ListesNonOrdonnees"></a>

Pour créer une liste non ordonnée, il faut utiliser les symboles `*`, `+` ou `*`. Cela ne changera pas l'apparence du marqueur dans la restitution du texte. C'est l'incrémentation de la liste qui définira le visuel. Pour une meilleure lecture du texte brut, il peut être bien d'utiliser les différents symboles pour marquer l'incrémentation, mais c'est bien les trois espaces avant la sous-liste qui désigneront l'incrémentation.  
Comme tel :
```
+ Liste 1
+ Liste 2
+ liste 3
   - Liste 3a
   - Liste 3b
      * Liste 3b1
      * Liste 3b2
      * Liste 3b3
         + Liste 1
         + Liste 2
         + liste 3
- Liste 4
* Liste 5
+ liste 6
```

Ce qui affichera :   
+ Liste 1
+ Liste 2
+ liste 3
   - Liste 3a
   - Liste 3b
      * Liste 3b1
      * Liste 3b2
      * Liste 3b3
         + Liste 1
         + Liste 2
         + liste 3
- Liste 4
* Liste 5
+ liste 6

## Les tableaux <a name="UtiliserTableaux"></a>

Pour créer un tableau, il faut utiliser la barre verticale `|` et les tirets `-`. Il est obligatoire d'ajouter une ligne de tiret sous la première ligne du tableau. Il n'y a aucune contrainte dans la taille de ce dernier. Il est possible de formater le tableau avec les `:` dans la seconde ligne du tableau, trois options s'offrent à vous :

| Colonne alignée à gauche | Colonne centrée | Colonne alignée à droite |
|:-------------------------|:---------------:|-------------------------:|
|`:-----` | `:----:` | `-----:` |

```
| **Un tableau** | Une colonne | Une seconde | Autant que l'on veut |
|:--------------:|:-----------:|:-----------:|:--------------------:|
| Une ligne formatée | | Et du **texte en gras** | Ou en *italique* |
| D'autres lignes | |![une image](/images/cd.jpg) | [Ou un lien]( contributordoc) |
```
Ce qui afficherait ça :  

| **Un tableau** | Une colonne | Une seconde | Autant que l'on veut |
|:--------------:|:-----------:|:-----------:|:--------------------:|
| Une ligne formatée | | Et du **texte en gras** | Ou en *italique* |
| D'autres lignes | |![une image](/images/cd.jpg) | [Ou un lien]( contributordoc) |

## Bloc de codes <a name="BlockCodes"></a>

Pour afficher du texte en brut, des `blocs de codes` peuvent être créer :  

````  
Soit inline, par exemple pour mettre en valeur une touche comme `Ctrl`
```  
ou directement en bloc.  
La seule différence est dans la quantité de : `
Minimum ``` en ouverture et fermeture de bloc et deux ` qui   encadre le morceau de texte à formater dans une ligne
```  
````

Ce qui donnera au rendu :

Soit inline, par exemple pour mettre en valeur une touche comme `Ctrl`
```  
ou directement en bloc.  
La seule différence est dans la quantité de : `
Minimum ``` en ouverture et fermeture de bloc et deux ` qui   encadre le morceau de texte à formater dans une ligne
```  

## Liens utiles <a name ="LiensUtiles"></a>

 + La documentation du langage originel Markdown : [daringfireball.net/projects/markdown (en)](https://daringfireball.net/projects/markdown/)
 + Tutoriel Markdown sur [markdowntutorial.com (en)](https://markdowntutorial.com)

## Aller plus loin <a name ="AllerLoin"></a>

De manière plus général, pour comprendre comment est formaté un texte il suffit juste d'inspecter le document source avec une application note. Ce n'est pas pour autant que le wiki de YunoHost pourra l'exploiter. Il existe bien d'autres possibilités d'utiliser la syntaxe markdown, n'hésitez pas à ajouter des fonctionnalités manquantes. Si vous avez observé des manques et/ou que vous avez des questions, contactez-nous sur [le forum](https://forum.yunohost.org) ou par message directe sur le salon IRC : **#yunohost** sur [irc.freenode.net](https://irc.freenode.net). 
