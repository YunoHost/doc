---
title: Trouver l'IP locale de son serveur
template: docs
taxonomy:
    category: docs
routes:
  default: '/finding_the_local_ip'
---

Dans le cas d'une installation à la maison, votre serveur devrait typiquement être accessible (depuis son réseau local) avec le domaine `yunohost.local`. Si pour une raison quelconque cela ne fonctionne pas, il vous faut peut-être trouver l'IP locale de votre serveur.

## Qu'est ce qu'une IP locale ?
L'IP locale d'une machine est utilisée pour y faire référence à l'intérieur d'un réseau local (typiquement le réseau dans une maison) où plusieurs appareils se connectent à un même routeur (votre box internet). Une adresse IP locale ressemble généralement à `192.168.x.y` (ou parfois `10.0.x.y` ou `172.16.x.y`)

## Comment la trouver ?
L'une de ces astuces devrait permettre de trouver l'IP locale de votre serveur :
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommandé) Avec AngryIP"]

Vous pouvez utiliser le logiciel [AngryIP](https://angryip.org/download/) pour y parvenir. Vous devez juste scanner ces plages d'IP dans cet ordre jusqu'à trouver l'IP correspondante à votre serveur :
- `192.168.0.0` -> `192.168.0.255`
- `192.168.1.0` -> `192.168.1.255`
- `192.168.2.0` -> `192.168.255.255`
- `10.0.0.0` -> `10.0.255.255`
- `172.16.0.0` -> `172.31.255.255`

!!! **Astuces**:
!!! - vous pouvez ordonner par ping comme dans cette capture d'écran, pour voir plus facilement toutes les IP effectivement actives.
!!! - votre serveur devrait être monté comme écoutant sur les ports 80 et 443
!!! - en cas de doute, tapez directement dans votre navigateur `https://192.168.x.y` pour voir si c'est un Yunohost ou non.

![](image://angryip.png?class=inline)

[/ui-tab]
[ui-tab title="Avec votre box internet"]
Utilisez l'interface de votre box internet pour lister les machines connectées.
[/ui-tab]
[ui-tab title="With arp-scan"]
Si vous êtes sous Linux, ouvrez un terminal et tapez `sudo arp-scan --local` pour lister les IP des machines sur le réseau local (ceci fonctionne aussi peut-être sous Windows) ;

Si la commande `arp-scan` vous affiche beaucoup de machines, vous pouvez vérifier lesquelles sont ouvertes au SSH avec `nmap -p 22 192.168.1.0/24` pour faire du tri (adaptez la plage IP selon votre réseau local)
[/ui-tab]
[ui-tab title="With a screen"]
Branchez un écran sur votre serveur, loggez-vous et tapez `hostname --all-ip-address`.

Les identifiants par défaut (avant la post-installation!) sont:
- login: root
- mot de passe: yunohost

(Si vous utilisez une image Armbian brute plutôt que les images Yunohost pré-installées, les identifiants sont root / 1234)



[/ui-tab]
[/ui-tabs]


## Je ne trouve toujours pas mon IP locale
Si vous n'êtes pas capable de trouver votre serveur avec les méthodes précédentes, alors peut-être que votre serveur n'a pas démarré correctement

- Assurez-vous que le serveur est correctement branché ;
- Si votre serveur a une carte SD, essayez de vous assurer que la connectique n'est pas trop poussièreuse ;
- Branchez un écran sur le serveur et essayez de le redémarrer pour valider que le serveur démarre bien ;
- Assurez-vous que le cable ethernet est fonctionnel et correctement branché ;
