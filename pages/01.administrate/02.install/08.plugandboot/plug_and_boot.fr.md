# Brancher et démarrer votre serveur

* Branchez votre serveur avec un câble Ethernet (RJ-45) **directement sur votre routeur principal**. Vous pouvez aussi configurer la connexion wifi comme expliqué [ici](http://raspbian-france.fr/connecter-wifi-raspberry-pi-3/). La configuration wifi peut aussi se faire sans avoir booté sur la carte, en "montant" la deuxième partition de la carte et enfin éditer le fichier wpa-supplicant.conf. Sur Windows vous pouvez utiliser [Paragon ExtFS](https://www.paragon-software.com/home/extfs-windows/), ne pas oublier de "unmount" pour que les changements soient pris en compte. 

* Facultatif : vous pouvez **brancher un écran** si vous voulez observer comment se déroule le démarrage, et un clavier si vous souhaitez un accès en **ligne de commande** à votre serveur.

* Démarrez le serveur, le Raspberry Pi va redémarrer tout seul une première fois, puis attendez jusqu’à voir un gros `Y` carré :

<br>

<div class="text-center"><img src="/images/boot_screen.png">


*Notez la valeur `IP` affichée à l’écran : c’est **l’adresse IP locale** de votre serveur.*


</div>
<br>Si vous n'avez pas d'écran pour votre Raspberry, ce n'est pas grave ! Vous pourrez trouver son adresse IP autrement à l'étape suivante.
