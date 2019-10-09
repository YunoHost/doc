# Introduction to packaging

This documentation is here is to provide all the basic concepts and vocabulary needed to understand app packaging. eg: shell, parsing, system administration...

We will detail what is a Yunohost application package, how it works, how to make your own package and how to find help if you need it.

## What is a Yunohost application package

Before we continue, we need to define what is exactly an application package.

To be able to do that, we need to remember that Yunohost at its core is a server operating system whose mission is to simplify selfhosting of internet services. To accomplish that, Yunohost provides, among other things, an administration panel allowing application installation in a few clicks.

If you have ever installed a web application manually, you already know that the process is in reality far more complex, usually involving a lot of steps and discipline.

This is what application packaging is, a series of scripts that automate the installation of a web application and its configuration in order to provide the final user with a few clicks installation process.

### How it works

From the final user perspective, it is as simple as it can be:

1. Pick an application
2. Fill a form
3. Wait
4. Application is ready to use

There is more to see backstage:
First, when the application is selected, Yunohost will retrieve the corresponding package from github. eg: [Custom Webapp](https://github.com/YunoHost-Apps/my_webapp_ynh).
Then, Yunohost will read the manifest.json file to know what questions to ask the user through the form.

These seamingly trivial questions are very important. Usually you would need to ask for the domain on which to install, the path to access, the user that will be designated administrator and the default language for the application.

These are critical to configure appropriately the web application during the installation process. To do so, Yunohost will retrieve the answers given by the user and send them to the installation script located in the package "*scripts*" folder.

The install script will handle the user answers to complete the process as you would have done manually.

If the user wants to delete the application, Yunohost will use the remove script from the "*scripts*" folder. It will handle the cleaning process for the user and delete all folders and configuration files that was previsouly installed by the application.

### What is a script?

Scripts used during application packaging are simply a series of bash commands.

### ... bash command?

A [bash](https://en.wikipedia.org/wiki/Bash_%28Unix_shell%29) command is a line of text that will be interpreted by the computer and will produce a result. This is commonly refered to as a command line.

You can ony interact with your server through the command line as it does not provide a graphical interface. Usual access is through [ssh](/ssh_en).

Package scripts are therefore a series of bash commands as if you had typed them directly in the ssh console.

To know what you can write in a bash script, you should start reading this [simple tutorial](https://debian-facile.org/doc:programmation:shells:debuter-avec-les-scripts-shell-bash) or this [more advanced one](http://aral.iut-rodez.fr/fr/sanchis/enseignement/bash/index.html).

### Ok, I'm good! Where do I start?

Before starting the packaging process, you need to successfully install the application. The script will only perform what you instruct it to do.

Once completed, you need to read a little bit more documentation about application packaging. [This one is more technical](/packaging_apps_en) but now you should understand all the wizardry.

### HELP! NEED BACKUP!

Fortunately, you are not alone in this!

There are other packagers like you and you can meet them on the [forum](https://forum.yunohost.org/c/apps-packaging) or the [chat](xmpp:apps@conference.yunohost.org?join).

Feel free to join in and ask your questions, there always will be someone to help.

Soon enough you'll see for yourself that packaging applications is not that hard after all.
