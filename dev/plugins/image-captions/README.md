# Image Captions Plugin

Looks for images with defined title attribute and converts them to figure/figcaption syntax.

The **Image Captions** Plugin is for [Grav CMS](http://github.com/getgrav/grav).

This plugin converts the HTML `<img>` tag into a `<figure>` tag with an `<figcaption>` caption.  For example, if you had the following Markdown in your content:

```markdown
![My Image Alt Text](myimage.jpg?classes=caption "My Image Caption")
```

The resulting HTML would be:

```html
<img src="/yourpage/mymage.jpg" alt="My Image Alt Text" title="My Image Caption" class="caption" />
```

And with the plugin enabled, the result would be:

```html
<figure class="image-caption">
    <img src="/yourpage/mymage.jpg" alt="My Image Alt Text" title="My Image Caption" class="caption" />
    <figcaption>My Image Caption</figcaption>
</figure>
```

## Installation

Installing the Image Captions plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line). From the root of your Grav install type:

    bin/gpm install image-captions

This will install the Image Captions plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/image-captions`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `image-captions`. You can find these files on [GitHub](https://github.com/trilbymedia/grav-plugin-image-captions) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/image-captions	

## Configuration

Before configuring this plugin, you should copy the `user/plugins/image-captions/image-captions.yaml` to `user/config/plugins/image-captions.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Enables and disables the plugin.

```yaml
built_in_css: true
```

By default the plugin will load some basic css. See below for details

```yaml
scope: :not(figure) > img.caption
```

You can define the scope in which plugin will operate. This typically should be something to define the specific images, for example the default is to find all `<img>` tags with class `caption` that are not already inside a `<figure>` tag.  You could find all images without a class by simply setting this to `img`.

```yaml
entire_page: false
```

By default the plugin will only search the page content during the `onPageProcessed` event. This ensure maximum speed because the results are cached between page loads.  However you may have the need to use this plugin on pages where an image is output via Twig or other means, in this case you can set this to `true` and the entire page will be processed on each request.

```yaml
figure_class: image-caption
```

You can provide your own class for the `<figure>` tag.

```yaml
figcaption_class: 
```

You can provide your own class for the `<figcaption>` tag.

# Overriding Config Per Page

You can also override any of the plugin settings on a per-page basis by simply including override values in the page frontmatter.  For example:

```
image-captions:
  enabled: false
```

Will disable image-captions on this particular page, or:

```
image-captions:
  figcaption_class: grav-captions 
```

Will set the `figcaption_class` for this particular page.

# Using the Plugin

To use the plugin you simply need to ensure your image HTML output matches the scope defined. For example the default scope is simply `img.caption` to you would need to have a title and the `.caption` class:

```markdown
![](myimage.jpg?classes=caption "This is my caption text")
```

# CSS Classes

The plugin will take any classes set on the original image tag that start with either `caption-` or `figure` and add those to the surrounding `<figure>` tag. The built in CSS provide a few helper CSS classes:

```css
.figure-left        # float the figure to the left of the content
.figure-right       # float the figure to the right of the content
.caption-left       # align the caption to the left of the image
.caption-right      # align the caption to the right of the image
```

By default both the Figure and the Caption are center aligned

To use this you can simply put in our markdown:

```markdown
![](myimage.jpg?classes=caption,figure-right "This is my figure floated right and caption text centered")
```

or 

```markdown
![](myimage.jpg?classes=caption,figure-left,caption-right "This is my figure floated left with caption text aligned right")
```
