# YunoHost in VitualBox installieren

*Andere Installationsmoeglichkeiten sind **[hier](/install)** zu finden.*

## Vorraussetzungen

<img src="/images/virtualbox.png" width=200>

* Ein x86-Computer mit VirtualBox und genuegend Arbeitsspeicher, um eine virtuelle Maschine zu starten.
* Das letzte stabile **YunoHost ISO-Abbild**, welches du [hier](/images) herunterladen kannst.

<div class="alert alert-warning" markdown="1">
N.B. : YunoHost in einer virtuellen Maschine ist nur fuer Testzwecke gedacht. Um dauerhaft einen richtigen Server zu betreiben, 
solltest du dir einen dedizierten Server (alter Rechner, Raspberry Pi, ARM-Board) oder eienen vServer in der Cloud anschaffen.
</div>

---

## <small>1.</small> Eine virtuelle Maschine erstellen

<img src="/images/virtualbox_1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Wenn dein Computer nur 32bit unterstuetzt, solltest du sichergehen, dass du das 32bit ISO heruntergeladen hast.
* 256MB RAM ist das absolute Minimum um das System zu starten, 512MB (1GB, wenn es geht), solltest du allerdings mindestens zuweisen.
* 8GB Speicher wird vom System benoetigt. Fuer deine Apps solltest du allerdings mehr einplanen.

---

## <small>2.</small> Netzwerkeinstellungen

**NB:** Du musst diesen Schritt durchfuehren, ansonsten schlaegt die Installation fehl. 

Gehe nach **Settings** > **Network**:

<img src="/images/virtualbox_2.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Waehle `Bridged adapter` aus

* Waehle den Namen deines Interfaces:

    **wlan0**, wenn du WLAN verwendest, sonst **eth0**.

---

## <small>3.</small> Virtuelle Maschine starten

Starte die virtuelle Maschine

<img src="/images/virtualbox_2.1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

Du musst hier dein ISO-Abbild auswaehlen, danach solltest du den YunoHost-Bildschirm sehen.

<br>

Wenn du die Fehlermeldung "VT-x is not available" erhaelst, musst du vermutlich Virtualisierung in deinem BIOS aktivieren.

<br>

<img src="/images/virtualbox_3.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Wahele `Graphical install`

* Waehle deine Sprache, deinen Standort und dein Tastaturlayout und lass den Installer den Rest erledigen :-)

---

## <small>4.</small> Post-installation

Nach dem Neutstart solltest du vom System gefragt werden, ob du mit der post-installation fortfahren willst

<a class="btn btn-lg btn-default" href="/postinstall">Post-install documentation</a>
