# v2.1.1
## 04/14/2021

1. [](#bugfix)
    * Fixed a check for loading problem classes [#32](https://github.com/getgrav/grav-plugin-problems/issues/32)
    * Regression: folders check fails in Windows [#31](https://github.com/getgrav/grav-plugin-problems/issues/31)

# v2.1.0
## 04/13/2021

1. [](#new)
    * Requires **Grav 1.7.11**
    * Support running Grav outside webroot [#29](https://github.com/getgrav/grav-plugin-problems/pull/29)
    * Added check whether `user/accounts` is writable [#25](https://github.com/getgrav/grav-plugin-problems/issues/25)
    * Not all folders need to be writable, reflect that [#30](https://github.com/getgrav/grav-plugin-problems/pull/30)
    * Added check whether JSON extension is installed
1. [](#improved)
    * Updated plugin code to the latest standards
1. [](#bugfix)
    * Fixed `onFatalException` being handled/rendered when in CLI and in Admin

# v2.0.3
## 05/09/2019

1. [](#new)
    * Code cleanup
    * Pass `phpstan` tests
    * Added `ru` and `uk` translations [#23](https://github.com/getgrav/grav-plugin-problems/pull/23)

# v2.0.2
## 12/16/2018

1. [](#bugfix)
    * Fixed an issue with checker not being initialized on Fatal Error

# v2.0.1
## 12/07/2018

1. [](#new)
    * Added support for admin reporting available in Grav 1.6
1. [](#bugfix)
    * Fixed issue with twig auto-escaping
    * Fixed problems plugin potentially breaking CLI command if plugins get initialized

# v2.0.0
## 09/30/2018

1. [](#new)
    * Completely rewritten to be much more flexible
    * New _class_ based problems architecture for unified problem definition and reporting
    * New `onProblemsInitialized()` plugin event for 3rd party plugins to add their own problem checks
    * New more intuitive theme based on Spectre.css to display problems
    * Storage of problem state to allow for displaying in admin plugin
    * Now with 3 states `critical`, `warning`, and `notice`.  Only critical will stop the site working.
    * Added some new PHP module checks
    * Added a new `umask` permission check
1. [](#improved)
    * Implemented extra image checks [#17](https://github.com/getgrav/grav-plugin-problems/pull/17)

# v1.4.7
## 05/16/2017

1. [](#improved)
    * Added check for Exif module if this feature is enabled

# v1.4.6
## 02/17/2017

1. [](#improved)
    * Return 500 error code if there is a problem instead of 200 [https://github.com/getgrav/grav/issues/1291](https://github.com/getgrav/grav/issues/1291)

# v1.4.5
## 09/14/2016

1. [](#bugfix)
    * Show the correct status for the Zip extension check

# v1.4.4
## 09/08/2016

1. [](#new)
    * Added check for new root folder `tmp` and try to create if missing
1. [](#bugfix)
    * Fixed Whoops error if `backup` folder doesn't exist and cannot be created

# v1.4.3
## 05/27/2016

1. [](#new)
    * Reverted compression checks

# v1.4.2
## 05/23/2016

1. [](#new)
    * Check for compression issues

# v1.4.1
## 05/03/2016

1. [](#new)
    * Added a check for XML support in PHP
1. [](#improved)
    * Use common language strings in blueprints

# v1.4.0
## 01/06/2016

1. [](#improved)
    * Avoid generating errors on .DS_Store files added to the bin/ folder by OSX
    * Removed executable checks for bin/* commands. Going to document instead.

# v1.3.3
## 12/09/2015

1. [](#new)
    * Set minimum PHP requirements to 5.5.9
1. [](#improved)
    * Ensure problems plugin runs before admin

# v1.3.2
## 12/09/2015

1. [](#improved)
    * Skip windows platforms for executable permissions check
    * Removed mod_headers from required Apache modules check

# v1.3.1
## 12/07/2015

1. [](#improved)
    * Added executable check on `/bin/` files

# v1.3.0
## 12/07/2015

1. [](#improved)
    * Added check for PHP `OpenSSL`, `Mbstring` and `Curl` are installed
    * Added check to ensure `mod_rewrite` and `mod_headers` are installed if running Apache

# v1.2.0
## 08/25/2015

1. [](#improved)
    * Added blueprints for Grav Admin plugin

# v1.1.6
## 06/16/2015

2. [](#new)
    * Try to create missing `backup` folder if it is missing

# v1.1.5
## 05/09/2015

2. [](#new)
    * Added check for `backup` folder for Grav > 0.9.27

# v1.1.4
## 04/26/2015

2. [](#new)
    * Changelog started

