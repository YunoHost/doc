# Post-Installation

L'étape appelée « **post-installation** » est en fait l'étape de configuration initiale de YunoHost. Elle est exécutable après l'**installation** du système en lui-même.

**Attention** : Mal exécutée, la post-installation peut casser votre système. Pensez à ne pas l'interrompre inopinément.

Deux paramètres vous sont demandés lors de cette étape: le **nom de domaine principal** et le **mot de passe d'administration**.

### Domaine principal

C'est le premier nom de domaine qui permettra l'accès à votre serveur, mais également celui qui accueillera le **portail d'authentification** des utilisateurs. Il sera donc **visible par tout le monde**, choisissez-le en conséquence.

* Si vous ne possédez pas de nom de domaine ou que vous souhaitez profiter du service de DNS dynamique de YunoHost, optez pour un sous-domaine se terminant en **.nohost.me** ou **.noho.st**. Le domaine sera ainsi automatiquement rattaché à votre serveur YunoHost, et vous n'aurez pas d'étape de configuration supplémentaire.

* Si en revanche vous maîtrisez la notion de **DNS**, vous serez sûrement intéressés d'indiquer ici votre propre nom de domaine. Dans ce cas, référez-vous à la page [yunohost.org/dns](/dns_fr) pour plus d'informations.

### Mot de passe d'administration

C'est le mot de passe qui vous permettra d'accéder à l'[interface d'administration](/admin_fr) de votre serveur. Vous pourrez également l'utiliser pour vous connecter à distance via **SSH**, ou en **SFTP** pour transférer des fichier. 

De manière générale, c'est la **clé d'entrée à votre système**, pensez donc à la **[choisir attentivement](http://www.commentcamarche.net/faq/8275-choisir-un-bon-mot-de-passe)**.


### Et après ?

Une fois l'étape de post-installation exécutée, vérifiez que votre serveur est accessible. Si ce n'est pas le cas, quelques étapes de configurations supplémentaires sont sûrement nécessaires.

Rendez-nous visite sur le [salon de support](/support_fr) si vous avez besoin d'aide.