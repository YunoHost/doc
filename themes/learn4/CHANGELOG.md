# v2.0.0-rc.2
## mm/dd/2019

1. [](#improved)
    * Updated [Spectre.css](https://picturepan2.github.io/spectre/) to latest `0.5.8` version

# v2.0.0-rc.1
## 02/07/2019

1. [](#improved)
    * Support for 2FA panel styling
    * Updated to Yarn 4.0 syntax
1. [](#bugfix)
    * Some checkboxes fixes for Forms 3.0
    
# v2.0.0-beta.4
## 12/07/2018

1. [](#improved)
    * Updated to include latest `v1.2.5` improvements

# v2.0.0-beta.3
## 11/12/2018

1. [](#improved)
    * Updated to include latest `v1.2.4` improvements
1. [](#bugfix)
    * More Twig 2.0 compatibility fixes

# v2.0.0-beta.2
## 11/05/2018

1. [](#improved)
    * Updated to include latest `v1.2.3` improvements
1. [](#bugfix)
    * Fixed a Twig 2.0 issue with assets rendering

# v2.0.0-beta.1
## 10/24/2018

1. [](#new)
    * Use new `deferred` Twig blocks (requires Grav 1.6+)
1. [](#improved)
    * Updated to use new `GRAV` core language prefix
    
# v1.2.5
## 12/07/2018

1. [](#improved)
    * Updated [Spectre.css](https://picturepan2.github.io/spectre/) to latest `0.5.7` version
1. [](#bugfix)
    * Fixed missing `</html>` close tag in bae template [#76](https://github.com/getgrav/grav-theme-quark/pull/)    

# v1.2.4
## 11/12/2018

1. [](#improved)
    * Updated [Spectre.css](https://picturepan2.github.io/spectre/) to latest `0.5.5` version
    * Added link support to modular `features` [#39](https://github.com/getgrav/grav-theme-quark/pull/39/)
    * Remove desktop menu when in mobile mode [#59](https://github.com/getgrav/grav-theme-quark/pull/59/)
    * Support modular `text` full-width if no image [#70](https://github.com/getgrav/grav-theme-quark/issues/70)
    * Shim for IE support of BrickLayer.js [#64](https://github.com/getgrav/grav-theme-quark/issues/64)
1. [](#bugfix)
    * Fixed `continue_link:` showing up as toggled [#65](https://github.com/getgrav/grav-theme-quark/issues/65)
    * Fixed issue with modular pages not hidden in on-page menu with `visible: false` [#71](https://github.com/getgrav/grav-theme-quark/issues/71)


# v1.2.3
## 11/05/2018

1. [](#improved)
    * Moved footer into standalone twig to allow for easier extensibility [#63](https://github.com/getgrav/grav-theme-quark/pull/63)
1. [](#bugfix)
    * Fix variable name for prouction mode [#61](https://github.com/getgrav/grav-theme-quark/pull/61)
    * Fix layout size in features blueprint [#67](https://github.com/getgrav/grav-theme-quark/pull/67)
    * Fix active page logic in `nav` so there's no empty class attributes [#68](https://github.com/getgrav/grav-theme-quark/pull/68)
    * Fix for features blueprint because `class` didn't work [#69](https://github.com/getgrav/grav-theme-quark/pull/69)

# v1.2.2
## 10/24/2018

1. [](#improved)
    * Changed nav macro to format supported by Twig 2.0
    * Updated `partials/form-messages.html.twig` to be more inline with latest Forms plugin
1. [](#bugfix)
    * Make the theme to work with Twig auto-escaping turned on
    * Moved language strings under `THEME_QUARK`

# v1.2.1
## 08/23/2018

1. [](#improved)
    * Added additional "mobile custom logo" support
1. [](#bugfix)
    * Addressed some CSS issues by forcing logo height

# v1.2.0
## 08/23/2018

1. [](#new)
    * Added new "custom logo" support [#3](https://github.com/getgrav/grav-theme-quark/issues/3)
    * Added option JSON feed syndication support in sidebar [#47](https://github.com/getgrav/grav-theme-quark/pull/47)
    * Added basic form field `array` styling

# v1.1.0
## 07/25/2018

1. [](#new)
    * Responsive font sizing [#28](https://github.com/getgrav/grav-theme-quark/issues/28)
1. [](#improved)
    * Updated [Spectre.css](https://picturepan2.github.io/spectre/) to latest `0.5.3` version
    * Make blog settings toggleable [#38](https://github.com/getgrav/grav-theme-quark/pull/38)
1. [](#bugfix)
    * Proper fix for sticky footer in IE10 and IE11 [#21](https://github.com/getgrav/grav-theme-quark/issues/21)
    * Fix for lists wrapping weirdly due to `outside` attribute
    * Updated checkbox + radio to take into account `client_side_validation` form option
    * Fixes for fallback values [#37](https://github.com/getgrav/grav-theme-quark/pull/37)
    * Fix inheritance for images folder [#30](https://github.com/getgrav/grav-theme-quark/pull/30)
    * Added blueprint option for `continue_link` [#45](https://github.com/getgrav/grav-theme-quark/issues/45)
    * Added blueprint option for Feature `class` [#14](https://github.com/getgrav/grav-theme-quark/issues/14)
    * Fixed `Duplicate ID` issues with modular sections.  Might break CSS on first load, need to refresh to pick up new CSS [#24](https://github.com/getgrav/grav-theme-quark/issues/24)
    * Fixed Text feature alignment issue [#4](https://github.com/getgrav/grav-theme-quark/issues/4)
    * Overlapping menu and mobile button [#7](https://github.com/getgrav/grav-theme-quark/issues/7)

# v1.0.3
## 05/11/2018

1. [](#new)
    * Added new primary button mixin
1. [](#improved)
    * Updated [Spectre.css](https://picturepan2.github.io/spectre/) to latest `0.5.1` version
    * Improved default login styling
    * Removed core Spectre.css override to make upgrading Spectre easier
    * Added screenshot to README.md
    * Override focus to prevent overzealous blue blurs
1. [](#bugfix)
    * Fix for `highlight` plugin not changing background of code blocks
    * Removed extraneous `dump()` in Twig output

# v1.0.2
## 02/19/2018

1. [](#new)
    * Added toggle options to enable Spectre.css _experimentals_ and _icons_ CSS files
    * Switched to a fork of LineAwesome icons compatible with FontAwesome 4.7.0
1. [](#improved)
    * Font tweaks
1. [](#bugfix)
    * Pagination fixes

# v1.0.1
##  01/22/2018

1. [](#new)
    * Added blueprints for admin editing
1. [](#improved)
    * Use default lang from `site.yaml`
1. [](#bugfix)
    * Fixed Current path to address issues with extending Quark
    * Fixed parallax to start in same position as standard
    * Fixed modular image size

# v1.0.0
##  12/28/2017

1. [](#new)
    * ChangeLog started...
