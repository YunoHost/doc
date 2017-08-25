
# Post-Installation

L’étape appelée « **post-installation** » est en fait l’étape de configuration initiale de YunoHost. Il faut l’exécuter après l’**installation** du système en lui-même.

## Accès

Vous pouvez accéder à la post-installation graphique en entrant dans un navigateur web :
* l’adresse **IP locale de votre serveur** si celui-ci est connecté à votre réseau local (généralement `192.168.x.x`)
* l’adresse **IP publique de votre serveur** si celui-ci n’est pas connecté à votre réseau local.

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_web.png">

*<p class="text-muted">Aperçu de la post-installation Web</p>*

<br>

Vous pouvez aussi y accéder en entrant la commande `yunohost tools postinstall` directement sur le serveur ou en SSH.

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_cli.png">

*<p class="text-muted">Aperçu de la post-installation en ligne de commande</p>*

<br>

---

### Domaine principal

C’est le nom de domaine qui permettra l’accès à votre serveur ainsi qu’au portail d’authentification des utilisateurs. Il sera donc **visible par tout le monde**, choisissez-le en conséquence.

* YunoHost propose un service de DNS dynamique fournissant des noms de domaine de type *mondomaine.nohost.me* ou *mondomaine.noho.st*. Si vous ne possédez pas de nom de domaine et/ou que vous souhaitez profiter de ce service, choisissez un domaine se terminant en `.nohost.me` ou `.noho.st`. Le domaine sera automatiquement rattaché à votre serveur YunoHost, et vous n’aurez pas d’étape de configuration supplémentaire.

* Si en revanche vous maîtrisez la notion de **DNS**, vous pouvez utiliser votre propre nom de domaine. Dans ce cas, référez-vous à la page [yunohost.org/dns](/dns_fr) pour plus d’informations.

* Si vous n'avez pas de nom de domaine et que vous n'en voulez pas en *mondomaine.nohost.me* ou *mondomaine.noho.st*, vous pouvez utilisez un domaine local. Plus d'infos sur comment [accéder à son serveur depuis le réseau local](/dns_local_network_fr).


### Mot de passe d’administration

C’est le mot de passe qui vous permettra d’accéder à l’[interface d’administration](/admin_fr) de votre serveur. Vous pourrez également l’utiliser pour vous connecter à distance via **SSH**, ou en **SFTP** pour transférer des fichiers.

De manière générale, c’est la **clé d’entrée à votre système**, pensez donc à la **[choisir attentivement](http://www.commentcamarche.net/faq/8275-choisir-un-bon-mot-de-passe)**.

<br>

---

## En cas de problème

### Échec de la connection sécurisée après la **post-installation**

Si vous utilisez votre propre domaine et selon votre navigateur, vous pourriez vous retrouver bloqué à l'entrée de votre Yunohost tant que vous n'avez pas déployé un certificat valide. Grâce à Yunohost et [Let's Encrypt](https://letsencrypt.org/), c'est plutôt simple : exécutez simplement `yunohost domain cert-install` en ligne de commande pour émettre et installer votre certificat et _Voilà_. Rafraichissez votre navigateur et vous êtes paré.

---

## Et après ?

Une fois l’étape de post-installation exécutée, vérifiez que votre serveur est accessible en tapant le nom de domaine choisi précédemment dans votre navigateur web. Si celui-ci n’est pas accessible, quelques étapes de configurations supplémentaires sont sûrement nécessaires.

N'hésitez pas à [demander de l'aide](/help_fr) au besoin.

