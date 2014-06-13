# Diagnostic du bon fonctionnement de YunoHost

Si vous avez réussit l’[installation](/install_fr) de YunoHost et passé l’étape de la [post-installation](/postinstall_fr), vous avez probablement un **serveur fonctionnel**.

### <small>1.</small> Essaye

Dans ton navigateur web, essaye d’accèder à ton serveur grâce au nom de domaine que tu as entré à l’étape de la post-installation.

Par exemple : `http://mondomaine.com`

<div class="alert alert-warning">
Si tu as a pris un nom de domaine en <b>.nohost.me</b> ou un <b>.noho.st</b>, tu devra attendre 5 minutes avant que ton adresse soit atteignable.
</div>

---

#### Si ça ne fonctionne pas…

---

### <small>2.</small> As-tu bien configuré ton DNS ?

<div class="alert alert-info">
Cette étape n’est pas nécessaire si tu as un nom de domaine en <b>.nohost.me</b> ou un <b>.noho.st</b>
</div>

Vas sur https://www.whatsmydns.net/, entre ton nom de domaine dans le champ et clique sur `Search`. Si tu ne vois pas ton adresse IP, ou s’il y a des croix rouge partout, cela signifie que tu as probablement mal configuré ton [DNS](/dns_fr).

---

### <small>3.</small> Est-ce que les ports de ton router sont ouverts ?

Si ton DNS est bien configuré, et que ton serveur est accessible localement, tu doit avoir des **ports bloqués** ou non dirigés vers ton serveur.
Afin de le vérifier, essaye d’accéder à ton serveur avec un client extérieur à ton réseau local. Par exemple grâce à un autre accès Wi-Fi ou avec un smartphone en 3G/4G.

Si le serveur est inatteignable de l’extérieur de ton réseau local, le problème vient probablement de la configuration de ton routeur.

<div class="alert alert-info">
Essaye d’activer l’uPnP sur l’interface de configuration de ton routeur, et vérifie qu’il est directement connecté à ton serveur en Ethernet.
<p>
Tu peux aussi rediriger les ports manuellement vers l’adresse IP locale de ton serveur grâce à l’interface de configuration de ton routeur.
</p>
</div>

---

### <small>4.</small> Est-ce que ton routeur fait du hairpinning ?

Si le serveur est accessible de l’extérieur de ton réseau local, mais inatteignable avec son nom de domaine dans ton réseau local, ton routeur n’a probablement pas de <a href="http://en.wikipedia.org/wiki/Hairpinning" target="_blank">hairpinning</a>.

Tu peux éviter cela simplement. Si tu sait comment le faire, configure le fichier  `/etc/hosts` de ton client local pour accéder à ton serveur avec son IP locale. Sinon, essaye l’installation avec un nom de domaine en **.nohost.me** ou en **.noho.st**.