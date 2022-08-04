# v1.8.5
## 06/09/2021

1. [](#improved)
   * Rolled back the URL check functionality as it caused more issues than it solved.

# v1.8.4
## 06/07/2021

1. [](#improved)
    * Added a configurable `enable_url_check` (default `true`) to disable the URL checking if you run into an issue.
1. [](#bugfix)
    * More robust URL checking including multi-lang versions [#62](https://github.com/getgrav/grav-plugin-feed/issues/62)

# v1.8.3
## 05/28/2021

1. [](#bugfix)
    * Fixed issue with feeds at the root of a site [#61](https://github.com/getgrav/grav-plugin-feed/issues/61)

# v1.8.2
## 05/21/2021

1. [](#bugfix)
    * Fixed issue with json feed type corrupting other json requests [getgrav/grav-premium-issues#102](https://github.com/getgrav/grav-premium-issues/issues/102)
    * Fixed issue with modular pages showing up in feed
      

# v1.8.1
## 05/21/2021

1. [](#bugfix)
    * Provide a default language if multi-language not enabled

# v1.8.0
## 12/02/2020

1. [](#new)
    * Require Grav v1.6
    * Pass phpstan level 1 tests
1. [](#improved)
    * Major plugin overhaul [#57](https://github.com/getgrav/grav-plugin-feed/pull/57)    
    * Bumped the default image sizes in atom/rss

# v1.7.1
## 05/09/2019

1. [](#bugfix)
    * Fix issue with Feed Options not showing up in Quark (and other themes) [#46](https://github.com/getgrav/grav-plugin-feed/issues/46)

# v1.7.0
## 04/15/2019

1. [](#improved)
    * Use `safe_truncate_html` [#41](https://github.com/getgrav/grav-plugin-feed/pull/41)
    * Allow full-text feeds [#37](https://github.com/getgrav/grav-plugin-feed/pull/37)
    * Dynamic json feed header and image file support [#32](https://github.com/getgrav/grav-plugin-feed/pull/32)
    * Added `json` link example to `README.md`
1. [](#bugfix)
    * Changed type `text` to `range` to prevent validation errors [#45](https://github.com/getgrav/grav-plugin-feed/issues/45)
    * Always show route in url for self-link [#38](https://github.com/getgrav/grav-plugin-feed/pull/38)

# v1.6.2
## 06/06/2017

1. [](#bugfix)
    * Fix issue with feeds not rendering with cache enabled [#27](https://github.com/getgrav/grav-plugin-feed/pull/27)

# v1.6.1
## 05/30/2017

1. [](#improved)
    * Improved JSON template to `json_encode()` all output
1. [](#bugfix)
    * Optimized logic to disable JSON feeds by default and only set the template when there's a collection

# v1.6.0
## 05/25/2017

1. [](#new)
    * Added support for new JSON feed format by @RosemaryOrchard [#21](https://github.com/getgrav/grav-plugin-feed/pull/21)

# v1.5.3
## 04/12/2017

1. [](#bugfix)
    * Fix a truncate issue [#16](https://github.com/getgrav/grav-plugin-feed/pull/16)

# v1.5.2
## 02/17/2017

1. [](#bugfix)
    * Fix issue on non-collection pages [#14](https://github.com/getgrav/grav-plugin-feed/pull/14)

# v1.5.1
## 01/24/2017

1. [](#bugfix)
    * Add support for Twig `Autoescape variables` mode

# v1.5.0
## 07/14/2016

1. [](#improved)
    * Make Feeds 'language-safe'

# v1.4.1
## 10/07/2015

1. [](#bugfix)
    * Avoid duplicated routes

# v1.4.0
## 08/26/2015

1. [](#improved)
    * Added blueprints for Grav Admin plugin

# v1.3.3
## 03/24/2015

1. [](#improved)
    * Feed will now skip pages with `feed: skip: true` in frontmatter
1. [](#bugfix)
    * Fixed page overrides for configuration

# v1.3.2
## 02/19/2015

1. [](#bugfix)
    * Fixed couple of RSS validation issues

# v1.3.1
## 12/26/2014

1. [](#bugfix)
    * Fixed issue with default configuration not being loaded yet

# v1.3.0
## 11/30/2014

1. [](#new)
    * ChangeLog started...
