# Presentation Plugin

The **Presentation** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav), and provides a simple way of creating fullscreen slideshows that can be navigated two-dimensionally, using the [Reveal.js](https://github.com/hakimel/reveal.js/)-library.

At its core the plugin facilitates efficient handling of content for use with the library. You can utilize Reveal.js however you want through custom initialization, and still leverage the plugin's content-handling. A [demo is available](https://olevik.me/staging/grav-skeleton-presentation/) and a [Skeleton](https://github.com/OleVik/grav-skeleton-presentation/releases), as well as the [demo content](https://github.com/OleVik/grav-skeleton-presentation/tree/master/pages).

## Features

- Presentations through two-dimensional slideshows
- Responsive, multi-device capable styling
- Granular control over presentation and slides
  - Cascading-styles and options with Shortcodes and the Admin-plugin
- Portable content: Everything is contained in Markdown, including settings
- Flexible, ambigious, recursive Page-structure
- Extendable through your own theme or plugin
- Print-friendly presentations, with or without notes or in text-only mode
- Presenter-mode: A modern, powerful, easy-to-use alternative to PowerPoint
  - Include notes with your presentation
  - Synchronize Presenter-mode and the Presentation locally or remotely

## Installation

Installing the presentation-plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line). From the root of your Grav install type:

    bin/gpm install presentation

This will install the Presentation-plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/presentation`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `presentation`. You can find these files on [GitHub](https://github.com/ole-vik/grav-plugin-presentation) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/presentation

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Requirements

**This plugin will only work with [Grav v1.6](https://github.com/getgrav/grav/tree/1.6) or higher, as it requires [PHP v7.1.3](http://php.net/manual/en/migration71.new-features.php) or higher.**

## Configuration

Before configuring this plugin, you should copy the `user/plugins/presentation/presentation.yaml` to `user/config/plugins/presentation.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
# Enable Plugin if true, disable if false
enabled: true
# Theme to use from Reveal.js (https://github.com/hakimel/reveal.js/#theming)
theme: moon
# Order of how pages are rendered
order:
  by: folder
  dir: asc
# Load all registered CSS and JS assets
all_assets: false
# Include Theme's custom.css
theme_css: true
# Enable Reveal.js CSS
builtin_css: true
# Enable Reveal.js JS
builtin_js: true
# Enable Plugin's CSS
plugin_css: true
# Enable Plugin's JS
plugin_js: true
# Enable Plugin's dynamic text sizing
textsizing: true
# Synchronize Slide-navigation
sync: "none"
# URL Route to use for Poll-sync
api_route: "presentationapi"
# Poll-sync timeout in milliseconds
poll_timeout: 2000
# Poll-sync retry limit
poll_retry_limit: 10
# Enable Poll-sync token-authorization
token_auth: false
# Poll-sync token to use for authorization
token: Hd4HFdPvbpKzTqz
# Enable Save Content button and CTRL+SHIFT+S combo
admin_async_save: false
# Enable Save Content when typing
admin_async_save_typing: false
# Twig-template to inject below content
footer: ""
# Enable onLoad transition
transition: true
# Process HTML or raw Markdown
process: html
# Enable Plugin's shortcodes
shortcodes: true
# Default class for Presentation-shortcode
shortcode_classes: "presentation-iframe"
# Unwrap images from paragraph
unwrap_images: true
# Class to use for Content building
content: "Content"
# Class to use for Content parsing
parser: "Parser"
# Class to use for Styles, Classes, and Data management
transport: "Transport"
# Class to use for Shortcode parsing
shortcode_parser: RegularParser
# Breakpoints for responsive textsizing
breakpoints:
  240: "16"
  320: "20"
  576: "24"
  768: "28"
  992: "32"
  1200: "36"
  1600: "40"
# Styles to use as defaults for Presentations
style:
  ...
# Dynamic text scaling to use as defaults for Presentations
textsize:
  scale: string
  modifier: float
# Stack slides horizontally or vertically (default), on thematic breaks
horizontal: false
# Options to pass to Reveal.js
options:
  width: "100%"
  height: "100%"
  margin: "0"
  minScale: "1"
  maxScale: "1"
  transition: "fade"
  controlsTutorial: "false"
  history: "true"
  display: "flex"
  pdfSeparateFragments: false
```

All configuration-options available to the Reveal.js-library can be configured through `options`, see its [documentation for available options](https://github.com/hakimel/reveal.js#configuration).

### Page-specific configuration

Any configuration set in `presentation.yaml` can be overridden through a Page's FrontMatter, like this:

```yaml
---
title: Alice’s Adventures in Wonderland
presentation:
  order:
    by: date
    dir: desc
  options:
    transition: "fade"
---

```

## Usage

The Page-structure used in the Presentation-plugin is essentially the same as normally in Grav, with a few notable exceptions: Any horizontal rule, `---` in Markdown and `<hr />` in HTML, is treated as a _thematic break_, as it is defined in HTML5. This means that every Page in Grav is treated as a normal, _horizontal Slide_ when the Plugin iterates over them, but a thematic break creates a _vertical Slide_.

You can have as many Pages below the root-page as you want, each of them will be treated as a Slide. When you create thematic breaks within the Page, the Slides are then created _below_ the Page itself -- accommodating Reveal.js' two-dimensional slideshows.

For using Reveal.js itself, see their documentation on [Getting Started with Presenting](http://help.slides.com/knowledgebase/articles/334920) and [Speaker View](http://help.slides.com/knowledgebase/articles/333923-speaker-view).

### Nomenclature

With Reveal.js the presentation is not entirely linear. Rather, it has a linear, left-to-right set of sections that each make up a slide, and can have additional slides going downwards. Thus you can progress through the presentation linearly starting at each section, moving downwards until the end, and continuing onto the next section, or move between them as you choose.

Further, there are [Fragments](https://github.com/hakimel/reveal.js#fragments) that can be used within each slide. These reveal linearly like slides, but make one element appear at a time rather than the full contents of the slide.

### Structure

```
/user/pages/book
├── presentation.md
├── 01.down-the-rabbit-hole
│   └── slide.md
├── 02.advice-from-a-caterpillar
│   └── slide.md
├── 03.were-all-mad-here
│   └── slide.md
├── 04.a-mad-tea-party
│   └── slide.md
├── 05.the-queens-crocquet-ground
│   └── slide.md
├── 06.postscript
└───└── slide.md
```

As seen in this example structure, only the initial page uses the `presentation.html.twig`-template. The template used for child-pages is `slide.html.twig`, though the content of these pages are processed regardless of template. Naming them `slide.md` enables the blueprints for slides in the Admin-plugin. The plugin defines the `presentation.html.twig`-template, but you can override it through your theme.

### Styling

The plugin emulates the logic of Cascading Style Sheets (CSS), in that pages can be assigned a class, style-property, or be hidden using FrontMatter or shortcodes. This is as simple as using `class: custom-slide-class` in FrontMatter or `[class=custom-slide-class]` with a shortcode in the Markdown-content. Styles are applied the same way, where FrontMatter accepts CSS-properties like this:

```
style:
  color: green
```

That is, mapping each property to a value, not as a list. The same could be set for any single slide using `[style-color=green]`, as described below. Styles are given precedence by where they appear, so the plugins looks for them in this order:

1. Plugin-options
2. Page FrontMatter
3. Child page FrontMatter
4. Page Content (Markdown) as shortcodes

The properties are gathered cumulatively, and a property farther down the chain takes precedence over a property further up.

You can of course also style the plugin using your theme's `/css/custom.css`-file, by targeting the `.reveal`-selector which wraps around all of the plugin's content. This behavior can be enabled or disabled with the `theme_css`-setting. All slides have an `id`-attribute set on their sections, which can be utilized by CSS like this:

```css
.reveal #down-the-rabbit-hole-0 {
  background: red;
}
```

#### Fitting text to a slide

The plugin makes available a method of dynamically scaling text within a slide, which is similar yet distinct from what happens in PowerPoint 2016. Rather than do this scaling entirely automatically, which tends to work poorly across devices and resolutions, you set a _scale_ and an optional _modifier_, eg.:

```
[data-textsize-scale=1.125]
[data-textsize-modifier=1.05]
```

If Textsizing is enabled in the plugin's options and on the Page, the relation between block text -- any text not in a header-element -- and header-text (`h1`, `h2`, `h3`, `h4`, `h5`, `h6`) is determined by the `textsize-scale`-property. That is, the size of the header-element's text relative to the base font-size.

In the example above, the scale is set to the "Major Second" rhythm, and with a base font size of 16 -- the minimum font-size recommended for web -- this yields the following sizes for headers: 28.83 (`h1`), 25.63 (`h2`), 22.78 (`h3`), 20.25 (`h4`), 18 (`h5`), and 16 (`h6`). The base font size, and hence text, is adjusted upwards as the size of the screen increases to enable dynamic, responsive text-sizing. This is done through the `breakpoints`-option.

The modifier, if set, changes the matched breakpoint's base font size by multiplication. So if set to `1.05` it makes it 5% larger than it normally would be at this breakpoint.

#### Using section- or slide-specific styles

If configured with `shortcodes: true` any section or slide can use shortcodes to declare specific styles. These take the format of `[style-property=value]` and are defined in multiples, eg:

```
[style-background=#195b69]
[style-color=cyan]
```

If the shortcode is found and applied, it is stripped from the further evaluated content. This method uses regular expressions for speed, and takes precedence over plugin- or page-defined `styles`.

**Note**: The syntax is restricted to `[style-property=value]`. Unexpected characters not conforming to alphanumerics or dashes can make the expression fail to pick up the shortcode. The `style-property` or `value` must basically conform to the [a-zA-Z0-9-]+ regular expression, separated by an equal-character (`=`) and wrapped in square brackets (`[]`). For testing, use [Regex101](https://regex101.com/r/GlH65o/3). **However, you may find it necessary to wrap the value in double quotes for the parser to understand it.**

##### Center content

To center content vertically in the slide, when Reveal.js has `display: 'flex'` set, you need to add `justify-content: center` to the slides. This is as simple as adding the following to a Page's FrontMatter:

```
style:
  justify-content: center
```

Or the shortcode `[style-justify-content=center]` to an individual slide.

#### Full background image, video, or website with Reveal.js, through data-attributres

Reveal.js supports easy usage of background images, videos, or websites for slides, with their [Slide backgrounds](https://github.com/hakimel/reveal.js/#slide-backgrounds). As well as inline styles through shortcodes, any property that begins with `data` is passed as a data-attribute to the slide, so you can do things like add a background image:

```
[data-background-image=https://upload.wikimedia.org/wikipedia/commons/5/50/Sylvilagus_bachmani_01035t.JPG]
[data-background-size=contain]
```

Background video:

```
[data-background-video=https://dl3.webmfiles.org/big-buck-bunny_trailer.webm]
[data-background-video-loop=true]
[data-background-video-muted=true]
[data-background-size=contain]
```

Background website:

```
[data-background-iframe=https://en.wikipedia.org/wiki/Rabbit]
```

Foreground (interactive) website:

```
[data-background-iframe=https://en.wikipedia.org/wiki/Rabbit]
[data-background-interactive]
```

When using `data-background-interactive`, the iFrame can be interacted with. Therefore you must manually click the control arrows of the presentation to navigate away from this slide. Slides with background iFrames always use the full width and height of the browser window.

**Note**: It may be necessary to wrap the value/parameter of the shortcode in double quotes, like `[data-background-iframe="https://en.wikipedia.org/wiki/Rabbit"]`, for it to work properly.

##### A big anchor overlaying the slide

A `link-overlay`-shortcode is available for creating a link that overlays the slide, apt for use with backgrounds. For example: `[link-overlay="https://google.com/"]`.

#### Variable-naming

Since version 3.1.4 the plugin is more flexible in how it looks for custom styles. You can name these `style` or `styles`, or nest them within `presentation` in a Page's FrontMatter. The plugin-configuration looks for `style` then `styles`, and when processing slides it continues looking within `presentation`. Here's an example from FrontMatter, where `style` is found first and therefore applied.

```yaml
style:
  justify-content: center
styles:
  justify-content: space-around
presentation:
  style:
    justify-content: space-between
presentation:
  styles:
    justify-content: space-evenly
```

### Notes

Each slide can have notes associated with it, like a PowerPoint-presentation would. These can be set on any slide using `[notes] ... [/notes]`, where the shortcodes should envelop the Markdown-content that makes up your notes. Eg:

```
[notes]

- Rabbits don't lay eggs
- Porpoises don't tell lies
- Camels don't smoke cigarettes

[/notes]
```

## [Advanced Usage](https://github.com/OleVik/grav-plugin-presentation/blob/master/ADVANCED.md)

## [Contributing and Development](https://github.com/OleVik/grav-plugin-presentation/blob/master/CONTRIBUTING.md)

## TODO

- [ ] Bump to [new major-version of Reveal.js](https://revealjs.com/upgrading/)

## Credits

- Grav [presentation](https://github.com/OleVik/grav-plugin-presentation)-plugin is written by [Ole Vik](https://github.com/OleVik)
- [Reveal.js](https://github.com/hakimel/reveal.js)-plugin
- Both are MIT-licensed
- Core development financed by [UiB](https://www.uib.no/), Save Content Functionality sponsored by [Paul Hibbitts](https://twitter.com/hibbittsdesign)
- Special thanks to [Paul Hibbitts](https://twitter.com/hibbittsdesign) for extensive testing

## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FOleVik%2Fgrav-plugin-presentation.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2FOleVik%2Fgrav-plugin-presentation?ref=badge_large)
