# Plug and boot your server up

* Plug your server in wired Ethernet, or configure the wifi connection as explained [here](https://www.raspberrypi.org/documentation/configuration/wireless/wireless-cli.md). You can also mount the second partition of the SD card and edit the wpa-supplicant.conf file prior to boot the card for the first time - on Windows you can use [Paragon ExtFS](https://www.paragon-software.com/home/extfs-windows/), don't forget to unmount everytime for changes to take effect.

* Optional : You can **connect a screen** if you want to see how boot is going, and a keyboard if you want to have a **command-line access** to your server.

* Power up the server, wait for the first reboot to happen, and then wait until you see a big squared `Y` :

<br>

<div class="text-center"><img src="/images/boot_screen.png">

*Write down the `IP address` field visible on the screen: It is your server's **local IP address**.*

</div>
Don't worry if you don't have a screen ! You can still find you IP address in the next step.
