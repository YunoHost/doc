---
title: Trap
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_trap'
---

Trap is an internal shell command used to capture the output signals of commands executed in the current shell and its subshells.

Any command executed in the shell returns an exit signal at the end of its execution. Either 0 to indicate the end of the execution of the command, or a non-zero value indicating an interruption thereof.

In the case of installation scripts, trap will allow us to detect a command interrupted in the middle of its execution due to an error.
Detection of this error will allow the installation to be terminated and returned to the remove script for cleaning up residues.

Trap is used as follows:

```bash
trap 'commande' liste_de_signaux
```

To simplify, we will use the pseudo signal `ERR` to gather all the error signals.

We could simply add this line at the beginning of the script:

```bash
trap "echo Erreur d'installation" ERR
```

After this line, any command causing an error will trigger the display of the message indicated by trap.
All of the current shell and the subshell will be supported by trap.

To stop capturing signals with trap, you can simply deactivate trap.

```bash
trap ERR
```

Or completely ignore the affected output signals.

```bash
trap "" ERR
```

In the latter case, the interrupt signal will have no effect on the shell. This can be useful for a command whose error output should not impact the progress of the installation script.

### Stop the installation script and clean up before exiting.
In the event of an error in the installation script, trap must allow to stop the installation, then clean up the partially installed residual files before leaving the script.
For this, we will provide a function dedicated to the installation failure.

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

The `EXIT_PROPERLY` function must indicate to the user that the installation has failed and clean up any residue that will not be taken care of by the remove script. The latter will be automatically called after exit `1` with YunoHost 2.4

After this function, we can set up signal capture by trap.

```bash
trap EXIT_PROPERLY ERR
```

If a command fails during installation, the `EXIT_PROPERLY` function will be called, ending the installation.

To simplify the capture of signals and ignore them for specific commands. It is possible to place trap calls in functions.

```bash
TRAP_ON () {	# Activate signal capture
	trap EXIT_PROPERLY ERR	# Capturing exit signals on error
}
TRAP_OFF () {	# Ignoring signal capture until TRAP_ON
	trap '' ERR	# Ignoring exit signals
}
```

> The `TRAP_OFF` ​​function does not work. For some reason. Using `trap '' ERR` directly works fine however.

To manage possible installation errors, we can therefore simply add this code after retrieving the arguments:

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
