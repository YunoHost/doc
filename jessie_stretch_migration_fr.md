# Migrer vers Stretch

L'objectif cette page est de décrire le processus de migration d'une instance en YunoHost 2.7.x (tournant sous Debian Jessie/8.x) vers YunoHost 3.0 (tournant sous Debian Stretch/9.x)

## Notes importantes

- L'équipe de YunoHost a fait de son mieux pour que cette migration se passe autant en douceur que possible. Elle a été testée durant plusieurs mois et sur plusieurs types d'installations.

- Néanmoins, vous devez être conscient qu'il s'agit d'une opération délicate. L'administration système est un sujet compliqué et couvrir tous les cas particuliers n'est pas chose aisée. En conséquence, si vous hébergez des données et des systèmes critiques, [faites des sauvegardes](/backup). Et dans tous les cas, soyez patients et attentifs durant la migration.

- Cependant, ne vous précipitez pas non plus à vouloir faire une réinstallation de votre système. Une attitude qui revient régulièrement est de vouloir réinstaller son système à la moindre complication. Pourtant, réinstaller peut aussi s'avérer compliqué. À la place, si vous rencontrez des problèmes, nous vous encourageons à investiguer, chercher à comprendre et trouver de l'aide, plutôt que de se précipiter à vouloir réinstaller simplement parce que cela semble plus simple.

- Si vous ou vos utilisateurs utilisez des clients emails externes (typiquement Thunderbird ou K9Mail) : le port SMTP a changé. Il s'agissait auparavant du port 465 (avec SSL/TLS) qui a été remplacé par 587 (STARTTLS). Voir [cette page de doc dédiée à la configuration des clients mails](/email_configure_client). La configuration des webmails comme Rainloop doit également être mise à jour, en passant par l'interface d'administration dédiée.

- Pour les utilisateurs avancés : si vous avez des scripts personnels pour faire des backups, certains changements cassent (de façon mineure) la rétrocompatibilité de la ligne de commande. Les options dépréciées `--hooks`/`--ignore-hooks` ont été enlevées, ainsi que `--ignore-apps`, `--ignore-system`. Pour rendre les choses plus intuitives, `yunohost backup create --apps wordpress` (par exemple) créera uniquement un backup de wordpress, c.-à-d. pas besoin d'ajouter `--ignore-system` pour ne pas backuper le système.

## Procédure de migration

#### Depuis la webadmin

Après avoir mis à jour vers la version 2.7.14, allez dans Outils > Migrations pour accéder à l'interface de migration. Il vous faudra ensuite lire l'avertissement attentivement et l'accepter pour lancer la migration. Les logs seront affichés dans la barre de message en haut (vous pouvez approcher la souris dessus pour voir l'historique en entier).

#### Depuis la ligne de commande

Après avoir mis à jour vers la version 2.7.14, lancez : 

```bash
sudo yunohost tools migrations migrate
```

puis lisez attentivement l'avertissement et les instructions.

## Pendant la migration

En fonction de votre matériel et des paquets installés, la migration peut prendre jusqu'à quelques heures.

Notez qu'il est attendu de voir certaines erreurs (en particulier à propos de fail2ban) pendant la migration - ne vous en inquiétez pas trop.

#### Si la migration a crashé / échoué à un moment.

Si la migration a échoué a un moment donné, la première chose à faire est de tenter de la relancer. Si cela ne fonctionne toujours pas, il vous faut [trouver de l'aide](/help) (prière de fournir le/les messages correspondants ou tout élément qui vous fait penser que ça n'a pas marché).

## Choses à vérifier après la migration

#### Vérifiez que vous êtes véritablement sous Debian Stretch / YunoHost 3.0

Pour cela, allez dans Outils > Diagnostique. (Vous pouvez aussi regarder ce qui est affiché dans le pied de page). En ligne de commande, vous pouvez aussi utiliser `lsb_release -a` et `yunohost --version`.

#### Vérifiez que fail2ban et le pare-feu sont actifs.

Vous devriez voir que fail2ban et le firewall sont actifs. Depuis la webadmin, dans Services (chercher 'fail2ban' et 'yunohost-firewall'). Depuis la ligne de commande, faites  `yunohost service status fail2ban yunohost-firewall` : les deux devraient être en `active: active`.

#### Vérifiez que les applications fonctionnent

Vérifiez que vos applications installées fonctionnent... Si elles ne fonctionnent pas, il est recommandé de tenter de les mettre à jour. (ou bien de manière générale, il est recommandé de les mettre à jour même si elles fonctionnent !).

#### Si vous utilisez les mails : vérifiez votre score

Si vous utilisez les emails (en particulier les envois), vérifiez que votre score est toujours bon via [mail-tester](https://www.mail-tester.com/) par exemple.
