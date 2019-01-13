# Workaround to retrieve the backups

As said on the [backup](/backup), there is a limitation to manage backups files with `admin` user

## What is the problem

Why you cannot access to `/home/yunohost.backup/archives/` folder

```bash
root@example:~# tree /home/yunohost.backup/
/home/yunohost.backup/
├── archives                          ## <== Only `root` can access
│   ├── 20180611-192934.info.json
│   ├── 20180611-192934.tar.gz
│   ├── 20180915-212428.info.json
│   ├── 20180915-212428.tar.gz
│   ├── wallabag2-pre-upgrade1.info.json
│   └── wallabag2-pre-upgrade1.tar.gz
└── tmp                               ## <== `admin` can write here
    ├── 20180915-212428.info.json
    └── 20180915-212428.tar.gz

2 directories, 8 files
root@example:~#
```

Until it is sorted, you have to work with `/home/yunohost.backup/tmp` and then copy/move to `home/yunohost.backup/archives` so Yunohost backup system can do it's work.

## Download backups

You will need to connect by `SSH` to copy the backups to a location that can be acceded by the `admin` user

### SSH connection

1. Connect by following [SSH instructions](/ssh#after-installing-yunohost)

    ```bash
    ssh admin@192.168.1.68
    admin@192.168.1.68's password:

    The programs included with the Debian GNU/Linux system are free software;
    the exact distribution terms for each program are described in the
    individual files in /usr/share/doc/*/copyright.

    Debian GNU/Linux comes with ABSOLUTELY NO WARRANTY, to the extent
    permitted by applicable law.
    Last login: Sun Jan  6 19:30:47 2019 from 192.168.1.51
    ```

2. Verify if `admin` can access backups

    ```bash
    admin@example:~$ ls -l /home/yunohost.backup/archives/
    ls: cannot open directory /home/yunohost.backup/archives/: Permission denied
    ```

3. Run the same command again with `sudo` to list backups

    ```bash
    admin@example:~$ sudo ls -l /home/yunohost.backup/archives/
    total 1168888
    -rw------- 1 admin 1007      3427 Jun 17  2018 20180611-192934.info.json
    -rw------- 1 admin 1007 592976408 Jun 17  2018 20180611-192934.tar.gz
    -rw-r--r-- 1 root  root      1436 Sep 15 21:25 20180915-212428.info.json
    -rw-r--r-- 1 root  root 164731292 Sep 15 21:25 20180915-212428.tar.gz
    -rw-r--r-- 1 root  root       331 Dec 31 12:10 dokuwiki--2-pre-upgrade1.info.json
    -rw-r--r-- 1 root  root     23800 Dec 31 12:10 dokuwiki--2-pre-upgrade1.tar.gz
    -rw-r--r-- 1 root  root       348 Dec 31 12:10 dokuwiki--3-pre-upgrade2.info.json
    -rw-r--r-- 1 root  root   3710604 Dec 31 12:10 dokuwiki--3-pre-upgrade2.tar.gz
    -rw-r--r-- 1 root  root       344 Dec 31 12:08 dokuwiki-pre-upgrade2.info.json
    -rw-r--r-- 1 root  root 163209554 Dec 31 12:08 dokuwiki-pre-upgrade2.tar.gz
    admin@example:~$
    ```

    The most recent backup in this example is from `20180915-212428`. It is going to be copied to the right location

4. Login as superuser `root`

    ```bash
    admin@example:~$ sudo -i
    ```

5. Copy the previous backups files to `/home/yunohost.backup/tmp`

    ```bash
    root@example:~# cd /home/yunohost.backup
    root@example:~# sudo cp -a archives/<archivename>* tmp
    ```

6. Verify that you have two files `<archivename>`.info.json and `<archivename>`.tar.gz in `/home/yunohost.backup/tmp`

    ```bash
    root@example:~# ls /home/yunohost.backup/tmp
    20180915-212428.info.json  20180915-212428.tar.gz
    ```

7. Quit SSH connection

    ```bash
    root@example:~# exit
    admin@example:~$ exit
    ```

## Upload backups

If you want to restore backup, the steps are quite similar to above.

1. Connect by following [SSH instructions](/ssh#after-installing-yunohost)

2. Login as superuser `root`

    ```bash
    admin@example:~$ sudo -i
    ```

3. Move your backup `<archivename>` to `/home/yunohost.backup/archives`

    ```bash
    root@example:~# cd /home/yunohost.backup
    root@example:~# mv tmp/`<archivename>*` archives/
    ```
    Yunohost backup mechanism can work do its work.

4. Verify that you have two files `<archivename>`.info.json and `<archivename>`.tar.gz in `/home/yunohost.backup/archives`

    ```bash
    root@example:~# ls /home/yunohost.backup/archives
    20180915-212428.info.json  20180915-212428.tar.gz
    ```

5. Quit SSH connection

    ```bash
    root@example:~# exit
    admin@example:~$ exit
    ```

## Back to work

Now that the files are in the correct folders, you can continue your work with the [backups](backup).