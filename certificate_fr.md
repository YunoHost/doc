# Certificat

Un certificat est utilisé pour garantir la confidentialité des échanges entre votre serveur et votre client.

YunoHost fournit par défaut un certificat **auto-signé**, ce qui veut dire que c’est votre serveur qui garantit la validité du certificat. C’est suffisant **pour un usage personnel**, car vous pouvez avoir confiance en votre serveur, en revanche cela posera problème si vous comptez ouvrir l’accès à votre serveur à des anonymes, par exemple pour héberger un site web.    
En effet, les utilisateurs devront passer par un écran de ce type :

<img src="/images/postinstall_error.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

Cet écran revient à demander **« Avez-vous confiance au serveur qui héberge ce site ? »**.    
Cela peut effrayer vos utilisateurs (à juste titre).

Pour éviter cette confusion, il est possible d’obtenir un certificat signé par
une autorité « connue » qui est **Let's Encrypt** et qui propose des certificats
gratuits. YunoHost permet désormais d'installer directement un tel certificat
depuis l'interface d'administration ou la ligne de commande.

### Ajout d’un certificat Let's Encrypt via l'interface d'administration

Rendez-vous dans la partie 'Domaine' de l'interface d'administration, puis dans
la section dédiée à votre domaine. Vous trouverez un bouton 'Certificat SSL'. 

![](./images/domain-certificate-button-fr.png)

Dans la section 'Certificat SSL', vous pourrez voir l'état actuel du certificat.
Si vous venez d'ajouter le domaine, il dispose d'un certificat auto-signé.

![](./images/certificate-before-LE-fr.png)

Si votre domaine est correctement configuré (c'est-à-dire que les DNS pointent
bien sur votre IP et que les ports sont correctement redirigés vers votre
serveur), il vous est alors possible de passer à un certificat Let's Encrypt via
le bouton vert. 

![](./images/certificate-after-LE-fr.png)

Une fois l'installation effectuée, vous pouvez vous rendre sur votre domaine via
votre navigateur, en HTTPS, pour vérifier que votre certificat est bien signé
par Let's Encrypt.

![](./images/certificate-signed-by-LE.png)
