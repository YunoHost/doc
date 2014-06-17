#Fail2ban

##Débloquer une IP

Tout d'abord on affiche le listing de toute les régles iptables avec la commande :


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

Il nous indique que l'ip 80.215.197.201 est banni dans la règle fail2ban-yunohost. Pour débloquer cette IP il faut faire la commande
iptables -D nom_de_la_regle numéro_de_l'entré

exemple :
iptables -D fail2ban-yunohost 1
