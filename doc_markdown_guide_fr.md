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
```

On peut lire ça :

Pour du texte en *italique il faut encadrer par une étoiles*  
Pour rédiger du **texte en gras par deux étoiles**

## Créer des liens
Pour créer un lien vers un site hors de la documentation de Yunohost :  
```[Texte à afficher](https://lelien.tld)```

s'affichera comme tel :  
[Texte à afficher](https://lelien.tld)

C'est identique pour les pages de la documentation excepté que le lien est interne. Il renvoi au fichier du wiki sans extension de fichier (le .md) :  
```[Page du wiki](write_documentation_fr)```  
[Page du wiki](write_documentation)

### Créer des ancres
Une ancre permet de faire un lien vers un point précis dans une page, c'est comme ça que fonctionne les index en haut de pages. Pour créer une ancre il faut insérer du code à l'endroit, 

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

#### Manipulation de l'image
Il est possible de contraindre l'image en ajoutant du code à la fin du lien comme cela :
```
![Logo Yunohost](/images/logo.png =50x50)
```
Dans le cas présent cela contraint l'image à une dimension de 50 pixels par 50 pixels
![Logo Yunohost](/images/logo.png =50x50)

## Formater une citation

## Faire des notes de bas de pages

## Les listes

### Ordonnées

### Non ordonnées

### Les listes de tâches

## les tableaux

Il existe bien d'autres possibilités d'utiliser la syntax markdown, n'hésitez pas à contribuer et ajouter vos utilisations. Si vous avez observé des manques et/ou que vous avez des questions contactez-nous sur [le forum](https://forum.yunohost.org) ou par message directe en IRC: #yunohost-doc sur irc.freenode.net.