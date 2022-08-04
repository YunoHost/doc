# v1.6.3
## 01/26/2021

1. [](#improved)
    * Updated plugin blueprints for Grav 1.7

# v1.6.2
## 10/28/2019

1. [](#improved)
  * FlexObjects compatibility: change references to `Page` class to use `PageInterface`
  * Updated Grav requirements to 1.6 or greater (thanks to [@mahagr](https://github.com/mahagr) for the heads-up)

# v1.6.1
## 07/12/2018

3. [](#bugfix)
  * Fixed parsing tags other than links [#24](https://github.com/Sommerregen/grav-plugin-external-links/pull/24) (Fix loading of a href element)

# v1.6.0
## 02/22/2018

1. [](#new)
  * Check for page redirects [#22](https://github.com/Sommerregen/grav-plugin-external-links/pull/22) (Check for redirecting pages if `links.redirects` is enabled, thanks to [@karfau](https://github.com/karfau))
2. [](#improved)
  * Set `rel="noopener noreferrer"` to all external links [#21](https://github.com/Sommerregen/grav-plugin-external-links/issues/21)
  * Updated French translation strings [#19](https://github.com/Sommerregen/grav-plugin-external-links/pull/19)
  * Improved `README.md` and YAML files

# v1.5.3
## 02/18/2017

3. [](#bugfix)
  * Fixed Russian translation strings [#17](https://github.com/Sommerregen/grav-plugin-external-links/pull/17) (Thanks to [@geschke](https://github.com/geschke) for the fast PR)

# v1.5.2
## 02/17/2017

1. [](#new)
  * Added Russian translations [#16](https://github.com/Sommerregen/grav-plugin-external-links/pull/16) (Thanks to [@ktaranov](https://github.com/ktaranov))

# v1.5.1
## 02/10/2017

3. [](#bugfix)
  * Fixed error in getting the remote image size

# v1.5.0
## 02/09/2017

2. [](#improved)
  * Use tabs in admin panel settings for better user experience
  * Use toggle buttons for page settings

# v1.4.4
## 01/11/2017

3. [](#bugfix)
  * Fixed `CURLOPT_AUTOREFERER` constant

# v1.4.3
## 10/31/2016

3. [](#bugfix)
  * Fixed [#11](https://github.com/Sommerregen/grav-plugin-external-links/issues/11) (Not working with cache enabling) (see PR [#15](https://github.com/Sommerregen/grav-plugin-external-links/pull/15))
  * Fixed [#13](https://github.com/Sommerregen/grav-plugin-external-links/issues/13) (Preferences Not Showing)

# v1.4.2
## 12/06/2015

1. [](#new)
  * Added French translations [#8](https://github.com/Sommerregen/grav-plugin-external-links/pull/8) (Thanks to [@MATsxm](https://github.com/MATsxm))

# v1.4.1
## 11/18/2015

2. [](#improved)
  * Page specific options now respect the default configurations set in the admin panel

# v1.4.0
## 11/17/2015

1. [](#new)
  * Added `External Links` options to page options tab
2. [](#improved)
  * Improved `isExternalUrl` function to allow custom schemes and whether to evaluate links beginning with `.www` or not
  * Added more blueprint options
  * Improved code
  * Updated docs
3. [](#bugfix)
  * Fixed [#7](https://github.com/Sommerregen/grav-plugin-external-links/issues/7) (Possible issue with malformed URLs)
  * Fixes `external_links` filter function

# v1.3.1
## 09/09/2015

2. [](#improved)
  * Added blueprints for Grav Admin plugin
3. [](#bugfix)
  * Fixed [#5](https://github.com/Sommerregen/grav-plugin-external-links/issues/5) (Works on first page displayed)
  * Fixed [#6](https://github.com/Sommerregen/grav-plugin-external-links/issues/6) (Validation failed: title is not defined in blueprints)

# v1.3.0
## 08/08/2015

1. [](#new)
  * Added admin configurations **(requires Grav 0.9.34+)**
  * Added multi-language support **(requires Grav 0.9.33+)**
  * Added default title message for external links
2. [](#improved)
  * Switched to `onBuildPagesInitialized` event **(requires Grav 0.9.29+)**
  * Updated `README.md`
3. [](#bugfix)
  * Fixed [#4](https://github.com/Sommerregen/grav-plugin-external-links/issues/4) (Problem with non UTF-8 characters)

# v1.2.2
## 05/10/2015

2. [](#improved)
  * PSR fixes

# v1.2.1
## 03/24/2015

3. [](#bugfix)
  * Fixed active `mode` condition

# v1.2.0
## 02/21/2015

1. [](#new)
  * Added option `mode` to parse links passively (where no CSS classes are set) and actively
2. [](#improved)
  * Allow multiple classes to exclude in option `exclude.classes`
  * Improved process engine to ensure not to alter HTML tags or HTML entities in content
  * Refactored code

# v1.1.3
## 02/10/2015

3. [](#bugfix)
  * Fixed self-closing tags in HTML5 and ensured to return contents compliant to HTML(5)

# v1.1.2
## 02/10/2015

1. [](#new)
  * By default `External Links` now uses the class `external-links` for CSS styling; using `external` is still possible e.g. for manually markup external links
2. [](#improved)
  * Improved usage example in `README.md`
3. [](#bugfix)
  * Fixed [#1](https://github.com/Sommerregen/grav-plugin-external-links/issues/4) (Issue with LightSlider plugin)

# v1.1.1
## 02/06/2015

1. [](#new)
  * Added usage example in `README.md`
  * Add icons next to external links via CSS when using class `external` only
2. [](#improved)
  * Added support for HHVM **(requires Grav 0.9.17+)**
  * Added modular pages support
3. [](#bugfix)
  * Fixed regular expression in `isExternalUrl($url)` method

# v1.1.0
## 02/05/2015

1. [](#new)
  * IMPORTANT: Changed names of external link classes with images to `image`, `images` and `no-image`
2. [](#improved)
  * Improved readability of code
  * Updated plugin to use new `mergeConfig` method of Grav core
  * Improved and corrected calculations of image size
3. [](#bugfix)
  * Fixed some typo in the documentation
  * Fixed and removed additional `<body>` tag from page content

# v1.0.1
## 01/29/2015

1. [](#improved)
  * Fixed minor issues (broken README link, removed debugging functions)

# v1.0.0
## 01/29/2015

1. [](#new)
  * ChangeLog started...
