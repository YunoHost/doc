# Flashing an SD card

Now that you download the YunoHost image, you have to copy its content to an SD
card. This step is also sometimes called 'flashing' the SD card.

<div class="alert alert-warning" markdown="1">
In the context of self-hosting, it is recommended that your SD card be at least
8 GB (to have a reasonable space available for the system and a few data) and at 
least Class 10 (to ensure reasonable performances).
</div>

<img src="/images/sdcard.jpg" width=150><img src="https://yunohost.org/images/micro-sd-card.jpg">

### With Etcher

Download <a href="https://etcher.io/" target="_blank">Etcher</a> for your
operating system and install it.

<img src="/images/etcher.gif">

Plug your SD card, select your YunoHost image and click "Flash"

### With `dd`

If you are on Linux / Mac and know your way around command line, you may also
flash your SD card with `dd`. You can identify which device corresponds to your
SD card with `fdisk -l` or `lsblk`. Assuming your SD card is `/dev/mmcblk0` (be
careful !!), you may run :

```bash
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```

## Expand the root partition <small>(optional)</small>

<div class="alert alert-warning" markdown="1">
This step is optional as it should be performed automatically during the first
boot on recent images.
</div>

By default, the root partition of your SD card is very small.    
You can resize it by using software like `resize2fs` (command-line) or `gparted`
(graphical).

<img src="/images/gparted.jpg" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<p class="text-muted">Preview of the Gparted window</p>
