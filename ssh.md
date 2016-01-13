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
Only the admin user can log in to yunohost ssh server.

Users yunohost created via the administration interface are managed by the LDAP directory and can not connect to ssh.

If you want another user admin to log on ssh, you must create it from the command line (through the admin user) as any user (adduser).

Rq: this user will not be usable since yunohost. It will have its own repertoire /home, his own linux group (see the principles of a Linux user and the various tutorials on the subject in any good documentation on the administration in Debian).

##### Security and SSH

See the dedicated page [Security & SSH] (/ security_fr)