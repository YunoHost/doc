# Diagnostic du bon fonctionnement de YunoHost

Si vous avez réussi l’[installation](/install_fr) de YunoHost et passé l’étape de [post-installation](/postinstall_fr), vous avez probablement un **serveur fonctionnel**.

### <small>1.</small> Essayer

Dans un navigateur web, essayez d’accéder à votre serveur grâce au nom de domaine que vous avez entré à l’étape de post-installation.

Par exemple : `http://mondomaine.org`

<div class="alert alert-warning">
Si vous avez optez pour un nom de domaine se terminant par <b>.nohost.me</b> ou <b>.noho.st</b>, vous devrez patienter cinq minutes avant que l’adresse soit atteignable.
</div>

---

#### Si ça ne fonctionne pas…

---

### <small>2.</small> Avez-vous bien configuré votre DNS ?

<div class="alert alert-info">
Cette étape n’est pas nécessaire si vous possédez un nom de domaine en <b>.nohost.me</b> ou un <b>.noho.st</b>
</div>

Rendez-vous sur https://www.whatsmydns.net/, entrez votre nom de domaine dans le champ prévu à cet effet et cliquez sur `Search`. Si vous ne voyez pas votre adresse IP, ou s’il y a des croix rouges par endroit, cela signifie que vous avez probablement mal configuré votre [DNS](/dns_fr).

---

### <small>3.</small> Est-ce que les ports de votre box/routeur sont ouverts ?

Si vos DNS sont bien configurés, et que le serveur est accessible localement, vous avez probablement des **ports bloqués** sur votre box/routeur ou non dirigés vers votre serveur.
Afin de le vérifier, essayez d’accéder à votre serveur avec un client extérieur au réseau local. Par exemple grâce à un autre accès Wi-Fi ou avec un smartphone en 3G/4G.

Si le serveur est inatteignable depuis l’extérieur du réseau local, le problème vient probablement de la configuration du routeur.

<div class="alert alert-info">
Essayez d’activer l’uPnP sur l’interface de configuration de votre box/routeur, et vérifiez que le serveur y est directement connecté en Ethernet.
<p>
Vous pouvez également rediriger les ports manuellement vers l’adresse IP locale de votre serveur grâce à l’interface de configuration de votre box/routeur.
</p>
</div>

---

### <small>4.</small> Est-ce que votre box/routeur fait du hairpinning ?

Si le serveur est accessible de l’extérieur, mais inatteignable via son nom de domaine dans votre réseau local, votre box/routeur ne fait probablement pas correctement de <a href="https://fr.wikipedia.org/wiki/Hairpinning" target="_blank">hairpinning</a>.

Voici un [tutoriel](dns_local_network_fr) pour pouvoir accéder à son serveur en réseau local et contourner le problème de hairpinning. Le tutoriel propose en première solution de mettre en place une redirection avec le DNS de la box et en seconde solution de modifier le fichier `hosts` des **clients** pour indiquer qu’il doit accéder au **serveur** via son IP locale. La première solution est préférable car il ne nécessite pas de modifier le fichier `hosts` sur chacun des clients du réseau local.

___

Sinon, retentez l’installation en prenant cette fois un nom de domaine en **.nohost.me** ou en **.noho.st**.
