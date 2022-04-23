# Presentation Deckset Plugin

The **Presentation Deckset** Plugin is for [Grav CMS](http://github.com/getgrav/grav), and allows you to use Deckset Syntax with the [Presentation Plugin](https://github.com/OleVik/grav-plugin-presentation). The Presentation Plugin must be installed for this plugin to run.

## Installation

Installing the Presentation Plugin Deckset plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install presentation-deckset

This will install the Presentation Plugin Deckset plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/presentation-deckset`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `presentation-deckset`. You can find these files on [GitHub](https://github.com/OleVik/grav-plugin-presentation-deckset) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/presentation-deckset
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/presentation-deckset/presentation-deckset.yaml` to `user/config/plugins/presentation-deckset.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the admin plugin, a file with your configuration, and named presentation-deckset.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

With the Presentation Deckset Plugin enabled, add the following to the Presentation Plugin's configuration:

```yaml
parser: 'DecksetParser'
```

This will replace the Presentation Plugin's Parser with the Deckset-compliant one that this Plugin enables. This can also be done for a single Presentation using the Page's FrontMatter:

```yaml
presentation:
  parser: 'DecksetParser'
```

### Syntax restrictions

The [Deckset Syntax](https://docs.deckset.com/English.lproj/) for Customization Commands is emulated through the DecksetParser, with the following exceptions or quirks:

#### Formatting

##### Lists, Text Styles, Quotes, Links, Code Blocks, Tables, Controlling Line Breaks

All of this is standard Markdown, with a few exceptions that require Markdown Extra enabled.

##### Headings

The `fit`-commands inlined in headings have no effect, use Textsizing instead.

##### Formulas

Use [MathJax](https://github.com/Sommerregen/grav-plugin-mathjax) or equivalent for parsing.

##### Emojis

Currently not supported.

##### Footers and Slide Numbers

Footers are optionally enabled via the main Plugin's options. Enable Slide Numbers in [Reveal.js](https://github.com/hakimel/reveal.js/#slide-number), using `slideNumber: true` through the main Plugin's options.

##### Footnotes

If Markdown Extra is enabled, these render at the _end_ of the presentation, with varying results.

##### Auto-Scaling

See [Fitting text to a slide](https://github.com/OleVik/grav-plugin-presentation#fitting-text-to-a-slide) in the main Plugin's options.

#### Media

##### Background Images

All syntaxes are supported, except `left|right filtered` and `left|right fit`. Multiple background images are supported by pure CSS, constrained by the dimensions of images used.

##### Inline Images

Inlined images are supported, but not `inline fill`, `inline X%`, and Image Grids with `inline fill`.

##### Videos

Background- and inline are supported, but not `left|right`. `autoplay`, `mute`, and `loop` are supported. For non-native video, like YouTube, use plugins like the [YouTube](https://github.com/getgrav/grav-plugin-youtube)-plugin, embed directly with HTML.

##### Audio

Automatically inlined, but no layout control. `autoplay`, `mute`, and `loop` are supported. For non-native audio, like SoundCloud, use a plugin or embed directly with HTML. Audio-download is disabled.

#### Presenting

##### Notes

Deckset's notes, using the `^ This is my note.`-syntax, is supported. This syntax is rather simple and quite limited, so if you want to use Markdown in your notes, use the [main plugin's syntax](https://github.com/OleVik/grav-plugin-presentation#notes) instead.

## Contributing

If there are other inadequacies, this is likely due to the lack of documentation provided by Deckset. If you find any areas for improvement, feel free to create a Pull Request.

### PHP Code Standards

This plugin follows PSR-1, PSR-2, and PEAR coding standards (use CodeSniffer), as well as PSR-4.

## Sponsored by

This Plugin was developed by Ole Vik with the sponsorship of [Hibbitts Design](https://www.hibbittsdesign.org).