---
title: Sécurité
template: docs
taxonomy:
    category: docs
routes:
  default: '/security'
---

YunoHost a été développé dans l’optique de fournir une sécurité maximale tout en restant accessible et facilement installable.

Tous les protocoles que YunoHost utilise sont **chiffrés**, les mots de passe ne sont pas stockés en clair, et par défaut chaque utilisateur n’accède qu’à son répertoire personnel.

Deux points sont néanmoins importants à noter :

* L’installation d’applications supplémentaires **augmente le nombre de failles** potentielles. Il est donc conseillé de se renseigner sur chacune d’elle **avant l’installation**, d’en comprendre le fonctionnement et juger ainsi l’impact que provoquerait une potentielle attaque. N’installez **que** les applications qui semblent importantes pour votre usage.

* Le fait que YunoHost soit un logiciel répandu augmente les chances de subir une attaque. Si une faille est découverte, elle peut potentiellement **toucher toutes les instances YunoHost** à un temps donné. Nous nous efforçons de corriger ces failles le plus rapidement possible, pensez donc à **mettre à jour régulièrement** votre système.

!!!! Si vous avez besoin de conseil, n’hésitez pas à [nous demander](/help).

!! [fa=shield /] Pour discuter d'une faille de sécurité, contactez l'[équipe sécurité de YunoHost](/security_team).

---

## Améliorer la sécurité

Si votre serveur YunoHost est dans un environnement de production critique ou que vous souhaitez améliorer sa sécurité, il est bon de suivre quelques bonnes pratiques.

! **Attention :** l’application des conseils suivants nécessite une connaissance avancée du fonctionnement et de l’administration d’un serveur. Pensez à vous renseigner avant de procéder à cette mise en place.

!!!! **Astuce :** Ne fermez jamais votre connexion SSH initiale sans avoir vérifié que vos modifications fonctionnent. Testez vos modifications dans une nouvelle fenêtre ou terminal. Ainsi, vous pourrez défaire vos modifications sans vous retrouver bloqués.

### Authentification SSH par clé

Voici un [tutoriel plus détaillé](http://doc.ubuntu-fr.org/ssh#authentification_par_un_systeme_de_cles_publiqueprivee).

Par défaut, l’authentification SSH se fait avec le mot de passe d’administration. Il est conseillé de désactiver ce type d’authentification et de le remplacer par un mécanisme de clé de chiffrement.

**Sur votre ordinateur de bureau :**

```bash
ssh-keygen
ssh-copy-id -i ~/.ssh/id_rsa.pub <nom_utilisateur@votre.domaine.tld>
```

!!! Si vous avez des problèmes de permissions, donnez à `nom_utilisateur` la possession du dossier `~/.ssh` avec `chown`. Attention, pour des raisons de sécurité, ce dossier doit être en mode 700 !

!!! Si vous êtes sur Ubuntu 16.04 vous devez faire  `ssh-add` pour initialiser l'agent SSH.

Entrez le mot de passe d’administration et votre clé publique devrait être copiée sur votre serveur.

**Sur votre serveur**, l'édition du fichier de configuration SSH pour désactiver l’authentification par mot de passe est gérée par un paramètre système :

```bash
sudo yunohost settings set security.ssh.password_authentication -v no
```

---

### Modifier le port SSH

Pour éviter des tentatives de connexion SSH par des robots qui scannent tout Internet pour tenter des connexions SSH avec tout serveur accessible, on peut modifier le port SSH.
C'est géré par un paramètre système, qui se charge de configurer les services SSH et Fail2Ban.

```bash
sudo yunohost settings set security.ssh.port -v <votre_numero_de_port_ssh>
```

**Lors de la prochaine connexion SSH**, vous devrez ajouter le paramètre `-p` suivi du port SSH.

**Exemple**:

```bash
ssh -p <votre_numero_de_port_ssh> admin@<votre_serveur_yunohost>
```

---

### Durcir la sécurité de la configuration des services

La configuration TLS par défaut des services tend à offrir une bonne compatibilité avec les vieux appareils. Vous pouvez régler cette politique pour les services SSH et NGINX. Par défaut, la configuration du NGINX suit la [recommandation de compatibilité intermédiaire](https://wiki.mozilla.org/Security/Server_Side_TLS#Intermediate_compatibility_.28default.29) de Mozilla. Vous pouvez choisir de passer à la configuration « moderne » qui utilise des recommandations de sécurité plus récentes, mais qui diminue la compatibilité, ce qui peut poser un problème pour vos utilisateurs et visiteurs qui utilisent de vieux appareils. Plus de détails peuvent être trouvés sur [cette page](https://wiki.mozilla.org/Security/Server_Side_TLS#Modern_compatibility).

Changer le niveau de compatibilité n'est pas définitif et il est possible de rechanger le paramètre si vous concluez qu'il faut revenir en arrière.

**Sur votre serveur**, modifiez la politique pour NGINX :
```bash
sudo yunohost settings set security.nginx.compatibility -v modern
```

**Sur votre serveur**, modifiez la politique pour SSH :
```bash
sudo yunohost settings set security.ssh.compatibility -v modern
```

### Désactivation de l’API YunoHost

YunoHost est administrable via une **API HTTP**, servie sur le port 6787 par défaut (seulement sur `localhost`).
Elle permet d’administrer une grande partie de votre serveur, et peut donc être utilisée à des **fins malveillantes**.
La meilleure chose à faire si vous êtes habitués à la ligne de commande est de désactiver le service `yunohost-api`, et **utiliser la [ligne de commande](/commandline)** en SSH.

! Ceci va désactiver à la fois l'API et l'interface d'administration web de YunoHost qui en dépend.
! Ne continuez que si vous êtes à l'aise avec la ligne de commande.

```bash
sudo systemctl disable yunohost-api
sudo systemctl stop yunohost-api
```
