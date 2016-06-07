# Support - Entraide

L’entraide autour de YunoHost est assurée par la communauté.

* Le moyen le plus **efficace et rapide** d’obtenir des réponses reste le salon de discussion instantané, accessible en bas à droite de cette page, ou via n’importe quel client de messagerie **compatible XMPP** (tel que [Pidgin](https://pidgin.im/)) à l’adresse suivante :

    **[support@conference.yunohost.org](xmpp:support@conference.yunohost.org?join)**

---

* Vous pouvez également vous renseigner et poser vos questions sur **le forum** (en anglais de préférence) :

    **[forum.yunohost.org](https://forum.yunohost.org/)**

---

* Enfin, si vous souhaitez vous adresser spécifiquement à l’équipe YunoHost, n’hésitez pas à nous envoyer un mail. **Attention, nous n’assurons aucun support par email**.

    **[yunohost@yunohost.org](mailto:yunohost@yunohost.org)**


<script type="text/javascript" src="/jappix/javascripts/mini.min.js"></script>
<script type="text/javascript">
    // Jappix mini chat
    $(".actions").css('opacity', 0);
    jQuery.ajaxSetup({cache: false});

    var ADS_ENABLE = 'off';
    var JAPPIX_STATIC = '/jappix/';
    var HOST_BOSH = 'https://im.yunohost.org/http-bind/';
    var ANONYMOUS = 'on';
     JappixMini.launch({
        connection: {
           domain: "anonymous.yunohost.org",
        },
        application: {
           network: {
              autoconnect: false,
           },
           interface: {
              showpane: false,
              animate: false,
           },
           groupchat: {
              open: ['support@conference.yunohost.org'],
              suggest: ['dev@conference.yunohost.org']
           }
        },
     });
</script>
