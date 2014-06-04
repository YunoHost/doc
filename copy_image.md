# Copy an image to an SD card

## On Windows
* Download and install **[Win32 Disk Imager](http://sourceforge.net/projects/win32diskimager/)**
* Plug your SD card in
* Copy the `raspberry-latest.img` file to your SD card using Win32 Disk Imager.

## On GNU/Linux, BSD or Mac OS X
* Open a terminal
* Plug your SD card in
* Identify the device name by typing:

```bash
sudo fdisk -l
```

It should be `/dev/diskN`, where `N` is a number, or `/dev/sdX`, where `X` is a letter.

* Copy the image by typing:

```bash
sudo dd bs=1M if=/path/to/your/raspberry-latest.img of=/your/device/name
```

Do not forget to change `/path/to/your/raspberry-latest.img` and `/your/device/name` with the appropriate values.

The command may take a few minutes, then your SD card will be ready to use. **:-)**