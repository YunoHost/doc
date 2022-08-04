# v2.0.3
## 12/03/2021

1. [](#improved)
   * Improved default `scope` to ensure that existing `<figure>` tags are not double-processed
   * Alt attribute as the caption source [#15](https://github.com/trilbymedia/grav-plugin-image-captions/issues/15)
   * Updated vendor libraries

# v2.0.2
## 12/02/2020

1. [](#improved)
  * Updated vendor libraries
  * Use `Page::getRawContent()` rather than `Page::content()` to stop any potential 'looping'

# v2.0.1
## 04/23/2019

1. [](#improved)
  * Updated `didom` library to 1.14.1

# v2.0.0
## 01/31/2019

1. [](#new)
  * Added the ability to override settings per-page [#5](https://github.com/trilbymedia/grav-plugin-image-captions/issues/5)
1. [](#bugfix)
  * Fixed various issues with multiple image captions [#2](https://github.com/trilbymedia/grav-plugin-image-captions/issues/2)

# v1.0.3
## 07/27/2018

1. [](#improved)
    * Remove extra `<p>` tags surrounding figure that breaks W3C validation [#8](https://github.com/trilbymedia/grav-plugin-image-captions/issues/8)
1. [](#bugfix)
    * Remove extra `<html>` and `<body>` tags from output [#9](https://github.com/trilbymedia/grav-plugin-image-captions/pull/9)
    * Extra check for empty content causing out of memory or loop errors [grav#2113](https://github.com/getgrav/grav/issues/2113)

# v1.0.2
## 07/13/2018

1. [](#bugfix)
    * Empty page throws errors [#7](https://github.com/trilbymedia/grav-plugin-image-captions/pull/7)

# v1.0.1
## 12/17/2017

1. [](#bugfix)
    * Empty page throws errors [#1](https://github.com/trilbymedia/grav-plugin-image-captions/issues/1)

# v1.0.0
## 11/15/2017

1. [](#new)
    * ChangeLog started...
