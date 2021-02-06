---
title: Trouver l'IP locale de son serveur
template: docs
taxonomy:
    category: docs
---

Dans le cas d'une installation à la maison, votre serveur devrait typiquement être accessible (depuis son réseau local) avec le domaine `yunohost.local`. Si pour une raison cela ne fonctionne pas, il vous faut peut-être trouver l'IP locale de votre serveur.

L'IP locale d'une machine est utilisée pour y faire référence à l'intérieur d'un réseau local (typiquement le réseau dans une maison) où plusieurs appareils se connectent à un même routeur (votre box internet). Une adresse IP locale ressemble généralement à `192.168.x.y` (ou parfois `10.0.x.y`)

L'une de ces astuces devrait permettre de trouver l'IP locale de votre serveur :

- Utilisez l'interface de votre box internet pour lister les machines connectées, ou regarder les logs ;
- Si vous êtes sous Linux, ouvrez un terminal et tapez `sudo arp-scan --local` pour lister les IP des machines sur le réseau local (ceci fonctionne aussi peut-être sous Windows) ;
    - Si la commande `arp-scan` vous affiche beaucoup de machines, vous pouvez vérifier lesquelles sont ouvertes au SSH avec `nmap -p 22 192.168.1.0/24` pour faire du tri (adaptez la plage IP selon votre réseau local)
- Branchez un écran sur votre serveur, loggez-vous et tapez `hostname --all-ip-address`.

Si vous n'êtes pas capable de trouver votre serveur avec les méthodes précédentes, alors peut-être que votre serveur n'a pas démarré correctement

- Assurez-vous que le serveur est correctement branché ;
- Si votre serveur a une carte SD, essayez de vous assurer que la connectique n'est pas trop poussièreuse ;
- Branchez un écran sur le serveur et essayez de le redémarrer pour valider que le serveur démarre bien ;
- Assurez-vous que le cable ethernet est fonctionnel et correctement branché ;
