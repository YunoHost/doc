#Free

*Trouvez la liste d’autres fournisseurs d’accès Internet **[ici](/isp_fr)**.*

#### Accès à l’administration de la box (v5/v6)

##### Freebox ≤ v5 

Rendez-vous sur la [console d'administration du site de free](https://subscribe.free.fr/login/).

##### Freebox v6 (Revolution / Mini4k)

Allez à l’adresse : [mafreebox.free.fr](http://mafreebox.free.fr/) puis authentifiez-vous.

#### Ouverture des ports

[Liste des ports à ouvrir](/isp_box_config_fr).

##### Freebox ≤ v5 

Cela se passe dans la section *Ma Freebox / Configurer mon routeur*. Il faut :

- Rediriger les [ports à ouvrir](/isp_box_config_fr) vers l'adresse locale de votre serveur YunoHost.
- Définir une DMZ vers votre serveur YunoHost.

La présence conjointe de ces deux règles permettent d'accéder à votre serveur de l'extérieur comme de l'intérieur de votre réseau local.

##### Freebox v6
[Tutoriel d’ouverture des ports sur Freebox](http://www.astuces-pratiques.fr/informatique/ouvrir-un-port-sur-la-freebox-revolution)


#### Déblocage de l’envoi de courriel

Pour pouvoir envoyer des mails, le déblocage se fait dans la [partie client](https://subscribe.free.fr/login/).

Depuis le menu Ma freebox aller sur « Blocage SMTP sortant ».

Pour pouvoir envoyer des mails, passer le blocage en « inactif ».

#### Fonction NAS de la Freebox

Il faut installer le paquet `cifs-utils`
```bash
$ sudo apt-get install cifs-utils
```

Il faut créer un point de montage (ici `/home/monlogin/freebox`)
```bash
$ mkdir ~/freebox
```

On monte le répertoire NAS par défaut avec les droits de lecture / écriture pour tous
```bash
$ sudo mount -t cifs //mafreebox.freebox.fr/Disque\ dur/ /home/monlogin/freebox -o guest,iocharset=utf8,file_mode=0777,dir_mode=0777
```

##### Automatiser le montage

Ajouter cette ligne dans `/etc/fstab` : 
```
//mafreebox.freebox.fr/Disque\040dur/ /mnt/freebox cifs _netdev,rw,guest,iocharset=utf8 0 0
```
