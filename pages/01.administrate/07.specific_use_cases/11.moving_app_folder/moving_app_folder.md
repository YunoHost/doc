---
title: Moving an app folder to a different storage
template: docs
taxonomy:
    category: docs
routes:
  default: '/moving_app_folder'
---

Applications folder are (*usually*) located in `/var/www/$appname`

If an application folder is expected to get bigger because of the amount of data it contains, it might be relevant to move it to another storage (like an external hard drive).

Here's a summary of how to do this the application wordpress. Here, is is assumed that
[you already mounted the external hard-drive](/external_storage).

#### 1. Move the entire wordpress folder to an external hard drive

```shell
mv /var/www/wordpress /media/externalharddrive/
```

#### 2. Create a symbolic link 

So that programs looking for files in /var/www/wordpress will actually take them from the harddrive

```shell
ln -s /media/externalharddrive/wordpress /var/www/wordpress
```

#### 3. Tweak permissions (maybe?)

After this, note that you may need to tweak the permissions of `/media/externalharddrive` so that `www-data` (or the user corresponding to the app) is able to read through the folder... Something like :
 
```shell
chgrp www-data /media/externalharddrive
chmod g+rx /media/externalharddrive

```

(but it depends on your exact setup... Please update this doc page if you figure
out what to do exactly)

!!! If you want to do it with *NextCloud*, see [this Tutorial](/app_nextcloud).

