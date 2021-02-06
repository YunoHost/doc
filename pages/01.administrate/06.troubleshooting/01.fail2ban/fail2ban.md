---
title: Fail2Ban
template: docs
taxonomy:
    category: docs
routes:
  default: '/fail2ban'
---

**Fail2Ban** is an intrusion prevention software that protects computer servers against brute-force attacks. It monitors certain logs and will ban IP addresses that show brute-force-like behavior.

In particular, **Fail2Ban** monitors `SSH` connection attempts. After 5 failed SSH connection attempts, Fail2Ban will ban the IP address from connecting via SSH for 10 minutes. If this address fails several times, it might get banned for a week.

## Unban an IP address

To unblock an IP address, you must first access your server by some means (for example from another IP address or from another internet connection than the banned one).

Then, look at the **Fail2Ban’s log** to identify in which `jail` the IP address has been banned:

```bash
sudo tail /var/log/fail2ban.log
2019-01-07 16:24:47 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:49 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:51 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:54 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.actions [1837]: NOTICE  [sshd] Ban 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: NOTICE  [recidive] Ban 11.22.33.44
```

Here, the `11.22.33.44` IP address has been banned in the `sshd` and `recidive` jails.

Then deban the IP address with the following commands:

```bash
sudo fail2ban-client set sshd unbanip 11.22.33.44
sudo fail2ban-client set recidive unbanip 11.22.33.44
```

## Whitelist an IP address

If you don’t want a "legitimate" IP address to be blocked by **YunoHost** anymore, then you have to fill it in the whitelist of the `jail` configuration file.

When updating the **Fail2Ban** software, the original `/etc/fail2ban/jail.conf` file is overwritten. So it is on a new dedicated file that we will store the changes. They will thus be preserved over time.

1. Start by creating the new jail configuration file which will be called `yunohost-whitelist.conf`:

    ```bash
    sudo touch /etc/fail2ban/jail.d/yunohost-whitelist.conf
    ```

2. Edit this new file with your favorite editor:

    ```bash
    sudo nano /etc/fail2ban/jail.d/yunohost-whitelist.conf
    ```

3. Paste the following content into the file and adapt the IP address `XXX.XXX.XXX.XXX`:

    ```bash
    [DEFAULT]

    ignoreip = 127.0.0.1/8 XXX.XXX.XXX.XXX #<= the IP address (you can put more than one, separated by a space) that you want to whitelist
    ```

4. Save the file and reload the Fail2Ban configuration:

    ```bash
    sudo fail2ban-client reload
    ```

Congratulations, no more risks of banning yourself from your own YunoHost server!
