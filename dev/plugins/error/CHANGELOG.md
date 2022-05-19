# v1.8.0
## 09/07/2021

1. [](#new)
    * Require **Grav 1.7.0**
    * Added support for `{% throw 404 'Not Found' %}` from twig template to show the error page
1. [](#improved)
    * Do not cache 404 error pages by default

# v1.7.1
## 10/08/2020

1. [](#bugfix)
    * Fixed error page being cached, fixes issue with non-existing resources which later become available

# v1.7.0
## 07/01/2020

1. [](#new)
    * Require Grav v1.6
1. [](#bugfix)
    * Added translated title programmatically [#40](https://github.com/getgrav/grav-plugin-error/pull/40)
    
# v1.6.2
## 05/09/2019

1. [](#new)
    * Fixed a few issues found by phpstan
    * Added `ru` and `uk` translations [#36](https://github.com/getgrav/grav-plugin-error/pull/36)

# v1.6.1
## 03/09/2018

1. [](#improved)
    * Added Polish + Catalan translation
    * Updated `README.md` to reference custom error pages

# v1.6.0
## 10/19/2016

1. [](#improved)
    * Added Croatian translation
    * Improved `autoescape: true` support
1. [](#bugfix)
    * Fixed issue where template file for `error` page type is only available if page was not found

# v1.5.1
## 07/18/2016

1. [](#improved)
    * Added chinese and german translations
1. [](#bugfix)
    * Fixed issue with the Smartypants plugin running before Twig was processed

# v1.5.0
## 07/14/2015

1. [](#improved)
    * Translate some blueprint configuration options
    * Allow translating the error message
    * Added french, russian, romanian, danish, italian

# v1.4.1
## 12/11/2015

1. [](#bugfix)
    * Fixed CLI command for PHP 5.5 and lower

# v1.4.0
## 11/21/2015

1. [](#new)
    * Implemented CLI commands for the plugin

# v1.3.0
## 08/25/2015

1. [](#improved)
    * Added blueprints for Grav Admin plugin

# v1.2.2
## 01/06/2015

1. [](#new)
    * Added a default `error.json.twig` file

# v1.2.1
## 11/30/2014

1. [](#new)
    * ChangeLog started...
