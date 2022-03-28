# Grav Shortcode Core Plugin

## About

The **Shortcode Core** plugin allow for the development of simple yet powerful shortcode plugins that utilize the common format utilized by **WordPress** and **BBCode**. The core plugin loads the libraries required and fires a new event that other plugins can use.  It also provides a mechanism for adding CSS/JS assets that are cached so that shortcodes can work effectively even when the processed page content is cached.  This ensures that shortcodes are only processed once and will not impact performance by doing unnecessary work on every page.

This plugin uses the [Thunderer Advanced shortcode engine](https://github.com/thunderer/Shortcode). For more information please check out that repo on GitHub.

## Quick Example

```
This is some [u]bb style underline[/u] and not much else

[center]This is centered[/center]

This is [size=30]bigger text[/size] and this is [color=blue]blue text[/color]
```

This example functionality is provided with the **Shortcode Core** plugin to provide some functionality that is not available in traditional markdown but is standard **BBCode** used in many form platforms.  You can see how the syntax is just a simple open and close element using square brackets.

This will render:

![](assets/shortcode-core-1.png)

The core plugin required for any other shortcode specific plugin. Provides some basic BBCode style syntax such as underline, color, center, and size.

## Installation

Typically a plugin should be installed via [GPM](http://learn.getgrav.org/advanced/grav-gpm) (Grav Package Manager):

```
$ bin/gpm install shortcode-core
```

Alternatively it can be installed via the [Admin Plugin](http://learn.getgrav.org/admin-panel/plugins)

> NOTE: If you install a shortcode plugin such as [grav-plugin-shortcode-ui](https://github.com/getgrav/grav-plugin-shortcode-ui) it may have this core plugin configured as a dependency and install it automatically.

## Configuration Defaults

The **Shortcode Core** plugin only has a few options to configure.  The default values are:

```yaml
enabled: true
active: true
active_admin: true
admin_pages_only: true
parser: regular
include_default_shortcodes: true
css:
  notice_enabled: true
custom_shortcodes:
fontawesome:
  load: true
  url: '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'
  v5: false
```

* `enabled: true|false` toggles if the shortcodes plugin is turned on or off
* `active: true|false` toggles if shortcodes will be enabled site-wide or not
* `active_admin: true|false` toggles if shortcodes will be processed in the admin plugin
* `admin_pages_only: true|false` toggles if admin should only process shortcodes for Grav pages
* `parser: wordpress|regex|regular` let's you configure the parser to use
* `include_default_shortcodes: true|false` toggle the inclusion of shortcodes provided by this plugin
* `custom_shortcodes:` the path to a directory where you can put your custom shortcodes (e.g. `/user/custom/shortcodes`)
* `fontawesome.load: true|false` toggles if the fontawesome icon library should be loaded or not
* `fontawesome.url:` the CDN Url to use for fontawesome
* `v5:` Version 5 flag as it requires some additional logic

> NOTE: In previous versions the `wordpress` parser was preferred.  However with version `2.4.0`, the `regex` parser is now default.  If you have saved configuration, you should manually change this to `regex` or you may receive errors or bad output.

## Configuration Modifications

The best approach to make modifications to the core plugin settings is to copy the `shortcode-core.yaml` file from the plugin into your `user/config/plugins/` folder (create it if it doesn't exist).  You can modify the settings there.

> NOTE: If you have the admin plugin installed, you can make modifications to the settings via the **Plugins** page and it will create that overridden file automatically.

## Per-Page Configuration

Sometimes you may want to only enable shortcodes on a _page-by-page_ basis.  To accomplish this set your plugin defaults to:

```yaml
enabled: true
active: false
```

This will ensure the plugin is loaded, but not **active**, then on the page you wish to process shortcodes on simply add this to the page header:

```yaml
shortcode-core:
    active: true
```

This will ensure the shortcodes are processed on this page only.

You can also change the parser on a particular page with the following:

```yaml
shortcode-core:
    parser: regex
```

## Available Shortcodes

The core plugin contains a few simple shortcodes that can be used as basic examples:

#### Underline

Underline a section of text

```
This is some [u]bb style underline[/u] and not much else
```

#### Font Size

Set the size of some text to a specific pixel size

```
This is [size=30]bigger text[/size]
```

#### Left Align

Left align the text between this shortcode

```
[left]This text is left aligned[/left]
```

#### Center Align

Center a selection of text between this shortcode

```
[center]This text is centered[/center]
```

#### Right Align

Right align the text between this shortcode

```
[right]This text is right aligned[/right]
```


#### Div

Allows you to wrap markdown in an HTML `div` tag that supports both `id` and `classes` attributes

```
[div class="text-center"]
This text is **centered** aligned
[/div]
```

or

```
[div class="table table-striped"]
| header 1 | header 2 |
|----------|----------|
| A 1      | B 1      |
| A 2      | B 2      |
| A 3      | B 3      |
[/div]
```

#### Headers

Allows you to add `id` and `class` attributes to HTML `h1` through `h6` tags:

```
[h1 class="major"]This is my title[/h1]
```

#### Span

Allows you to wrap markdown in an HTML `span` tag that supports both `id` and `class` attributes

```
[span class="text-center"]
This text is **centered** aligned
[/span]
```

#### Columns

Take advantage of powerful CSS columns support by using this shortcode

```
[columns]
### Headline

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.

Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.
[/columns]
```

Defaults to 2 columns.  You can also explicitly set the number of `columns`, `width`, `gap`, and `rule` styling for the column divider:

```
[columns count=3 width=200px gap=30px rule="1px dotted #930"]
### Headline

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.

Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.
[/columns]
```

#### Raw

Do not process the shortcodes between these raw shortcode tags

```
[raw]This is some [u]bb style underline[/u] and not much else[/raw]
```

#### Safe-Email

Encode an email address so that it's not so easily 'scrapable' by nefarious scripts.  This one has a couple of options: `autolink` toggle to turn the email into a link, and an `icon` option that lets you pick a font-awesome icon to prefix the email.  Both settings are optional.

```
Safe-Email Address: [safe-email autolink="true" icon="envelope-o"]user@domain.com[/safe-email]
```

#### Section

The **section** shortcode is a powerful way to encompass some text in your markdown page with a `[section][/section]` tag and then this is cached by Grav so it can be accessed later.  For example you could have a page with a variety of sections described in it that let you create many **chunks** of data. These are then added to Twig as an array of shortcode objects.  An example of this would be the following markdown:

```
[section name="author"]
![](author.jpg?cropResize=100,100&classes=left)
### Johnny Appleseed
Johnny Appleseed was an American pioneer nurseryman who introduced apple trees to large parts of Pennsylvania, Ontario, Ohio, Indiana, and Illinois, as well as the northern counties of present-day West Virginia. He became an American legend while still alive, due to his kind, generous ways, his leadership in conservation, and the symbolic importance he attributed to apples.
[/section]

[section name="quote"]
> Some are born great, some achieve greatness, and some have greatness thrust upon them.
  Read more at http://www.brainyquote.com/quotes/topics/topic_great.html#tdqt3strtEYBCH43.99
> <cite>William Shakespeare</cite>

Regular **Markdown** content that will be output as `page.content`
[/section]
```

This we be removed from the page content and made available in Twig variables so you could insert these into custom HTML structures, for example:

```
<div id="author">{{ shortcode.section.author }}</div>

<div id="article">
    <div class="left">
        {{ page.content|raw }}
    </div>
    <div class="right">
        {{ shortcode.section.quote }}
    </div>
</div>
```

#### Sections from other pages

You can even retrieve a section from another page utilizing the shortcodes as they are stored in the page's `contentMeta` with this syntax:

```
<div id="author">{{ page.find('/my/custom/page').contentMeta.shortcodeMeta.shortcode.section.author }}</div>
```

#### Notice

A useful shortcode that performs a similar job to the [markdown-notices](https://github.com/getgrav/grav-plugin-markdown-notices) plugins, allows you to easily create simple notice blocks as seen on http://learn.getgrav.org and http://getgrav.org.  To use simply use the following syntax:

```
[notice]
Your **Markdown** text that will appear in the notice
[/notice]
```

You can also specifically choose from `note`, `info`, `warning`, `tip` types which provide unique color options:

```
[notice=warning]
Danger Will Robinson! Danger, Will Robinson!
[/notice]
```
#### Figure

Figure elements are the recommended way to add self-contained units of flow content, i.e. images, charts and other visual elements that can be moved away from the main flow of the document without affecting the document's meaning. Figures may include captions through the `caption` attribute. Both `id` and `class` attributes are also available.

```
[figure id="fig1" class="image" caption="**Fig. 1** A beautiful figure."]
![Gorgeous image](image.png)
[/figure]
```

#### Mark

The HTML `<mark></mark>` tag is extremely useful to highlight text in your pages, and serves like a highlighter pen.  However, as we know that markdown inside of HTML is not processed, using this HTML is often not convenient as it means markdown inside will not be processed.

Another important usecase is trying to highlight code in a markdown text block, again the HTML tag doesn't work because the result is escaped and treated like any other code and simply displayed.

The solution is simple, just use the shortcode version instead:

```
This is a sample of text [mark]with this bit **highlighted** with _markdown_ syntax[/mark] and the rest just plain.
```

You can also use the `class` option to specificy a specific a CSS class to add to the `<mark>` HTML tag (useful to color the marked output):

```
This is a sample of text [mark class=blue]with this bit **highlighted** with _markdown_ syntax[/mark] and the rest just plain.
```

It also works great in code blocks:

```
<?php
class Pipeline extends PropertyObject
{
    use AssetUtilsTrait;

    [mark]protected const CSS_ASSET = true;[/mark]
    protected const JS_ASSET = false;

    ...
}
```

You can also pass an option `style` attribute of `block` to get a full lines highlighted:

```
<?php
class Pipeline extends PropertyObject
{
    use AssetUtilsTrait;

    [mark style=block]
    protected const CSS_ASSET = true;
    protected const JS_ASSET = false;
    [/mark]

    ...
}
```


#### Language

Hooks into Grav's multi-language capabilities to allow you to show certain blocks of code only for the current active language.

```
[lang=en]
Or kind rest bred with am shed then.
[/lang]

[lang=fr]
Marche diable ombres net non qui.
[/lang]

[lang=de]
Genie dahin einem ein gib geben allen.
[/lang]
```

#### FontAwesome

[FontAwesome](https://fortawesome.github.io/Font-Awesome/) is a powerful library of font-based icons.  This shortcode makes it simple to add fontawesome icons to your page content without using HTML.

```
[fa=cog /] Simplest Format

[fa=fa-cog /] Format using `fa-` prefix

[fa icon=fa-camera-retro /] Explicit format

[fa icon=fa-grav extras=fab /] Font Awesome 5 format

[fa icon=fa-camera-retro extras=fa-4x /] Explicit format with extras - [See FontAwesome Examples](https://fortawesome.github.io/Font-Awesome/examples/)

[fa icon=fa-circle-o-notch extras=fa-spin,fa-3x,fa-fw,margin-bottom /] The full monty! - [See FontAwesome Examples](https://fortawesome.github.io/Font-Awesome/examples/)
```

#### Details/Summary

The `<details>` element provides a simple show/hide behaviour without JavaScript, and can optionally contain a `<summary>` element that is always shown. Clicking on the summary text toggles the visibility of the content, and when a summary is not provided, it defaults to "Details". The element can be used to provide extra details, or can be combined into an accordion-like structure.

```
[details]
Lorem ipsum dolor sit amet...
[/details]

[details="Summary text"]
Lorem ipsum dolor sit amet...
[/details]

[details summary="Summary text" class="accordion"]
Lorem ipsum dolor sit amet...
[/details]
```

**Note:** The show/hide behaviour is not supported in IE 11 or Edge 18, and the element will be permanently open. You can check the current status of browser compatibility at [Can I Use](https://caniuse.com/#search=details).

#### Lorem Ipsum

Useful for faking content, you can use a shortcode to quickly generate some random "lorem ipsum" text:

**Paragraphs:**
```
[lorem=5 /]

[lorem p=5 tag=div /]
```

**Sentences:**
```
[lorem s=4 /]
```

**Words:**
```
[lorem w=35 /]
```

## Using Shortcodes in Twig

You can now use shortcodes in Twig templates and process them with the `|shortcodes` filter. For example:

```
{% set twig_text = "This is [size=30]bigger text[/size] and this is [color=green]green text[/color]" %}
{{ twig_text|shortcodes }}
```

## Custom Shortcodes

### Simple Way

First, configure a directory from which custom shortcodes are loaded. Edit `user/config/plugins/shortcode-core.yaml` like follows (create it if it does not exist):

```yaml
custom_shortcodes: '/user/custom/shortcodes'
```

To add a custom shortcode, create a PHP file that defines a new shortcode class. For example, to create a shortcode for ~~strikethrough~~ text, save the following code as `user/custom/shortcodes/StrikeShortcode.php`:

```php
<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class StrikeShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('strike', function(ShortcodeInterface $sc) {
            return '<del>'.$sc->getContent().'</del>';
        });
    }
}
```

Note that the class name (`StrikeShortcode`) must match the file name for the shortcode to work.

`[strike]text[/strike]` should now produce strikethrough text.

### As a Custom Plugin

The more flexible approach is to create a custom plugin.

The **Shortcode Core** plugin is developed on the back of the [Thunderer Advanced Shortcode Engine](https://github.com/thunderer/Shortcode) and as such loads the libraries and classes required to build third party shortcode plugins.

We introduced a new event called `onShortcodeHandlers()` that allows a 3rd party plugin to create and add their own custom handlers.  These are then all processed by the core plugin in one shot.

```php
    public static function getSubscribedEvents()
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0]
        ];
    }
```

Then you just need to listen to the event:

```php
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }
```

Lastly create your shortcode in the `user/plugins/my-plugin/shortcodes/` folder, in this example we created a simple `[red][/red]` shortcode as `RedShortcode.php`:

```php
<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class RedShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('red', function(ShortcodeInterface $sc) {
            return '<span style="color:red;">'.$sc->getContent().'</span>';
        });
    }
}
```

> If you have not already done so, I suggest reading the [Grav Plugin Tutorial](http://learn.getgrav.org/plugins/plugin-tutorial) first to gain a full understanding of what you need to develop a Grav plugin.

The best way to see how to create a new shortcode-based plugins is to look at the **Shortcode UI** plugin that extends the **Shortcode Core** by adding more shortcodes.  It also makes use of Twig to handle processing and has some more advanced shortcode techniques.

* Core Plugin: https://github.com/getgrav/grav-plugin-shortcode-ui/blob/develop/shortcode-ui.php
* Tabs Shortcode Example: https://github.com/getgrav/grav-plugin-shortcode-ui/blob/develop/shortcodes/TabsShortcode.php
* Color Shortcode Example: https://github.com/getgrav/grav-plugin-shortcode-core/blob/develop/shortcodes/ColorShortcode.php
* Section Shortcode Example: https://github.com/getgrav/grav-plugin-shortcode-core/blob/develop/shortcodes/SectionShortcode.php
* Section Prism Highlight Example: https://github.com/trilbymedia/grav-plugin-prism-highlight/blob/develop/shortcodes/PrismShortcode.php

## Processing Shortcodes Before or After Markdown processing

There are basically two ways of processing a shortcode:

1. After markdown is processed
2. Before markdown is processed

These two approaches are important because, for the most part, shortcodes make more sense when they can 'wrap' markdown, so they process **after** markdown.

For example a `[div][/div]` shortcode would be useless if it ran before markdown is processed because it would add the relevant HTML `<div></div>` tags, and then the markdown parser would promptly **skip** all markdown processing between those divs because it won't process markdown **inside** HTML. So this shortcode and most others run after markdown processing has already occurred using this approach:

```php
$this->shortcode->getHandlers()->add('div', function(ShortcodeInterface $sc) { ... }
```
Notice the `getHandlers()` call is the standard way to add a handler.

However, there are situations when you need to process the shortcode **before** the markdown processing to ensure markdown **is skipped**, like in the example of a code block. This is why in the [Prism Highlighter](https://github.com/trilbymedia/grav-plugin-prism-highlight) plugin, we use this approach to defining the shortcode:

```php
$this->shortcode->getRawHandlers()->add('prism', function(ProcessedShortcode $sc) { ... }
```

The difference here is it uses `getRawHandlers()` to ensure the handler is processed to the content in the _raw_ state.
