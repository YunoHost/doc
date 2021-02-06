### General scope of variables

Variables exists for the current shell and its children only.  
Another script executed from the script is not a child, it's another shell which herited only the environment variables from its caller script, not its globals or locals variables.

When a script is called, it isn't started in the current shell, but in a new instance of bash which herite environment variables from its parent.
```bash
var1=value1
export var2=value2

echo "$var1"
echo "$var2"
# var1 and var2 exist

echo "-"

echo "
echo \"\$var1\"
echo \"\$var2\"" > other_script.sh
chmod +x other_script.sh
./other_script.sh
# Here, var1 doesn't exist, only var2 still exists.
# Because it's an environment variable.
```
In your current shell, where you launch this script, try
```bash
echo $var1 - $var2
```
None of this 2 variables exists, because their scope is limited to the script itself. Never its parent.


### Functions inside a script

Use a function would not change the scope of variables.
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
	# All variables exists here
	# Because the function inherite its variables from the script.
}

set_variable

echo "$var1"
echo "$var2"
echo "$var3"
echo "$var4"
# var1 var2, var3 and var4 exist
# var3 exist because the function is executed in the same shell than the script itself.

echo "-"

echo "
echo \"\$var1\"
echo \"\$var2\"
echo \"\$var3\"
echo \"\$var4\"" > other_script.sh
chmod +x other_script.sh
./other_script.sh
# Here, var1 and var3 don't exist, only var2 and var4 still exist.
# Because they're environment variables.
```

### The usage of locales variables

Locales variables are limited to the function and its children.
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
	# All variables exists here
	# Because the function inherite its variables from the script.
}

set_variable

echo "-"

echo "$var1"
echo "$var2"
echo "$var3"
echo "$var4"
echo "$var5"
# var1 var2, var3 and var4 exist
# var3 exist because the function is executed in the same shell than the script itself.
# var5 doesn't exist, because its scope is limited to the function which declare it.

echo "-"

echo "
echo \"\$var1\"
echo \"\$var2\"
echo \"\$var3\"
echo \"\$var4\"
echo \"\$var5\"" > other_script.sh
chmod +x other_script.sh
./other_script.sh
# Here, var1, var3 and var5 don't exist, only var2 and var4 still exist.
# Because they're environment variables.
```

Using a local variable is usefull for limit it scope to the function only. And not bother the script in its globality with useless variables.  
But there's also another advantage with local variable, do not modify the content of a global variable.
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
	# Values of var2 and var3 are modified in the function.
}

set_variable

echo "-"

echo "$var1"
echo "$var2"
echo "$var3"
# var3 retake is original value,
# because in the function, var3 was declared as a new locale variable.
# But var2 was directly modified, so its value still changed.
# Because, var2 in the function is still a global variable.
```

As seen previously, modified or created variables in a function can affect the main script because the function is executed in the same shell.  
But, the things are different if the function is executed in a sub shell, the function become a child which only inherite from its parent.
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
	# Even var3, which is local, is inherited from the parent function.
}

set_variable () {
	echo "var1=$var1"
	echo "var2=$var2"
	echo "var3=$var3"
	# Variables are inherited from the parent.

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
	# Values of var2 and var3 are modified in the function.

	(fonction2)
}

(set_variable)
# Start the function in a sub shell.

echo "-"

echo "var1=$var1"
echo "var2=$var2"
echo "var3=$var3"
echo "var4=$var4"
echo "var5=$var5"
# var2 and var3 retake their original values.
# Because the function is in a child shell which never affect its parent.
# Likewise, var4 and var5 don't exist, because they're been declared in child shell.
# The parent never inherite from its children shell.
```

### Conclusion

- The scope of a variable is always the current shell and its children, never its parent shell.
- An environment variable may be exported to a new shell, detached from the first one. If the last one executed the second one. But, it can't affect the parents.
- A locale variable in a function, executed in the current shell, can't affect the environment outside of the function. End allow also to not affect a global variable with the same name.
- A function executed in a sub shell will never affect its parent, with global or local variables.
- A parent can NEVER be affected by variables defined or modified in its children shell.
