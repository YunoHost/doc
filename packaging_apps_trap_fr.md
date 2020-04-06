# Usage de trap

Trap est une commande interne du shell permettant de capturer les signaux de sorties des commandes exécutées dans le shell courant et ses sous-shell.

Toute commande exécutée dans le shell renvoi un signal de sortie à la fin de son exécution. Soit 0 pour indiquer la fin de l'exécution de la commande, soit une valeur non nulle indiquant une interruption de celle-ci.

Dans le cas des scripts d'installation, trap va nous permettre de détecter une commande interrompue au milieu de son exécution en raison d'une erreur.
La détection de cette erreur permettra de mettre fin à l'installation et de renvoyer vers le script remove en vue d'un nettoyage des résidus.

Trap s'utilise de la manière suivante :

```bash
trap 'commande' liste_de_signaux
```

Pour simplifier, nous utiliserons le pseudo signal `ERR` pour rassembler tout les signaux d'erreur.

On pourrait ajouter simplement cette ligne en début de script :

```bash
trap "echo Erreur d'installation" ERR
```

Après cette ligne, toute commande provoquant une erreur déclenchera l'affichage du message indiqué par trap.
L'ensemble du shell courant et du sous-shell sera pris en charge par trap.

Pour arrêter la capture des signaux par trap, on peut simplement désactiver trap.

```bash
trap ERR
```

Ou ignorer complètement les signaux de sorties concernés.

```bash
trap "" ERR
```

Dans ce dernier cas, le signal d'interruption n'aura aucun effet sur le shell. Cela peux être utile pour une commande dont la sortie en erreur ne doit pas impacter le déroulement du script d'installation.

### Stopper le script d'installation et nettoyer avant de quitter.
En cas d'erreur du script d'installation, trap doit nous permettre de stopper l'installation, puis de nettoyer les fichiers résiduels partiellement installés avant de quitter le script.
Pour cela, nous allons prévoir une fonction dédiée à l'échec de l'installation.

```bash
# Delete files and db if exit with an error
EXIT_PROPERLY () {
	trap ERR	# Disable trap
	echo -e "\e[91m \e[1m"	# Shell in light red bold
	echo -e "!!\n  $app install's script has encountered an error. Installation was cancelled.\n!!"

	echo -e "\e[22m"	# Remove bold

	# Clean hosts
	sudo sed -i '/#leed/d' /etc/hosts

	if [ $ynh_version = "2.2" ]; then
		/bin/bash ./remove	# Call the script remove. In 2.2, this behavior is not automatic.
	fi
	exit 1
}
```

La fonction EXIT_PROPERLY doit indiquer à l'utilisateur l'échec de l'installation et nettoyer les résidus qui ne seront pas pris en charge par le script remove. Ce dernier sera automatiquement appelé à la suite de l'exit 1 avec Yunohost 2.4

Après cette fonction, on peut mettre en place la capture des signaux par trap.

```bash
trap EXIT_PROPERLY ERR
```

Si une commande échoue durant l'installation, la fonction EXIT_PROPERLY sera appelée, mettant fin à l'installation.

Pour simplifier la capture des signaux et les ignorer pour des commandes ponctuelles. Il est possible de placer les appels à trap dans des fonctions.

```bash
TRAP_ON () {	# Activate signal capture
	trap EXIT_PROPERLY ERR	# Capturing exit signals on error
}
TRAP_OFF () {	# Ignoring signal capture until TRAP_ON
	trap '' ERR	# Ignoring exit signals
}
```

> Ma fonction TRAP_OFF ne fonctionne pas. Pour une raison qui m'échappe. Utiliser `trap '' ERR` directement fonctionne très bien en revanche.

Pour gérer les éventuelles erreur d'installations, on peut donc simplement ajouter ce morceau de code après la récupération des arguments :

```bash
# Delete files and db if exit with an error
EXIT_PROPERLY () {
	trap ERR	# Disable trap
	echo -e "\e[91m \e[1m"	# Shell in light red bold
	echo -e "!!\n  $app install's script has encountered an error. Installation was cancelled.\n!!"

	echo -e "\e[22m"	# Remove bold

	# Clean hosts
	sudo sed -i '/#leed/d' /etc/hosts

	if [ $ynh_version = "2.2" ]; then
		/bin/bash ./remove	# Call the script remove. In 2.2, this behavior is not automatic.
	fi
	exit 1
}
TRAP_ON () {	# Activate signal capture
	trap EXIT_PROPERLY ERR	# Capturing exit signals on error
}
TRAP_OFF () {	# Ignoring signal capture until TRAP_ON
	trap '' ERR	# Ignoring exit signals
}
TRAP_ON
```
