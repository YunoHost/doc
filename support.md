# Support

The YunoHost support is provided by the community members.

* The **best and fastest** way to get answers remains the community chatroom, accessible on the bottom-right corner of this page, or via an XMPP compatible instant messaging client (like [Pidgin](https://pidgin.im/)), at the following address:

    **[support@conference.yunohost.org](xmpp:support@conference.yunohost.org?join)**

---

* You may also want to visit the **discussion forum**:

    **[forum.yunohost.org](https://forum.yunohost.org/)**

---

* However, if you want to write specificaly to the Yunohost team, do not hesitate to send us an email. Please note that **we do not provide any support by email**.

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
