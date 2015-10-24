# Copy an image to an SD card

Now that you have the YunoHost image, you have to copy its content to an SD card.    
The process differs regarding your operating system.

<img src="https://yunohost.org/images/sdcard.jpg" width=150><img src="https://yunohost.org/images/micro-sd-card.jpg">

## On Windows

* Download and install **[Win32 Disk Imager](http://sourceforge.net/projects/win32diskimager/)**
* Plug your SD card in
* Copy the `.img` file to your SD card using Win32 Disk Imager.

<img src="https://yunohost.org/images/win32diskimager.png">

## On GNU/Linux, BSD or Mac OS

* Open a terminal
* Plug your SD card in
* Identify the device name by typing:

```bash
sudo fdisk -l
```

It should be `/dev/diskN`, where `N` is a number, or `/dev/sdX`, where `X` is a letter.

Carefull to not put the digit `N` cause it will create an [non-functional SD card](https://raspberrypi.stackexchange.com/questions/11880/sd-card-doesnt-works-after-dd).

* Copy the image by typing:

```bash
sudo dd if=/path/to/your/.img of=/your/device/name
```

<span class="glyphicon glyphicon-warning-sign"></span> Do not forget to change `/path/to/your/.img` and `/your/device/name` with the appropriate values.

The command may take a few minutes, then your SD card will be ready to use. **:-)**

## Expand the root partition <small>(optional)</small>

By default, the root partition of your SD card is very small.    
You can resize it by using software like `resize2fs` (command-line) or `gparted` (graphical).

<img src="https://yunohost.org/images/gparted.jpg" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<p class="text-muted">Preview of the Gparted window</p>
