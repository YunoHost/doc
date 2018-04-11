# Introduction au packaging

Petite introduction au packaging d'application, pour comprendre de quoi nous parlons et comment ça marche.
Cette documentation s'adresse avant tout aux packageurs débutants qui ne sont pas à l'aise avec les concepts de shell, parsing et administration système de manière générale.

Nous verrons ici ce qu'est un package d'application YunoHost, comment cela fonctionne, comment faire pour écrire un package et comment se lancer dans l'aventure sans être tout seul.

### De quoi on parle en fait ?

Avant de démarrer, la bonne question c'est "Qu'est-ce qu'un package d'application !?"

Pour répondre à cette question, il faut revenir à ce qu'est YunoHost, c'est un système d’exploitation serveur visant à simplifier l’auto-hébergement de services Internet. Et pour faire ça, YunoHost met à disposition, entre autre, une interface d'administration permettant d'installer des applications en quelques clics.
Or si vous avez déjà installé une application web à la main, vous savez qu'en réalité c'est bien plus compliqué que quelques clics sur une jolie interface.

C'est là que le package d'application entre en jeu, c'est un ensemble de scripts qui automatise l'installation d'une application web et la préconfigure pour que l'utilisateur final n'ai besoin que de quelques clics pour l'installer facilement.

### Mais alors, comment ça marche ?

Du point de vue de l'utilisateur, c'est très simple, on choisit une application, on répond à quelques questions, ça mouline et c'est prêt.

Mais il se passe bien plus de choses derrière.  
Tout d'abord, lorsque l'application est sélectionnée, YunoHost va aller chercher son package sur Github, par exemple l'application [Custom Webapp](https://github.com/YunoHost-Apps/my_webapp_ynh).
Ensuite, YunoHost lit le fichier manifest.json pour connaître les questions à poser à l'utilisateur.

Mais ces questions anodines sont très importantes, on retrouvera souvent le domaine sur lequel installer l'application, l'adresse à laquelle elle sera accessible, l'utilisateur qui en sera l'administrateur et la langue par défaut de l'application.

Ce sont là des éléments essentiels pour configurer correctement notre application web lors de son installation. Pour ce faire, YunoHost va récupérer les réponses données par l'utilisateur et les envoyer au script install qui se trouve dans le dossier scripts du package.

Le script install va se charger d'installer l'application, en prenant en compte les réponses données par l'utilisateur. Ce script va simplement faire ce que vous auriez fait si vous aviez installé l'application à la main.

Si par la suite l'utilisateur souhaite supprimer l'application, YunoHost utilisera le script remove du dossier script, qui se chargera à la place de l'utilisateur de supprimer l'application, ses dossiers et tout ses fichiers de configuration.

### Qu'y a-t-il dans ces scripts pour que tout soit si simple pour l'utilisateur ?

Les scripts d'un package d'application sont simplement des commandes bash les unes à la suite des autres.

#### ... Et c'est quoi une commande bash ?

Une commande [bash](https://fr.wikipedia.org/wiki/Bourne-Again_shell) c'est une ligne de texte qui sera interprétée et produira un résultat. C'est ce qu'on a l'habitude d'appeler la ligne de commande.  
Or puisque votre serveur, sur lequel est installé YunoHost, ne dispose pas d'une interface graphique, vous n'avez que la ligne de commande de disponible. Vous l'atteignez en général après vous être connecté avec [ssh](/ssh_fr).

Les scripts d'un package ne sont donc qu'une succession de commandes bash, comme si vous les aviez tapées directement dans la console ssh pour installer l'application.

Pour savoir quoi écrire dans un script bash, je vous conseille de commencer par la lecture d'un [tuto simple](https://debian-facile.org/doc:programmation:shells:debuter-avec-les-scripts-shell-bash). Et si vous avez vraiment envie de lire, il y a aussi un [tuto plus complet](http://aral.iut-rodez.fr/fr/sanchis/enseignement/bash/index.html)

### Ok, je crois que j'ai compris ! Par où on commence?

Avant d'envisager de faire un package d'application, il faut réussir à installer correctement la dites application. Car le script ne fera que ce que vous lui direz de faire.

Ensuite, il faut aller lire (et oui encore) la documentation sur le packaging, mais la vrai cette fois, [celle qui emploie des mots bizarres](/packaging_apps_fr).  
Mais maintenant vous devriez les comprendre tout ces mots étranges.

Mais heureusement, vous n'êtes pas seul pour affronter cette épreuve titanesque, il y a d'autres packageurs que vous pouvez venir rencontrer sur le [forum](https://forum.yunohost.org/c/apps-packaging) et sur le [salon de discussion](xmpp:apps@conference.yunohost.org?join).  
N'hésitez pas à venir poser des questions sur ce que vous ne comprenez pas, il y aura toujours quelqu'un pour vous répondre.  
Et vous constaterez bien vite que ce n'est pas si difficile de packager une application.
