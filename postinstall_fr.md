# Post-Installation

L'étape appelée « **post-installation** » est en fait l'étape de configuration initiale de YunoHost. Elle est exécutable après l'**installation** du système en lui-même.

/!\ **Attention** : Mal exécutée, la post-installation peut casser votre système. Pensez à ne pas l'interrompre inopinément. /!\

Deux paramètres vous sont demandés lors de cette étape: le **mot de passe d'administration** et le **nom de domaine principal**

### Mot de passe d'administration

C'est le mot de passe qui vous permettra d'accéder à l'[interface d'administration](/admin_fr) de votre serveur. Vous pourrez également l'utiliser pour vous connecter à distance via **SSH**, ou en **SFTP** pour transférer des fichier. 

De manière générale, c'est la **clé d'entrée à votre système**, pensez donc à le **[choisir attentivement](http://www.commentcamarche.net/faq/8275-choisir-un-bon-mot-de-passe)**.


### Domaine principal

C'est le premier nom de domaine qui permettra l'accès à votre serveur, mais également celui qui accueillera le **portail d'authentification** des utilisateurs. Il sera donc **visible par tout le monde**, choisissez-le en conséquence.

*Si vous maîtrisez la notion de **DNS**, vous serez sûrement intéressés de configurer ici votre propre nom de domaine. Référez-vous donc à la page [yunohost.org/dns](/dns) pour plus d'informations*