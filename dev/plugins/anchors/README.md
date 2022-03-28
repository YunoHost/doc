# Grav Anchors Plugin


`anchors` is a [Grav](http://github.com/getgrav/grav) plugin that provides automatic header anchors via the [anchorjs](http://bryanbraun.github.io/anchorjs) Vanilla JS plugin.

# Installation

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm).  From the root of your Grav install type:

    bin/gpm install anchors

## Manual Installation

If for some reason you can't use GPM you can manually install this plugin. Download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `anchors`.

You should now have all the plugin files under

	/your/site/grav/user/plugins/anchors

# Usage

To best understand how Anchors works, you should read through the original [project documentation](https://github.com/bryanbraun/anchorjs).

## Show Menu of Anchors

If you want to use the generated links to also generate a menu from these anchors, just put the function below in the template file Twig:

```
{{ anchors(content, tag, terms) }}
```

The function accepts 3 parameters:

* **content:** this parameter is the content of the page in which the function will search for all content and separate only the tags and their contents defined by the second parameter. E.g. `page.content`
* **tag:** this parameter will be the string of the tag used to make the menu. E.g. `h2`
* **terms:** this parameter is to exclude terms that you do not wish to include in the menu formation that is between the tag passed in the second parameter. The value passed is a string separated by comma to identify each term. Ex: `title 01, title 02`

For example:

```
{{ anchors(page.content, 'h2') }}
```

When rendered the function will return a formed HTML with `<ul>` and the links of the anchors in each `<li>`.

## Configuration:

Simply copy the `user/plugins/breadcrumbs/anchors.yaml` into `user/config/plugins/anchors.yaml` and make your modifications.

    enabled: true                 # enable or disable the plugin
    active: true                  # active by default, if false then you must activate per-page
    selectors: 'h1,h2,h3,h4'      # css elements to activate on.  Uses jQuery style selectors
    placement: right              # either "left" or "right"
    visible: hover                # Active on "hover" or "always" visible
    icon:                         # default link or a specific character like: #, ¶, ❡, and §.
    class:                        # adds the provided class to the anchor html
    truncate: 64                  # truncates the generated ID to the specified character length

You can override any default settings from the page headers:

eg:

    ---
    title: Sample Code With Custom Theme
    anchors:
        active: true
        selectors: .blog h1, .blog h2
    ---

    # Header

    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas accumsan porta diam,
    nec sagittis odio euismod nec. Etiam eu rutrum eros.

    ## Sub Header

    Proin commodo lobortis elementum.
    Integer vel ultrices massa, nec ornare urna. Phasellus tincidunt rutrum dolor, vestibulum
    faucibus ligula laoreet id. Donec hendrerit arcu vitae lacus mattis facilisis. Praesent
    tortor nibh, pulvinar nec orci ac, rhoncus pharetra nunc.


You can also disable anchors for a particular page if causes issues:

    ---
    title: Sample Code with Highlight disabled
    anchors:
        active: false
    ---

    # Header

    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas accumsan porta diam,
    nec sagittis odio euismod nec. Etiam eu rutrum eros.

    ## Sub Header

    Proin commodo lobortis elementum.
    Integer vel ultrices massa, nec ornare urna. Phasellus tincidunt rutrum dolor, vestibulum
    faucibus ligula laoreet id. Donec hendrerit arcu vitae lacus mattis facilisis. Praesent
    tortor nibh, pulvinar nec orci ac, rhoncus pharetra nunc.


> Note: If you want to see this plugin in action, have a look at [Grav Learn Site](http://learn.getgrav.org)
