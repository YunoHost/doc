# Administrer YunoHost en ligne de commande

L'interface en ligne de commande (CLI) est, en informatique, la manière originale (et plus technique) d'interagir avec un ordinateur comparé aux interfaces graphiques. La ligne de commande est généralement considéré comme plus complète, puissante et efficace que les interfaces graphiques, bien que plus difficile à apprendre.

Dans le contexte de YunoHost, ou de l'administration système en général, la ligne de commande est communément utilisée après s'être [connecté en SSH](/ssh).

<div class="alert alert-info" markdown="1">
Fournir un tutorial complet sur la ligne de commande est bien au dela du cadre de la documentation de YunoHost : pour cela, référez-vous à des tutoriaux comme [celui-ci](https://doc.ubuntu-fr.org/tutoriel/console_ligne_de_commande) ou [celui-ci (en)](http://linuxcommand.org/). Mais soyez rassuré qu'il n'y a pas besoin d'être un expert pour commencer à l'utiliser !
</div>

La commande `yunohost` peut être utilisée pour administrer votre serveur ou réaliser les mêmes actions que celles disponibles sur la webadmin. Elle doit être lancée en depuis l'utilisateur `root`, ou bien depuis l'utilisateur `admin` en précédant la commande de `sudo`. (ProTip™ : il est possible de devenir `root` via la commande `sudo su` en tant qu'`admin`.)

Les commandes YunoHost ont ce type de structure :

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
   categorie  action  argument     options
```

N'hesitez pas à naviguer et demander des informations à propos d'une catégorie ou action donnée via l'option `--help`. Par exemple, ces commandes :

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

vont successivement lister toutes les catégories disponibles, puis les actions de la catégorie `user`, puis expliquer comment utiliser l'action `user create`. Vous devriez remarquer que l'arbre des commandes YunoHost suit une structure similaire aux pages de la webadmin.
