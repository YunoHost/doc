# Administrar YunoHost con la interfaz de línea de comandos

La interfaz de línea de comandos (CLI) es, en informática, la manera original (y más técnica) de interactuar con un ordenador. Está generalmente considera como más completa, más potente y eficaz que las interfaces gráficas, aunque sea más difícil de aprenderla.

En el contexto de Yunohost, o de la administración de sistemas en general, la línea de comandos comúnmente se utiliza después de haberse [conectado en SSH](/ssh_es).

<div class="alert alert-info" markdown="1">
Proveer un tutorial completo sobre la línea de comandos saldría del marco de la documentación de Yunohost : por eso, refiérete a totorales como [éste](https://www.fing.edu.uy/inco/cursos/sistoper/recursosLaboratorio/tutorial0.pdf) o [éste (en)](http://linuxcommand.org/). Pero no te preocupes : no hace falta ser un experto para comenzar a utilizarla !
</div>

El comando `yunohost` puede ser utilizado para administrar tu servidor o realizar las mismas acciones que en la interfaz gráfica webadmin. Hay que iniciarla como usuario `root`, o como el usuario `admin` poniendo `sudo` antes del comando. (ProTip™ : puedes convertirte en usuario `root` vía el comando `sudo su` cuando eres `admin`.)

Los comandos Yunohost tienen este tipo de estructura :

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
   categoría  acción  argumento     opción
```

No dudes en navegar ni en pedir información a propósito de una categoría o acción utilizando la opción `--help`. Por ejemplo, estos comandos :

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

de manera sucesiva van a enumerar todas las categorías disponibles, luego las acciones de la categoría `user`, y luego explicar cómo utilizar la acción `user create`. Deberías notar que el árbol de los comandos Yunohost tiene la misma estructura que las páginas del webadmin.