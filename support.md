# Support

The YunoHost support is provided by the community members.

* The **best and fastest** way to get answers remains the community chatroom, accessible on the bottom-right corner of this page, or via an XMPP compatible instant messaging client (like [Pidgin](https://pidgin.im/)), at the following address:

    **[support@conference.yunohost.org](xmpp:support@conference.yunohost.org?join)**

---

* You may also want to visit the **Frequently Asked Question** discussion forum:

    **[ask.yunohost.org](https://ask.yunohost.org/)**

---

* However, if you want to write specificaly to the Yunohost team, do not hesitate to send us an email. Please note that **we do not provide any support by email**.

    **[yunohost@yunohost.org](mailto:yunohost@yunohost.org)**



<script type="text/javascript">
    $(".actions").css('opacity', 0);
    jQuery.ajaxSetup({cache: false});
    jQuery.getScript('https://'+ location.host +'/mini/javascripts/mini.js', function() {
        HOST_BOSH = 'https://'+ location.host +'/http-bind/';
        JappixMini.launch({
            connection: {
              domain: 'anonymous.yunohost.org'
            },

            application: {
              network: {
                autoconnect: false
              },

              interface: {
                showpane: true,
                animate: true
              },

              groupchat: {
                open: ['support@conference.yunohost.org']
              }
            }
        });
    });
</script>