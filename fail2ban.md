# Fail2ban

Fail2Ban is an intrusion prevention software that protects computer servers from brute-force attacks. It monitors some log files and will ban IP addresses that shows brute-force-like behavior.

In particular, Fail2ban monitors SSH connection attempts. After 5 failed login attempts on SSH, Fail2ban will ban the corresponding IP address from connecting through SSH for 10 minutes. If this IP is found to recidive several times, it might get ban for a week.

## Unban an IP

To unban an IP from fail2ban, you first need to access your server by some mean (e.g. from another IP by the one being banned).

Then look at fail2ban's log to identify in which jail the IP was put : 

```bash
$ tail /var/log/fail2ban.log
2019-01-07 16:24:47 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:49 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:51 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:54 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.actions [1837]: NOTICE  [sshd] Ban 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: NOTICE  [recidive] Ban 11.22.33.44
```

Here, the IP `11.22.33.44` was banned in the `sshd` and `recidive` jails.

Then unban the IP with the following commands : 

```bash
$ fail2ban-client set sshd unbanip 11.22.33.44
$ fail2ban-client set recidive unbanip 11.22.33.44
```

