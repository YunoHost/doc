# Installation graphique

Maintenant que vous possédez un support YunoHost, vous pouvez procéder à l’installation.

## <small>1.</small> Brancher le câble réseau

Si vous souhaitez que la configuration réseau soit configurée automatiquement, vous devez brancher votre serveur avec un câble **Ethernet** directement **derrière votre routeur (ou box) principal**.

Les connexions sans-fil ne sont pas supportées pour le moment, et si vous utilisez des routeurs intermédiaires, l’ouverture des ports réseau ne se fera pas automatiquement : votre serveur ne sera pas accessible depuis l’extérieur.

## <small>2.</small> Démarrer sur le CD/la clé USB

Démarrez votre serveur avec la clé USB ou le CD-ROM inséré, et sélectionnez-le comme **périphérique de démarrage** en pressant l’une des touches suivantes (dépendant de votre ordinateur) :    
```<Échap>```, ```<F9>```, ```<F10>```, ```<F11>```, ```<F12>``` or ```<Suppr>```

## <small>3.</small> Lancer l’installation graphique

Vous devriez voir un écran comme ça :

<img src="/images/virtualbox_3.png">


* Sélectionnez `Graphical install`

* Sélectionnez votre langue, votre localisation et votre agencement de clavier.

* Si un écran de partitionnement apparaît, confirmez simplement.

    <div class="alert alert-danger"><b>Attention :</b> Cette opération effacera totalement les données sur votre disque dur</div>

* Laissez l’installateur faire le reste, il téléchargera les paquets requis et les installera.

   <div class="alert alert-info">Si cette opération échoue, vous avez probablement un problème de connexion à Internet.    
Vérifiez que votre serveur est bien branché et réessayez.</div>

* L’ordinateur devrait redémarrer automatiquement à la fin de l’installation.

## <small>4.</small> Log in

Après avoir redémarré, votre machine devrait afficher un écran noir avec
quelques mots vous invitant à vous identifier. Vous pouvez utiliser les
identifiants suivants :

* User: **root**
* Password: **yunohost**

## <small>5.</small> Procéder à la post-installation

<a class="btn btn-lg btn-default" href="/postinstall_fr">Documentation de la post-installation</a>

