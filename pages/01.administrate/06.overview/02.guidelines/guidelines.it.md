---
title: Avvisi e linee guida
template: docs
taxonomy:
    category: docs
routes:
  default: '/guidelines'
---

Questa pagina elenca qualche consiglio e delle linee guida che tutti gli amministratori di YunoHost dovrebbero conoscere per prendersi cura del proprio server :).

## Non rompere YunoHost

In altre parole: il tuo server può essere un "server in produzione" (destinato a funzionare), oppure un server di test che ti permette di sperimentare.

Se il tuo obiettivo è avere un server in produzione:
- sii consapevole che i server sono sistemi fragili: sii prudente, metodico e paziente;
- limita gli esperimenti e le personalizzazioni (per le istanze il file config)
- non installare dozzine di installazioni solo per vedere come sono;
- usa le applicazioni non ufficiali con prudenza, e evita di usare quelle 'in progress', 'not working' o che hanno un livello 0;
- se qualcosa dovesse rompersi, pensate due volte prima di cercare di riparare da soli se non sapete quello che state facendo. <small>(Per esempio, non tentate di ricreare da soli l'utente admin solo perché sembra che sia misteriosamente scomparso...)</small>

## Keep it simple !

YunoHost è progettato per funzionare in casi d'uso generici e semplici. Deviare da queste condizioni renderà le cose più difficili e avrai bisogno di conoscenze tecniche perché tutto funzioni. Per esempio,
- non provare ad eseguire YunoHost in un contesto dove non puoi controllare le porte 80 e 443 (o senza Internet del tutto);
- non provare a hostare cinque server dietro la stessa connessione Internet se non sei un utente esperto;
- non cadere nei capricci dei nerd che vogliono sostituire NGINX con Apache (o farli girare tutti e due insieme);
- non cercare di usare certificati SSL personalizzati se non ne hai veramente bisogno;
- ...

Tenete le cose più semplici possibili!

## Non reinstallate tutti i giorni

Alcune persone hanno la tendenza a cadere nella "spirale di reinstallazione" - dove ogni volta che qualcosa nel server si rompe e non è semplice capire come ripararlo, o perché il server diventa "sporco", l'amministratore decide di reinstallare tutto il server da zero perché sembra una soluzione "facile" e veloce per rimettere le cose a posto.

Non farlo. La reinstallazione è un'operazione difficile e non è un buona strategia a lungo termine per risolvere i problemi. Ti stancherai e non imparerai niente. Dimentica il sogno di avere un server "pulito". Nella vita reale il server sarà sempre "sporco". In più, dovrai imparare (progressivamente) a risolvere i problemi che incontrerai. [Chiedi aiuto](/help) con i dettagli dei sintomi, quello che hai provato a fare e cosa è successo e correggi i problemi. Con il tempo, avrai un controllo migliore sul tuo server piuttosto che reinstallare alla cieca tutte le volte.

## Faites des sauvegardes

Si vous hébergez des services et des données qui sont importants pour vos utilisateurs, il est important que vous mettiez en place une politique de sauvegarde. Les sauvegardes peuvent être facilement créées à partir de l'interface d'administration web - bien qu'elles ne puissent actuellement pas être téléchargées à partir de celle-ci (mais elles peuvent être téléchargées par d'autres moyens). Vous devez effectuer régulièrement des sauvegardes et les conserver dans un endroit sûr et physiquement différent de votre serveur. Plus d'infos dans [la documentation des sauvegardes](/backup).

## Lisez les emails envoyés à root

En tant qu'administrateur, vous devriez configurer un client de messagerie pour vérifier les e-mails envoyés à `root@your.domain.tld` (qui doit être un alias pour le premier utilisateur que vous avez ajouté) ou les transférer à une autre adresse que vous vérifiez activement. Ces courriels peuvent contenir des informations sur ce qui se passe sur votre serveur, comme les tâches périodiques automatisées.

## YunoHost est un logiciel gratuit, maintenu par des bénévoles.

Enfin, gardez à l'esprit que YunoHost est un logiciel libre maintenu par des volontaires - et que le but de YunoHost (démocratiser l'auto-hébergement) n'est pas simple ! Le logiciel est fourni sans aucune garantie. L'équipe de bénévoles fait de son mieux pour maintenir et fournir la meilleure expérience possible - pourtant les fonctionnalités, les applications et YunoHost dans son ensemble sont loin d'être parfaits et vous ferez face tôt ou tard à de petit ou gros problèmes. Lorsque cela se produit, venez gentiment [demander de l'aide sur le chat ou le forum, ou signaler le problème](/help) :) !

Si vous aimez YunoHost et que vous voulez que le projet soit maintenu en vie et progresse, n'hésitez pas à laisser une note de remerciement et à [faire un don](https://liberapay.com/YunoHost) au projet et à en parler autour de vous !

Pour finir, puisque YunoHost est un projet de logiciel libre, vous êtes légitime et bienvenu pour [venir contribuer](/contribute) au projet, que ce soit sur les aspects techniques (c.-à-d. code) et moins techniques (comme par exemple contribuer à cette documentation ;)) !
