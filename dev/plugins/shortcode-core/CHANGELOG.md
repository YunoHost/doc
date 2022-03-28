# v5.1.1
## 01/11/2022

1. [](#improved)
    * Improved Twig 2 support
    * Bugfixes to support latest NextGen version (v1.1.8)

# v5.1.0
## 12/09/2021

1. [](#new)
   * Notice shortcode now uses a twig template to allow for easy overriding of style
1. [](#improved)
   * Updated vendor libraries to latest

# v5.0.7
## 09/28/2021

1. [](#improved)
    * Added `processShortcodesRaw()` using raw_handlers [#104](https://github.com/getgrav/grav-plugin-shortcode-core/pull/104)
    * Better vertical alignment for inline shortcodes in NextGen Editor
1. [](#bugfix)
    * NextGen Editor: Ensure content of children shortcode elements, such as UI Tab content, have a new empty line as prefix and suffix, to ensure Markdown lists are not lost [getgrav/grav-premium-issues#123](https://github.com/getgrav/grav-premium-issues/issues/123)

# v5.0.6
## 04/27/2021

1. [](#improved)
    * Added the ability to enable/disable built-in notice CSS
    * NextGen Editor: Added support for multiple editor instances

# v5.0.5
## 03/12/2021

1. [](#bugfix)
    * `SafeEmailShortcode` fixed to be compatible with PHP 7.4
    * Addresses shortcodes getting repeated in modular subpages [#101](https://github.com/getgrav/grav-plugin-shortcode-core/pull/101)

# v5.0.4
## 01/26/2021

1. [](#bugfix)
   * NextGen Editor: Fixed regexp regression preventing multiple shortcodes to be parsed in certain circumstances

# v5.0.3
## 01/15/2021

1. [](#improved)
   * NextGen Editor: Update to support latest version

# v5.0.2
## 12/18/2020

1. [](#improved)
    * NexGen Editor: Added optional `shorthand` to force attributes to full declaration
1. [](#bugfix)
    * NextGen Editor: Fixed regexp preventing attributes with `/` in the value from being captured

# v5.0.1
## 12/02/2020

1. [](#improved)
    * Content editing in settings popup

# v5.0.0
## 11/04/2020

1. [](#new)
    * Added built-in support for **Nextgen Editor** with powerful GUI capabilities for all core shortcodes
    * Support for 3rd party shortcode plugins to add their own **Nextgen Editor** integrations.
1. [](#improved)
    * Support for comma-listed language tags in `[lang]` shortcode: `[lang=dk,se,no,fi]`
    * Support for justified text in align shortcode [#94](https://github.com/getgrav/grav-plugin-shortcode-core/issues/94)
    * Support for asset collections and arrays [#85](https://github.com/getgrav/grav-plugin-shortcode-core/issues/85)
    * Support of `duotone` FontAwesome icons [#78](https://github.com/getgrav/grav-plugin-shortcode-core/issues/78)
1. [](#bugfix)
    * Support HTML in Header shortcode
    
# v4.2.3
## 04/27/2020

1. [](#improved)
    * Configuration option to exclude default shortcodes [#86](https://github.com/getgrav/grav-plugin-shortcode-core/issues/86)
    * Add support for `style` attribute in `[span]` shortcode [#88](https://github.com/getgrav/grav-plugin-shortcode-core/issues/88)  
    * Fix typos [#91](https://github.com/getgrav/grav-plugin-shortcode-core/issues/91) 

# v4.2.2
## 03/04/2020

1. [](#improved)
    * Added second `$options` parameter to `ShortcodeCore->registerAllShortcodes()`, key `ignore` can be used to ignore class names / files from being loaded
1. [](#bugfix)
    * Fix shortcodes which do not override `init()` method, added deprecation notice instead [#82](https://github.com/getgrav/grav-plugin-shortcode-core/issues/82)
    * Fixed error message showing up when updating older versions (<4.2.0) of the plugin [#84](https://github.com/getgrav/grav-plugin-shortcode-core/issues/84)

# v4.2.1
## 02/14/2020

1. [](#improved)
    * Improved shortcode loading, all shortcodes should now extend `Grav\Plugin\Shortcodes\Shortcode` class
1. [](#bugfix)
    * Fixed `Class 'Grav\Plugin\Shortcodes\Shortcode' not found` error when using some plugins
    * Fixed fatal error when trying to instantiate bad shortcodes (they will be skipped instead)

# v4.2.0
## 02/11/2020

1. [](#new)
    * Pass phpstan level 1 tests
    * Added autoload support for registering shortcodes with `$grav['shortcode']->registerShortcode($name)`
    * Moved `ShortcodeObject` classes into `Grav\Plugin\ShortcodeCore` namespace with old alias
1. [](#improved)
    * Major code cleanup

# v4.1.7
## 12/04/2019

1. [](#new)
    * Added a new `[lorem]` shortcode for quickly generating lorem ipsum dummy content
    * Updated Core Thunderer Shortcode library to `0.7.3` for PHP 7.4 compatibility

# v4.1.6
## 10/03/2019

1. [](#improved)
    * Support markdown in `Figure` shortcode caption attribute
    * FlexObjects compatibility: changed references to `Page` class to use `PageInterface`
    * Reworked the `shortcode` twig var to use a class/method approach for better compatibility in modular/page formats
1. [](#bugfix)
    * Fix issue with `[language]` when `include_default_lang: false` [#76](https://github.com/getgrav/grav-plugin-shortcode-core/issues/76)

# v4.1.5
## 09/05/2019

1. [](#improved)
    * Run `onContentProcessed()` event after all other plugins [#75](https://github.com/getgrav/grav-plugin-shortcode-core/issues/75)

# v4.1.4
## 08/11/2019

1. [](#new)
    * Added a new `[details][/details]` shortcode [#72](https://github.com/getgrav/grav-plugin-shortcode-core/pull/72)
1. [](#improved)
  * Fixed regression issue introduced in v1.4.3 [#73](https://github.com/getgrav/grav-plugin-shortcode-core/issues/73)

# v4.1.3
## 08/09/2019

1. [](#improved)
  * Fix for shortcode objects not being available. For example `[section][/section]` not working previously without `process: twig: true`
  * `README.md` improvements 

# v4.1.2
## 06/22/2019

1. [](#new)
  * Added new `h#` tags for `h1` through `h6` supporting `class` and `id` attributes
1. [](#improved)
  * Make `ShortcodeManager::setStates()` more flexible to accept any type of object  

# v4.1.1
## 04/23/2019

1. [](#improved)
  * Updated Core Thunderer Shortcode library to `0.7.2`

# v4.1.0
## 04/14/2019

1. [](#new)
    * Support for a `ShortCodeManager::getRawHandlers()` to support shortcodes that need to process **before** Markdown (like upcoming `Prism-Highlighter`)

# v4.0.1
## 03/21/2019

1. [](#new)
    * Added a new `[mark][/mark]` shortcode which makes highlighting in code blocks much simpler!

# v4.0.0
## 03/20/2019

1. [](#improved)
    * Improved way to handle shortcodeAssets from `Page::contentMeta()` - Fixes numerous issues
    * Allow `size` shortcode to handle non-numeric values (e.g. `%`, `x-large`, etc.) [#63](https://github.com/getgrav/grav-plugin-shortcode-core/pull/63)
    * Added FontAwesome 5 support [#56](https://github.com/getgrav/grav-plugin-shortcode-core/pull/56)

# v3.1.2
## 03/15/2019

1. [](#improved)
    * Added a helper method to allow `getBbCode()` to work with `wordpress` parser

# v3.1.1
## 03/12/2019

1. [](#bugfix)
    * Reverted accidental change of default parser.  Should be `regular`

# v3.1.0
## 02/28/2019

1. [](#improved)
    * Modified priority of `onPluginsInitialized` to fire earlier
1. [](#bugfix)
    * New language shortcode, for example `[lang=en]...[/lang]`

# v3.0.1
## 02/03/2019

1. [](#bugfix)
    * Fixed issues with `0` param and `regular` parser [#14](https://github.com/getgrav/grav-plugin-shortcode-core/issues/14) [#57](https://github.com/getgrav/grav-plugin-shortcode-core/issues/57) [shortcode-ui#29](https://github.com/getgrav/grav-plugin-shortcode-ui/issues/29) [shortcode-ui#6](https://github.com/getgrav/grav-plugin-shortcode-ui/issues/26)

# v3.0.0
## 12/19/2018

1. [](#new)
    * Update to latest Shortcode library `v0.7.0` which has over **10X performance** for default regular parser
    * Added an option `admin_pages_only` to only process actual `user/pages/` based pages and not dynamic pages to increase performance

# v2.7.3
## 12/07/2018

1. [](#new)
    * Added a new `figure` shortcode [#51](https://github.com/getgrav/grav-plugin-shortcode-core/pull/51)
1. [](#bugfix)
    * Fix empty space at the end of a line [#54](https://github.com/getgrav/grav-plugin-shortcode-core/pull/54)

# v2.7.2
## 10/26/2018

1. [](#new)
    * Added a new `span` shortcode that supports `class` and `id` attributes
1. [](#improved)
    * Switched default parser to `regular`
    * Using latest `dev-master` version which has a couple of key fixes

# v2.7.1
## 03/14/2018

1. [](#improved)
    * Support shortcodes in theme as well as plugins [#43](https://github.com/getgrav/grav-plugin-shortcode-core/issues/43)

# v2.7.0
## 01/16/2018

1. [](#new)
    * Added a new `div` shortcode that supports `class` and `id` attributes

# v2.6.0
## 04/25/2017

1. [](#new)
    * Added ability to define a custom shortcode path for you own shortcodes [#36](https://github.com/getgrav/grav-plugin-shortcode-core/issues/36)
    * Added a twig filter to allow you to use shortcodes directly in Twig templates [#33](https://github.com/getgrav/grav-plugin-shortcode-core/pull/33)

# v2.5.4
## 02/26/2017

1. [](#bugfix)
    * Fixed issue with modular Shortcode meta was not getting processed properly (Assets, Sections, etc.)

# v2.5.3
## 02/21/2017

1. [](#improved)
    * Added a reference to current Page in `ShortcodeManager`

# v2.5.2
## 01/26/2017

1. [](#bugfix)
    * Fixed Mozilla column css prefix

# v2.5.1
## 01/25/2017

1. [](#improved)
    * Added `moz-` prefix in column shortcode

# v2.5.0
## 01/25/2017

1. [](#new)
    * Added **new** `columns` shortcode for CSS columns support

# v2.4.0
## 01/17/2017

1. [](#improved)
    * Switched to `Regex` parser by default (previous was Regex)
    * Update to latest Shortcode library v0.6.5
1. [](#bugfix)
    * Removed `getParameterAt(0)` hack in favor of `getBbbCode()` that works with Regex parser

# v2.3.2
## 12/15/2016

1. [](#improved)
    * Update to latest Shortcode library v0.6.4 to address a parser bug [#25](https://github.com/getgrav/grav-plugin-shortcode-core/issues/25)

# v2.3.1
## 07/14/2016

1. [](#improved)
    * renamed internal `contentMeta` variables to `shortcodeMeta` and `shortcodeAssets`
    * Update to latest Shortcode library

# v2.3.0
## 05/20/2016

1. [](#improved)
    * Use new conentmeta approach from Grav 1.1

# v2.2.1
## 05/09/2016

1. [](#bugfix)
    * Always initialize current page even if collection exists [#3](https://github.com/getgrav/grav-plugin-shortcode-ui/issues/3)

# v2.2.0
## 04/23/2016

1. [](#new)
    * Added **new** `fa` FontAwesome shortcode

# v2.1.0
## 04/21/2016

1. [](#new)
    * Added **new** `notice` shortcode
1. [](#improved)
    * Updated to latest Shortcode library version

# v2.0.2
## 02/17/2016

1. [](#bugfix)
    * Initialized states in constructor

# v2.0.1
## 02/16/2016

1. [](#improved)
    * Support **modular** pages by populating Twig variables in `onTwigPageVariables()` event #8
1. [](#bugfix)
    * Better more flexible regex in the Markdown **block** definition for more reliable markdown in shortcodes. #3

# v2.0.0
## 02/11/2016

1. [](#new)
    * Added **new** `section` shortcode
    * Use new `contentMeta` mechanism for storing/caching objects and assets per page
    * Added new `ShortcodeManager::reset()` methods
1. [](#improved)
    * Completely refactored the plugin to use a new extensible mechanism that makes it easier to manage multiple shortcodes

# v1.4.0
## 02/03/2016

1. [](#improved)
    * Updated Shortcode to latest `dev-master` that includes Events
1. [](#bugfix)
    * Fixed `raw` shortcode to use new `FilterRawEventHandler` so it doesn't process shortcodes at all

# v1.3.0
## 01/29/2016

1. [](#improved)
    * Added markdown-shortcode-block support to the plugin
1. [](#bugfix)
    * Updated Core Thunderer Shortcode library with some important fixes

# v1.2.0
## 01/25/2016

1. [](#improved)
    * Customizable Parser.  Choose from `WordPress`, `Regex`, and `Regular`

# v1.1.0
## 01/24/2016

1. [](#improved)
    * Updated to latest Shortcode `dev-master` version that contains some important fixes
    * Switched to `WordPressParser` for 2x speed improvements

# v1.0.1
## 01/18/2016

1. [](#bugfix)
    * Fixed blueprint
    * Fixed a default yaml state


# v1.0.0
## 01/18/2016

1. [](#new)
    * ChangeLog started...
