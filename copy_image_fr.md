# Flasher une carte SD

Maintenant que vous avez téléchargé l'image de YunoHost, il vous faut copier son
contenu sur une carte SD. Cette étape est aussi souvent appelé 'flasher' la
carte SD.

<div class="alert alert-warning" markdown="1">
Dans le contexte de l'auto-hébergement, il est recommandé que votre carte SD
fasse au moins 8 Go (pour disposer d'un espace raisonnable pour le système et
quelques données) et soit au moins certifiée classe 10 (pour avoir des
performances raisonnables).
</div>

<img src="/images/sdcard.jpg" width=150><img src="https://yunohost.org/images/micro-sd-card.jpg">

### Avec Etcher

Télécharger <a href="https://etcher.io/" target="_blank">Etcher</a> pour votre
système d'exploitation, et installez-le.

<img src="/images/etcher.gif">

Connectez votre carte SD, sélectionnez votre image YunoHost, puis cliquez sur
'Flash'.

### Avec `dd`

Si vous êtes sous Linux / Mac et que vous êtes à l'aise avec la ligne de
commande, vous pouvez aussi flasher votre carte SD avec `dd`. Commencez par
identifier le périphérique correspondant à votre carte SD avec `fdisk -l` ou
`lsblk`. En supposant que votre carte SD soit `/dev/mmcblk0` (faites attention
!), vous pouvez lancer :

```bash
dd if=/chemin/vers/yunohost.img of=/dev/mmcblk0
```

## Étendre la partition root <small>(optionnel)</small>

<div class="alert alert-warning" markdown="1">
Cette étape est optionnelle car elle est normalement effectuée automatiquement
par le système lors du premier démarrage sur les images récentes.
</div>

Par défaut, la partition root installée sur votre carte SD avec la commande `dd`
est très petite.   Vous pouvez la redimensionner avec un logiciel comme
`resize2fs` (ligne de commande) ou `Gparted` (interface graphique) en étendant
la partition ext4 au maximum de façon à utiliser tout l’espace non alloué.

<img src="/images/gparted.jpg" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<p class="text-muted">Aperçu de l’interface de Gparted</p>
