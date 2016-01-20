#SSH
**SSH** permit you to command remotly your sever by command line interface (CLI).

##### To connect to your server:

`ssh admin@my-server.org`

Then, you need to enter your administrator password created at [post-installation step](postinstall).

##### Connect to a different port than the default port 22
Edit the line`Port 22` from file `/etc/ssh/sshd_config` then connect:
```bash
ssh -p <port> admin@my-server.org
```

##### Which users?
Only the admin user can log in to YunoHost ssh server.

YunoHost's users created via the administration interface are managed by the LDAP directory and can not connect via ssh.

If you want another admin user to log in via ssh, you must create it from the command line (through the admin user) as any user (with `adduser` command).

Note: this user will not be usable since yunohost. It will have its own folder `/home`, his own Unix group (see the principles of a Unix user and the various tutorials on the subject in any good documentation on the administration in Debian).

##### Security and SSH
See the dedicated page [Security & SSH](security_en)