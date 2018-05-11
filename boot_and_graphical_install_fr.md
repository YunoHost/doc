# Installation graphique

Maintenant que vous possédez un support YunoHost, vous pouvez procéder à l’installation.

## <small>1.</small> Brancher le câble réseau

Si vous souhaitez que la configuration réseau soit configurée automatiquement, vous devez brancher votre serveur avec un câble **Ethernet** directement **derrière votre routeur (ou box) principal**.

Les connexions sans-fil ne sont pas supportées pour le moment, et si vous utilisez des routeurs intermédiaires, l’ouverture des ports réseau ne se fera pas automatiquement : votre serveur ne sera pas accessible depuis l’extérieur.

## <small>2.</small> Démarrer sur le CD/la clé USB

Démarrez votre serveur avec la clé USB ou le CD-ROM inséré, et sélectionnez-le comme **périphérique de démarrage** en pressant l’une des touches suivantes (dépendant de votre ordinateur) :    
```<Échap>```, ```<F8>```, ```<F10>```, ```<F11>```, ```<F12>``` or ```<Suppr>```

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

## <small>4.</small> Procéder à la post-installation

Une fois démarré, votre serveur devrait afficher un écran comme celui-ci :

<img src="/images/virtualbox_4.png">

Vous pouvez procéder à la post-installation directement, ou accéder à l’adresse **IP** affichée sur cet écran depuis un navigateur web d’un autre ordinateur (généralement `http://192.168.x.x`)

<img src="/images/postinstall_error.png" style="max-width:100% ; border-radius: 5px ; border: 1px solid rgba(0,0,0,0.15) ; box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

Si vous rencontrez une erreur de ce type, cliquez sur « **Poursuivre quand même** » ou « **Ajouter une exception** ». (Certains navigateurs interdisent totalement la connexion. Si c'est le cas, vous pouvez réessayer avec un autre.)

Cela signifie que vous devez faire confiance au certificat qui sécurise les connexions avec votre serveur.    
Comme c’est le votre, vous pouvez le valider sereinement ici :-)

<br>

<img src="/images/postinstall_web.png" style="max-width:100% ; border-radius: 5px ; border: 1px solid rgba(0,0,0,0.15) ; box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

---

#### Plus d’informations sur la post-installation ici :

**[yunohost.org/postinstall](/postinstall)**
