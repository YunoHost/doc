### Portée générales des variables

Les variables existent pour le shell courant et ses enfants uniquement.  
Un script exécuté depuis le script n'est pas un enfant, c'est un autre shell qui n'héritera que des variables d'environnement du script appelant, pas des variables globales ou locales.

Lors de l'appel d'un script, il n'est pas démarré dans le shell courant, mais dans une nouvelle instance de bash qui hérite des variables d'environnements de son parent.
```bash
var1=value1
export var2=value2

echo "$var1"
echo "$var2"
# var1 et var2 existent

echo "-"

echo "
echo \"\$var1\"
echo \"\$var2\"" > other_script.sh
chmod +x other_script.sh
./other_script.sh
# Ici, var1 n'existe pas, seul var2 existe encore.
# Car c'est une variable d'environnement.
```
Dans le shell courant, d'où le script est appelé, faite
```bash
echo $var1 - $var2
```
Aucune des 2 variables n'existent, car leur portée se limite au script appelé. Jamais au parent.


### Les fonctions dans un script

Utiliser une fonction ne change pas la portée des variables.
```bash
var1=value1
export var2=value2

set_variable () {
	var3=value3
	export var4=value4

	echo "$var1"
	echo "$var2"
	echo "$var3"
	echo "$var4"
	# Toutes les variables existent ici
	# car la fonction hérite des variables du script.
}

set_variable

echo "$var1"
echo "$var2"
echo "$var3"
echo "$var4"
# var1 var2, var3 et var4 existent
# var3 existe car la fonction est exécutée dans le même shell que le script lui-même.

echo "-"

echo "
echo \"\$var1\"
echo \"\$var2\"
echo \"\$var3\"
echo \"\$var4\"" > other_script.sh
chmod +x other_script.sh
./other_script.sh
# Ici, var1 et var3 n'existent pas, seul var2 et var4 existe encore.
# Car ce sont des variables d'environnements.
```

### L'usage des variables locales

Les variables locales sont limitées à une fonction et ses enfants
```bash
var1=value1
export var2=value2

set_variable () {
	var3=value3
	export var4=value4
	local var5=value5

	echo "$var1"
	echo "$var2"
	echo "$var3"
	echo "$var4"
	echo "$var5"
	# Toutes les variables existent ici
	# car la fonction hérite des variables du script.
}

set_variable

echo "-"

echo "$var1"
echo "$var2"
echo "$var3"
echo "$var4"
echo "$var5"
# var1 var2, var3 et var4 existent
# var3 existe car la fonction est exécutée dans le même shell que le script lui-même.
# var5 n'existe pas, car sa portée se limite à la fonction qui l'a déclaré

echo "-"

echo "
echo \"\$var1\"
echo \"\$var2\"
echo \"\$var3\"
echo \"\$var4\"
echo \"\$var5\"" > other_script.sh
chmod +x other_script.sh
./other_script.sh
# Ici, var1, var3 et var5 n'existent pas, seul var2 et var4 existe encore.
# Car ce sont des variables d'environnements.
```

L'intérêt d'utiliser une variable locale est donc de limiter cette variable à la seule fonction qui l'a déclaré. Et donc ne pas polluer le script dans sa globalité avec des variables inutile pour ce dernier.  
Il existe également un second avantage à l'usage d'une variable locale, c'est de ne pas modifier le contenu d'une variable globale.
```bash
var1=value1
var2=value2
var3=value3

set_variable () {
	echo "$var1"
	echo "$var2"
	echo "$var3"

	echo "-"

	var2=new_value2
	local var3=new_value3

	echo "$var1"
	echo "$var2"
	echo "$var3"
	# La valeurs de var2 et var3 sont modifiées dans la fonction
}

set_variable

echo "-"

echo "$var1"
echo "$var2"
echo "$var3"
# var3 a repris sa valeur initiale,
# car dans la fonction var3 a été déclaré comme une nouvelle variable locale.
# Mais var2 a été modifiée directement, donc sa valeur reste modifiée.
# Car var2 dans la fonction est resté une variable globale.
```

Comme vu précédemment, les variables modifiée ou créée dans la fonction affecte le script car la fonction est exécutée dans le même shell que celui-ci.  
Cela change si on exécute la fonction dans un sous-shell, la fonction devient un enfant qui hérite de son parent uniquement.
```bash
var1=value1
var2=value2
var3=value3

fonction2 () {
	echo "-"
	echo "var1=$var1"
	echo "var2=$var2"
	echo "var3=$var3"
	echo "var4=$var4"
	echo "var5=$var5"
	# Même var3, qui est locale, est héritée par la fonction enfant.
}

set_variable () {
	echo "var1=$var1"
	echo "var2=$var2"
	echo "var3=$var3"
	# Les variables sont héritées du parent.

	echo "-"

	var2=new_value2
	local var3=new_value3
	var4=new_value4
	export var5=new_value5

	echo "var1=$var1"
	echo "var2=$var2"
	echo "var3=$var3"
	echo "var4=$var4"
	echo "var5=$var5"
	# La valeurs de var2 et var3 sont modifiées dans la fonction

	(fonction2)
}

(set_variable)
# Démarre la fonction dans un shell fils.

echo "-"

echo "var1=$var1"
echo "var2=$var2"
echo "var3=$var3"
echo "var4=$var4"
echo "var5=$var5"
# var2 et var3 ont repris leur valeurs initiales,
# Car la fonction est dans un shell enfant qui n'affecte pas son parent.
# De même, var4 et var5 n'existent pas, car elle sont déclarées dans un shell enfant.
# Le parent n'hérite pas des shells enfants.
```

### Conclusion

- La portée d'une variable est toujours le shell courant et ses enfants, jamais son shell parent.
- Une variable d'environnement peut être exportée sur un nouveau shell, indépendant du premier. À condition que ce dernier exécute le second. Mais ne peut pas affecter les parents.
- Une variable locale dans une fonction, exécutée dans le shell courant, n'affecte pas son environnement en dehors de la fonction. Et permet également de ne pas affecter le contenu d'une variable globale de même nom.
- Une fonction exécutée dans un sous-shell n'affecte jamais le parent, que ses variables soient globales ou locales.
- Le parent n'est JAMAIS affecté par les variables définies ou modifiées par ses shells enfants.
