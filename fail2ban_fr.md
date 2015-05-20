# Fail2ban

Pour diverses raisons, il peut arriver qu’une adresse IP ait été blacklistée. Si vous souhaitez accéder à votre serveur depuis cette IP, il faudra la débloquer.

## Débloquer une IP

Tout d’abord on affiche le listing de toutes les règles iptables avec la commande `iptables -L --line-numbers` :

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

Il nous indique que l’IP `80.215.197.201` est bannie dans la règle `fail2ban-yunohost`.    
Pour la débloquer :

```bash
iptables -D nom_de_la_regle numéro_de_l_entrée
```

Par exemple :
```bash
iptables -D fail2ban-yunohost 1
```
