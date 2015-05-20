# Fail2ban

For a number of reasons, an IP adresse may be wrongly blacklisted. If you wish to access your server through this specify IP you will need to unblock it.

## IP unblock

First, list all iptables rules with: `iptables -L --line-numbers` :

```bash
root@beudi:~# iptables -L --line-numbers
Chain INPUT (policy ACCEPT)
num  target     prot opt source               destination         
1    fail2ban-yunohost  tcp  --  anywhere             anywhere             multiport dports http,https
2    fail2ban-nginx  tcp  --  anywhere             anywhere             multiport dports http,https
3    fail2ban-dovecot  tcp  --  anywhere             anywhere             multiport dports smtp,ssmtp,imap2,imap3,imaps,pop3,pop3s
4    fail2ban-sasl  tcp  --  anywhere             anywhere             multiport dports smtp,ssmtp,imap2,imap3,imaps,pop3,pop3s
5    fail2ban-ssh  tcp  --  anywhere             anywhere             multiport dports ssh

Chain FORWARD (policy ACCEPT)
num  target     prot opt source               destination         

Chain OUTPUT (policy ACCEPT)
num  target     prot opt source               destination         

Chain fail2ban-dovecot (1 references)
num  target     prot opt source               destination         
1    RETURN     all  --  anywhere             anywhere            

Chain fail2ban-nginx (1 references)
num  target     prot opt source               destination         
1    RETURN     all  --  anywhere             anywhere            

Chain fail2ban-sasl (1 references)
num  target     prot opt source               destination         
1    RETURN     all  --  anywhere             anywhere            

Chain fail2ban-ssh (1 references)
num  target     prot opt source               destination         
1    RETURN     all  --  anywhere             anywhere            

Chain fail2ban-yunohost (1 references)
num  target     prot opt source               destination         
1    DROP       all  --  80.215.197.201       anywhere            
2    RETURN     all  --  anywhere             anywhere 
```

Here, Ip adress `80.215.197.201` is banned in the `fail2ban-yunohost` rule.
To unblock:

```bash
iptables -D rule_name entry_number
```

For intance:
```bash
iptables -D fail2ban-yunohost 1
```