---
title: Guide Markdown
template: docs
taxonomy:
    category: docs
routes:
  default: '/doc_markdown_guide'
---

Le Markdown est un langage de balisage créé en 2004, de nombreux add-on développant les possibilités de ce langage existent. L'objectif de ce guide est de tendre vers l’exhaustivité des possibilités de ce langage de formatage dans le cadre de la documentation de YunoHost et non des langages Markdown en général.

Markdown permet de formater du texte à l'aide de balises, il permet une lecture *humaine* du texte ; même avec le formatage. Même si un unique bloc note est nécessaire il existe de nombreux logiciels markdowns (Markdown sur [framalibre.org](https://framalibre.org/recherche-par-crit-res?keys=markdown)). Sa prise en main est relativement facile.

## Les différents niveaux de titres

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

## Formatage dans les paragraphes

Pour taper un retour à la ligne sans créer de nouveau paragraphe, il est nécessaire de taper **deux espaces consécutifs**.Sans cela, le texte continuera à la suite en respectant les contraintes générales du style de la page.

En rédigeant ça :

```markdown
Pour du texte en *italique il faut encadrer par un astérisque* `*`
Pour rédiger du **texte en gras par deux astérisques** `**`
On peut aussi ~~barrer le texte~~ en encadrant avec deux tildes `~`
```

On peut lire ça :

Pour du texte en *italique il faut encadrer par un astérisque* `*`
Pour rédiger du **texte en gras par deux astérisques** `**`
On peut aussi ~~barrer le texte~~ en encadrant avec deux tildes `~`

## Créer des liens

Pour créer un lien vers un site hors de la documentation de YunoHost :

```markdown
[Texte à afficher](https://lelien.tld)
```

s'affichera comme tel :
[Texte à afficher](https://lelien.tld)

C'est identique pour les pages de la documentation, excepté que le lien est interne. Le nom de la page est sa route par défault définie dans son *header*:
```markdown
[Page du wiki](/write_documentation)
```

Le lien renverra vers la page avec la bonne configuration de langue si la page existe, ou vers une autre langue disponible (l'anglais, généralement) si elle n'existe pas.
[Page du wiki](/write_documentation)

! Notez qu'il ne faut donc pas préciser le code de langue au début des liens vers d'autres pages de la documentation : `/fr`, `/en`, etc. sont superflus.

### Créer des ancres
Une ancre permet de faire un lien vers un point précis dans une page, c'est comme ça que fonctionnent les index en haut de page. Pour créer une ancre, il faut insérer du code à l'endroit de l'ancre sous la forme suivante :

```markdown
Du texte qui ne sait même pas qu'il a une ancre <a name="nomancre"></a>
```

Ce qui s'affiche :
Du texte qui ne sait même pas qu'il a une ancre <a name="nomancre"></a>

Il est aussi possible de directement renvoyer une ancre au titre, en notant le lien en minuscule avec des `-` à la place des espaces.
Il ne reste plus qu'à désigner l'ancre au texte que l'on souhaite rendre interactif :

```markdown
[Mon ancre qui renvoie vers les listes](#nomdelancre)
[Mon ancre qui renvoie vers le titre des tableaux](#les-tableaux)
```

[Mon ancre qui renvoie vers les listes](#nomdelancre)
[Mon ancre qui renvoie vers le titre des tableaux](#les-tableaux)

## Afficher des images

Pour afficher des images, le principe est identique aux liens, excepté l'ajout d'un `!` avant le texte à afficher qui est ici considéré comme le texte à afficher en cas d'impossibilité de chargement de l'image. Une description de l'image convient.

```markdown
![Logo YunoHost](image://logo.png)
```
![Logo YunoHost](image://logo.png)


Il est possible de faire un lien avec une image, exemple :
```markdown
[![Logo YunoHost](image://logo.png)](/write_documentation)
```
[![Logo YunoHost](image://logo.png)](/write_documentation)

L'encart de *texte à afficher en cas d'impossibilité de chargement de l'image* entre les crochets dans le lien de l'image n'est pas obligatoire mais fortement recommandé.

## Formater une citation

Les citations permettent de mettre en valeur un propos tenu par une autre personne, le wiki gère lui-même la façon dont c'est valorisé. Markdown utilise un chevron fermant, ce symbole : `>`, pour annoncer une citation. Il suffit de les rajouter avant la citation, comme tel :

```markdown
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

## Les listes

Les listes permettent d'afficher une suite de textes dans une présentation facile, c'est ainsi que sont rédigés les index tels que celui de la page de la [documentation contributeur](/contributordoc).

### Listes ordonnées

Les listes ordonnées peuvent s'incrémenter autant que vous le désirez, il n'est pas obligé de donner la bonne correspondance au nombre. Il est possible de noter avec des `1.` et installer trois espaces pour marquer l'incrémentation. Pour une meilleure compréhension du texte brut, il peut être pratique d'utiliser les chiffres de manière croissante pour marquer l'incrémentation, mais ce sont bien les trois `espaces` conséquents avant la sous-liste qui désigneront l'incrémentation.

```markdown
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
5. Liste 4
3. Liste 5
4. liste 6
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
5. Liste 4
3. Liste 5
4. liste 6

### Listes non ordonnées<a name="nomdelancre"></a>

Pour créer une liste non ordonnée, il faut utiliser les symboles `*`, `+` ou `*`. Cela ne changera pas l'apparence du marqueur dans la restitution du texte. C'est l'incrémentation de la liste qui définira le visuel. Pour une meilleure lecture du texte brut, il peut être pratique d'utiliser les différents symboles pour marquer l'incrémentation, mais ce sont bien les trois espaces avant la sous-liste qui désigneront l'incrémentation.
Comme tel :
```markdown
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

## Les tableaux

Pour créer un tableau, il faut utiliser la barre verticale `|` (appelé 'pipe') et les tirets `-`. Il est obligatoire d'ajouter une ligne de tirets sous la première ligne du tableau. Il n'y a aucune contrainte dans la taille de ce dernier. Il est possible de formater le tableau avec les `:` dans la seconde ligne du tableau, trois options s'offrent à vous :

| Colonne alignée à gauche | Colonne centrée | Colonne alignée à droite |
|:-------------------------|:---------------:|-------------------------:|
|`:-----` | `:----:` | `-----:` |

```markdown
| **Un tableau** | Une colonne | Une seconde | Autant que l'on veut |
|:--------------:|:-----------:|:-----------:|:--------------------:|
| Une ligne formatée | | Et du **texte en gras** | Ou en *italique* |
| D'autres lignes | |![une image](image://cd.jpg) | [Ou un lien](/contributordoc) |
```
Ce qui affichera ça :

| **Un tableau** | Une colonne | Une seconde | Autant que l'on veut |
|:--------------:|:-----------:|:-----------:|:--------------------:|
| Une ligne formatée | | Et du **texte en gras** | Ou en *italique* |
| D'autres lignes | |![une image](image://cd.jpg) | [Ou un lien](/contributordoc) |

## Bloc de codes

Pour afficher du texte en brut, des `blocs de code` peuvent être créés en utilisant l'accent grave `Alt Gr + è` :

```markdown
Soit inline, par exemple pour mettre en valeur une touche comme `Ctrl`
```

ou directement en bloc.
La seule différence est dans la quantité d'accents graves :
Minimum trois accents graves en ouverture et fermeture de bloc et deux accents graves qui encadrent le morceau de texte à formater dans une ligne

Ce qui donnera au rendu :

Soit inline, par exemple pour mettre en valeur une touche comme `Ctrl`
&#39;&#39;&#39;
```markdown
ou directement en bloc.
La seule différence est dans la quantité d'accents graves :
Minimum trois accents graves en ouverture et fermeture de bloc et deux accents graves qui encadrent le morceau de texte à formater dans une ligne
```
&#39;&#39;&#39;
## Liens utiles

 + La documentation du langage originel Markdown : [daringfireball.net/projects/markdown (en)](https://daringfireball.net/projects/markdown/)
 + Tutoriel Markdown sur [markdowntutorial.com](https://markdowntutorial.com)

## Aller plus loin

De manière plus générale, pour comprendre comment est formaté un texte il suffit juste d'inspecter le document source avec une application note. Ce n'est pas pour autant que le wiki de YunoHost pourra l'exploiter. Il existe bien d'autres possibilités d'utiliser la syntaxe markdown, n'hésitez pas à ajouter des fonctionnalités manquantes. Si vous avez observé des manques et/ou que vous avez des questions, contactez-nous sur [le forum](https://forum.yunohost.org) ou par message direct sur le salon IRC : **#yunohost** sur [irc.freenode.net](https://irc.freenode.net).
