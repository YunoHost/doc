# Advanced Usage

## Presenting

The plugin, like the Reveal.js-library, makes available a Presenter-mode. There are two modes available for using this: Locally, with `sync: 'browser'`, or remotely, with `sync: 'poll'`. When running locally, you need to access your presentation with a special URL -- `http://yourgrav.tld/book?admin=yes&showNotes=true` -- **and in a new window from the same browser** open the same URL without these parameters -- `http://yourgrav.tld/book`.

The synchronization between Presenter-mode and the Presentation happens by sending data from one browser-window to the other, requiring JavaScript. When running remotely, the synchronization happens by polling and checking if the presentation has changed.

**Note:** The polling approach needs a stable server to work, more so than Grav itself. It has been tested extensively with PHP 7.1 and 7.2, running on Caddy Server and with PHP's built-in server, with a fairly standard production-setup of PHP. If your server-connection crashes with a 502 error -- usually with the error "No connection could be made because the target machine actively refused it.", it is because PHP is set up to forcibly time out despite being long-polled.

## Embedding

A Presentation-shortcode is available for embedding a presentation in another Page; `[presentation="route/to/presentation"]`. This creates an iFrame with the presentation in it. You can also add your own classes to the iFrame with the `class`-parameter: `[presentation src="introduction-to-ux/chromeless:true" class="class-one class-two"]`, or default classes with the `shortcode_classes`-option.

## Twig

Any template can be changed by making a copy of the [plugin's templates](https://github.com/OleVik/grav-plugin-presentation/tree/master/templates) in /user/themes/yourtheme/, and editing it.

### Changing the footer

Using the `footer`-setting you can append a Twig-template to each section globally, or a specific page's section. For example, `footer: "partials/presentation_footer.html.twig"` will render the theme's `partials/presentation_footer.html.twig`-template and append it to the section(s). If the element was constructed like this: `<div class="footer">My footer</div>`, you could style it like this:

```css
.reveal .slides .footer {
  display: block;
  position: absolute;
  bottom: 2em;
}
```

You can also arbitrarily execute Twig within a page's Markdown by enabling it in the FrontMatter with:

```yaml
twig_first: true
process:
  twig: true
```

For example, `<p>{{ site.author.name }}</p>` will render the name of the author defined in site.yaml.

## Creating a menu

The plugin makes a `presentation_menu`-variable available through Twig on pages which use the fullscreen-template, which can be used to construct an overall menu of pages. It is an array with anchors and titles for each page, and a list of them with links to sections can be constructed like this:

```
<ul id="menu" class="menu">
{% for anchor, title in presentation_menu %}
  <li>
    <a href="#{{ anchor }}">{{ title }}</a>
  </li>
{% endfor %}
</ul>
```

Each slide is assigned an `id`-attribute based on the page's slug and its index, as well as a `data-title`-attribute containing the title of the page. A menu could also be made using this data with JavaScript: `document.getElementById('presentation').querySelectorAll('*[id]')`.

## Creating a shortcode or shortcode-alias

In your theme's or plugin's PHP-file, subscribe to the `onShortcodeHandlers`-event and register and/or alias shortcodes:

```php
public static function getSubscribedEvents()
{
    return [
        'onShortcodeHandlers' => ['onShortcodeHandlers', 0]
    ];
}

public function onShortcodeHandlers()
{
    // Register shortcodes
    $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    // Add a shortcode-alias
    $this->grav['shortcode']->getHandlers()->addAlias('link-overlay-alias', 'link-overlay');
}
```

For the `addAlias()`-method, the first parameter is the name of the alias, the second is the original name of the shortcode.
