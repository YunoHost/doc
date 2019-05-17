# Exchange files with your server using a graphical interface

This page explains how to exchange files (backup archives, music, pictures,
movies, ...) with your server using a graphical interface for the (S)FTP protocol. 
This is an alternative to using `scp` which can be deemed technical and cryptic, 
or using an app like Nextcloud.

[FileZilla](https://filezilla-project.org/) can be used for this. It is a free
software and is available for Windows, Linux and macOS.

## Download and install FileZilla

Get the client from the [download page](https://filezilla-project.org/download.php?type=client). It should automatically detect the version needed for your computer. Otherwise, follow the instructions to [install the client](https://wiki.filezilla-project.org/Client_Installation)

Install the program and run *Filezilla*.

## Configuration

1. Click the *Site Manager* icon in the upper left to begin.

   ![Main screen of Filezilla](images/filezilla_1.png)

2. Click **New Site** and give a name the server you will be using : *Family* here. Fill the settings as on the screenshot (replace the server adress with your own), and click on **Connect**. (N.B. : if you want to interact with the [custom webapp](https://github.com/YunoHost-Apps/my_webapp_ynh) files, you should use a different user than `admin`. Refer to the custom webapp documentation.)

   ![Site manager screen](images/filezilla_2.png)

3. You will get a warning as you connect for the first time to the server. *You can ignore it safely the first time you get it.*

   ![warning about the unknown fingerprint of the server](images/filezilla_3.png)

4. Filezilla is now asking the `admin` password to connect to your server.

   ![credential screen asking for the password](images/filezilla_4.png)

5. Once bookmarked, your server will be backup up and you will get this screen.

   ![View of the "site manager" with the newly server added](images/filezilla_5.png)

<div class="alert alert-success">
  <span class="glyphicon glyphicon-chevron-right"></span> You can now use your new bookmark to connect to the server
</div>

## Usage

1. Connect to the Site created previously. *Your passwork might be asked again*

   The left panel corresponds to your computer. The right panel corresponds to your remote Yunohost server. You can browse folders and drag-and-drop files between the two panels.

   ![view while connected to a remote server](images/filezilla_6.png)

2. In the right panel, you can browse to `/home/yunohost.backup/archives/` to find [backup archives](/backup).

   ![path where backups are located on Yunohost](images/filezilla_7.png)

<div class="alert alert-warning">
  <span class="glyphicon glyphicon-cloud-download"></span> Be sure to download both the `.tar.gz` and `.json` files.
</div>

![Copy backups from Yunohost to local computer](images/filezilla_8.png)

----

Sources

* [Official documentation](https://wiki.filezilla-project.org/FileZilla_Client_Tutorial_(en))
* [General tutorial about using FileZilla](https://www.rc.fas.harvard.edu/resources/documentation/sftp-file-transfer/)

## Alternatives to Filezilla

### Linux

From any recent Linux, you should be able to use the `file manager` to reach your server.

Nautilus from Gnome3 has features similar to FileZilla, out of the box.

* <https://help.gnome.org/users/gnome-help/stable/nautilus-connect.html.en>
* <https://www.techrepublic.com/article/how-to-use-linux-file-manager-to-connect-to-an-sftp-server/>

### Windows

* [WinSCP](https://winscp.net/) is also a nice candidate for Windows

### MacOS

* [Cyberduck](https://cyberduck.io/) is a free software available on MacOS
