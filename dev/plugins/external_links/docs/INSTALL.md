# [Installation and update guide][project]
[project]: https://github.com/sommerregen/grav-plugin-external-links

## Installation

Installing the `External Links` plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line). From the root of your Grav install type:

	bin/gpm install external_links

This will install the `External Links` plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/external_links`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `external_links`. You can find these files either on [GitHub](https://github.com/sommerregen/grav-plugin-external-links) or via [GetGrav.org](http://getgrav.org/downloads/plugins).

You should now have all the plugin files under

	/your/site/grav/user/plugins/external_links

>> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and a theme to be installed in order to operate.

## Updating

As development for `External Links` continues, new versions may become available that add additional features and functionality, improve compatibility with newer Grav releases, and generally provide a better user experience. Updating `External Links` is easy, and can be done through Grav's GPM system, as well as manually.

### GPM Update (Preferred)

The simplest way to update this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm). You can do this with this by navigating to the root directory of your Grav install using your system's Terminal (also called command line) and typing the following:

	bin/gpm update external_links

This command will check your Grav install to see if your `External Links` plugin is due for an update. If a newer release is found, you will be asked whether or not you wish to update. To continue, type `y` and hit enter. The plugin will automatically update and clear Grav's cache.

#### Manual Update

Manually updating `External Links` is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/external_links` directory.
* Download the new version of the `External Links` plugin from either [GitHub](https://github.com/sommerregen/grav-plugin-external-links) or [GetGrav.org](http://getgrav.org/downloads/plugins).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `external_links`.
* Clear the Grav cache. The simplest way to do this is by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

>> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
