#Free

*Trouvez la liste d’autres fournisseurs d’accès Internet **[ici](/isp_fr)**.*

#### Accès à l’administration de la box (v5/v6)

Allez à l’adresse : http://mafreebox.free.fr/ puis authentifiez-vous.

#### Ouverture des ports

[Tutoriel d’ouverture des ports sur Freebox](http://www.astuces-pratiques.fr/informatique/ouvrir-un-port-sur-la-freebox-revolution)

[Liste des ports à ouvrir](https://yunohost.org/#/isp_box_config_fr).

#### Déblocage de l’envoi de courriel

Pour pouvoir envoyer des mails, le déblocage se fait dans la [partie client](https://subscribe.free.fr/login/).

Depuis le menu Ma freebox aller sur « Blocage SMTP sortant ».

Pour pouvoir envoyer des mails, passer le blocage en « inactif ».

#### Fonction NAS de la Freebox

Il faut installer le paquet cifs-utils
$ sudo apt-get install cifs-utils

Il faut créer un point de montage (ici /home/monlogin/freebox)
$ mkdir ~/freebox

On monte le répertoire NAS par défaut avec les droits de lecture / écriture pour tous
$ sudo mount -t cifs //mafreebox.freebox.fr/Disque\ dur/ /home/monlogin/freebox -o guest,iocharset=utf8,file_mode=0777,dir_mode=0777

RAF : automatiser ce montage car il faut le refaire à chaque rédémarrage.