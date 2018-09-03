# Free

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

Depuis le menu Ma freebox aller sur « Blocage SMTP sortant ».

Pour pouvoir envoyer des mails, passer le blocage en « inactif ».

#### Fonction NAS de la Freebox

Il faut installer le paquet `cifs-utils`
```bash
$ sudo apt install cifs-utils
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

Une ligne a ajouter à la fin du `/etc/fstab` :
```bash
//mafreebox.freebox.fr/Disque\040dur/ /home/monlogin/freebox cifs _netdev,guest,uid=monlogin,gid=users,iocharset=utf8 0 0
```

Le `_netdev` signale que c'est un périphérique réseau, afin que le système ne le monte que s'il a accès au réseau.  
`guest` est le mode d'identification à la Freebox : pour une connexion authentifié, placer vos identifiants dans un fichier sous la forme
```bash
username=your_user
password=your_pass
domain=FREEBOX
```  
et remplacer `guest` par `credentials=/path/to/file` (c'est aussi possible de spécifier directement `username=xx,password=xx` dans le fstab, mais déconseillé pour des raisons de sécurité)  
`uid` et `gid` sont pour les id user et group auxquels appartiendra le répertoire une fois monté. Par défault (sur la Freebox V5 en tout cas), ils se retrouvent avec les uid/gid de 4242.  
Il est aussi possible de mettre des droits particuliers avec les paramètres `file_mode=0777,dir_mode=0777`.
