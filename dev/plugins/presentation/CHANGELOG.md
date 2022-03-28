# v4.0.3
## 10-04-2021

1. [](#improved)
   - More theme-select redundancy

# v4.0.2
## 20-01-2021

1. [](#improved)
   - Theme-select redundancy

# v4.0.1
## 19-07-2020

1. [](#bugfix)
   - Language-string for advanced options

# v4.0.0
## 15-07-2020

1. [](#new)
   - Stable release of 4.0.0

# v4.0.0-beta.2
## 15-07-2020

1. [](#improved)
   - Twig-extensions namespacing

# v4.0.0-beta.1
## 12-07-2020

1. [](#bugfix)
   - Re-processing content with Parsedown broke slides
2. [](#new)
   - `process`-option

# v3.1.4-beta.1
## 12-07-2020

1. [](#bugfix)
   - Flexibility in declaring styles from config and FrontMatter
   - Reinstate `reveal_init` initialization
2. [](#improved)
   - Stricter type-checking on styles

# v3.1.3
## 23-05-2020

1. [](#bugfix)
   - Fix transport for styles

# v3.1.2
## 10-02-2020

1. [](#bugfix)
   - Reduce reliance on config()

# v3.1.1
## 09-02-2020

1. [](#bugfix)
   - Handle null-values saved by Admin

# v3.1.0
## 09-02-2020

1. [](#new)
   - Enable ParsedownExtra when set in system.yaml
2. [](#bugfix)
   - Variable in blueprints.yaml and languages.yaml

# v3.0.2
## 01-10-2019

1. [](#bugfix)
   - Testing-parameter is useless, let me have Semantic Versioning!

# v3.0.1
## 01-10-2019

1. [](#new)
   - Release 3.0.1

# v3.0.0-beta.1
## 15-09-2019

1. [](#improved)
   - Align content processing with Shortcode Core (https://github.com/getgrav/grav-plugin-shortcode-core/issues/75#issuecomment-531596152)

# v2.1.0
## 09-08-2019

1. [](#improved)
   - Defer assets loading (#11)
   - README
   - Blueprints

# v2.0.3
## 17-07-2019

1. [](#bugfix)
   - Blank value fallback in shortcode-processing

# v2.0.2
## 22-06-2019

1. [](#improved)
   - Cache-manipulation
   - Config-retrieval

# v2.0.1
## 10-06-2019

1. [](#bugfix)
   - API-interface alignment

# v2.0.0
## 10-06-2019

1. [](#new)
   - Backward-incompatible API-changes
   - Simplified shortcode-processing
2. [](#improved)
   - Prevent Twig-caching
   - Fragment-parsing
   - Shortcode-handling through Transport
   - Styles-handling through Parser
   - API-selection in blueprints
   - Default textsizing-scale and breakpoint-check
3. [](#bugfix)
   - Data-shortcode handling

# v1.7.4
## 03-06-2019

1. [](#new)
   - Trim quotes in iframe-shortcode

# v1.7.3
## 03-06-2019

1. [](#new)
   - Test GPM wickedness, take 2

# v1.7.2
## 03-06-2019

1. [](#new)
   - Test GPM wickedness

# v1.7.1
## 01-06-2019

1. [](#new)
   - Stable release of refactor

# v1.7.1-beta.10
## 31-05-2019

1. [](#improved)
   - Revert 'Initialize API earlier', do it indirectly

# v1.7.1-beta.9
## 31-05-2019

1. [](#improved)
   - Versions
   - Deprecate 'v' from tags

# v1.7.1-beta.8
## 31-05-2019

1. [](#improved)
   - Initialize API earlier
   - Refactor Parser->interpretShortcodes()
   - Parse Shortcodes with Thunderer/Shortcode
2. [](#new)
   - Option for Shortcode Parser

# v1.7.1-beta.7
## 19-05-2019

1. [](#bugfix)
   - Test composer backport of Shortcode Code

# v1.7.1-beta.6
## 15-05-2019

1. [](#bugfix)
   - Page.find for Presentation-shortcode

# v1.7.1-beta.5
## 15-05-2019

1. [](#improved)
   - Pass Page to Presentation-shortcode template

# v1.7.1-beta.4
## 14-05-2019

1. [](#new)
   - README: Creating a shortcode or shortcode-alias
   - README: Twig
   - README: Contributing
2. [](#improved)
   - Split docs into parts
   - Link Overlay method
3. [](#bugfix)
   - Image-scaling
   - Autoloading

# v1.7.1-beta.3
## 13-05-2019

1. [](#bugfix)
   - Maximize image width

# v1.7.1-beta.2
## 13-05-2019

1. [](#bugfix)
   - Shortcode Core backfill for Packagist

# v1.7.1-beta.1
## 12-05-2019

1. [](#new)
   - Packagist-release
   - Require Shortcode Core as a dependency
   - Link Overlay shortcode
   - Presentation shortcode: `presentation_base_url` replaced by `base_url`
2. [](#improved)
   - PSR-4 handling through Composer

# v1.7.0-beta.1
## 11-05-2019

1. [](#bugfix)
   - Shortcode-parameters
2. [](#improved)
   - Handle iFrame-interaction
   - README: Backgrounds
   - README: Shortcode-parameters

# v1.6.8
## 11-05-2019

1. [](#bugfix)
   - Admin-detection (#8)
   - Slide-rendering (#9)
2. [](#improved)
   - Controls in slide-blueprint

# v1.6.7
## 05-05-2019

1. [](#improved)
   - Box-sixing, margins for blockquote

# v1.6.6
## 20-04-2019

1. [](#new)
   - Version

# v1.6.5
## 19-04-2019

1. [](#new)
   - Option to load all assets
1. [](#improved)
   - Background-image URL and search

# v1.6.4
## 06-04-2019

1. [](#improved)
   - Plugin default style specificity
2. [](#bugfix)
   - Move plugin default-styles to top-level element
   - Revert ordering-query in CSS
   - Print: CSS, reinitialize background images

# v1.6.3
## 17-03-2019

1. [](#bugfix)
   - Correct ordering-query in CSS

# v1.6.2
## 17-03-2019

1. [](#bugfix)
   - Correct ordering in CSS

# v1.6.1
## 16-03-2019

1. [](#bugfix)
   - Compress CSS
   - Slides ordering with z-index

# v1.6.0
## 13-03-2019

1. [](#new)
   - Alignment-options
2. [](#improved)
   - Allow default styles from plugin options
   - Blueprints structure, language-strings
3. [](#bugfix)
   - Horizontal- and textsizing-option logic
   - Changelog-formatting
   - Remove defaults from blueprints

# v1.5.2
## 23-02-2019

1. [](#improved)
   - Changelog-formatting

# v1.5.1
## 23-02-2019

1. [](#improved)
   - Do not render custom buttons unless Presentation is initially saved

# v1.5.0
## 22-02-2019

1. [](#improved)
   - Override blueprints from Theme or user-folder

# v1.4.2
## 15-02-2019

1. [](#improved)
   - Option for default Shortcode Class
   - Class-parameter for Shortcode

# v1.4.1
## 14-02-2019

1. [](#bugfix)
   - Shortcodes

# v1.4.0
## 13-02-2019

1. [](#improved)
   - Add support for Aria-attributes and role

# v1.3.2
## 08-02-2019

1. [](#new)
   - YouTube-plugin CSS fix

# v1.3.1
## 03-02-2019

1. [](#improved)
   - Save-functionality

# v1.3.0
## 31-01-2019

1. [](#improved)
   - Save-functionality
   - Blueprints.yaml

# v1.2.7-beta.3
## 31-01-2019

1. [](#bugfix)
   - Node Modules

# v1.2.7-beta.2
## 31-01-2019

1. [](#improved)
   - Save-functionality

# v1.2.7-beta.1
## 31-01-2019

1. [](#new)
   - Non-scrolling save-functionality in Admin
   - Non-scrolling auto-save-functionality in Admin
2. [](#improved)
   - Events- and API-handling
   - Code-formatting

# v1.2.6
## 18-01-2019

1. [](#improved)
   - Page-linking from Admin to new tab/window

# v1.2.5
## 17-01-2019

1. [](#improved)
   - Code-tag wrapping and color
   - README

# v1.2.4
## 16-01-2019

1. [](#improved)
   - Revise Page-linking from Admin
2. [](#bugfix)
   - Inline FontAwesome icons
   - Preset theme CSS or paper.css in Print-mode, not both

# v1.2.3
## 16-01-2019

1. [](#improved)
   - Page-linking from Admin to styled and annotated print-page

# v1.2.2
## 15-01-2019

1. [](#bugfix)
   - Page-linking from Admin

# v1.2.1
## 15-01-2019

1. [](#improved)
   - Apply Modular Scales via PHP and CSS
2. [](#bugfix)
   - Fix foreach-loop in Transport->setStyle()
   - Fix textsizing-class application
   - Add default 1:1 scale
   - Fix modular-scale.js calculations and events

# v1.2.0
## 14-01-2019

1. [](#new)
   - First stable release
2. [](#improved)
   - Apply Modular Scale everywhere onLoad
   - Dropped Textsize Base for Textsize Modifier
   - Reorder logic Content API
   - Simplify and extend Parser::unwrapImage()
3. [](#bugfix)
   - Textsizing-class application
   - Audio-element support
   - Various cleanup

# v1.2.0-beta.3
## 11-01-2019

1. [](#new)
   - CSS and JS option for plugin assets
   - Recast Styles API as Transport API
2. [](#improved)
   - Optimize assets, breakpoints
   - Disallow empty API-options
   - Swap Bootstrap Reboot for Normalize.css

# v1.2.0-beta.2
## 11-01-2019

1. [](#improved)
   - Breakpoints as array-field

# v1.2.0-beta.1
## 11-01-2019

1. [](#new)
   - Customizable breakpoints
2. [](#improved)
   - Textsizing-logic
   - Purer implementation of Modular Scales

# v1.1.0-beta.7
## 09-01-2019

1. [](#bugfix)
   - Presentation-shortcode

# v1.1.0-beta.6
## 09-01-2019

1. [](#new)
   - Presentation-shortcode
   - Presentation-shortcode styles
2. [](#bugfix)
   - Fire textsizing on Reveal ready
   - Links in blueprints
   - Asset groups

# v1.1.0-beta.5
## 08-01-2019

1. [](#improved)
   - README
   - Blueprints and languages
   - Replaced general color-option with one for header and one for block text
   - Modular scale sizes
2. [](#new)
   - Horizontal-option
3. [](#bugfix)
   - Cast textsizing-properties as float

# v1.1.0-beta.4
## 08-01-2019

1. [](#bugfix)
   - Fix support for font-family
   - Fix textsizing-application, again

# v1.1.0-beta.3
## 08-01-2019

1. [](#bugfix)
   - Fix textsizing-application

# v1.1.0-beta.2
## 08-01-2019

1. [](#bugfix)
   - Missing Event
   - Blueprints

# v1.1.0-beta.1
## 08-01-2019

1. [](#new)
   - API Interfaces
   - Custom Content option
   - Custom Parser option
   - Custom Styles option
   - Merge Page-header presentation-options
2. [](#improved)
   - Refactor API
   - Code Quality
   - PHP 7 Features

# v1.0.0-beta.2
## 06-01-2019

1. [](#bugfix)
   - Assets
   - Content API instantiation

# v1.0.0-beta.1
## 06-01-2019

1. [](#new)
   - Page-links from Admin
2. [](#improved)
   - Blueprints and languages
   - Print-capability
   - Cleanup
3. [](#bugfix)
   - Token-auth

# v0.0.7
## 05-01-2019

1. [](#new)
   - Dynamic, responsive text-sizing
   - Switch to border-box sizing
   - Token-auth for Poll API and Broadcast Channel
   - Fragment-handling
2. [](#improved)
   - Content-handling
   - Responsive styling
   - Poll API garbage collection and stability
   - Made API Route configurable
   - Blueprints and languages

# v0.0.6
## 29-12-2018

1. [](#new)
   - Data-attributes from styles
   - Enabled Poll API
   - Added customizable API route, polling timeout
   - Responsive media-queries
2. [](#improved)
   - Flexbox-structure on slides
   - Renamed Push API to Poll API
   - Renamed `sync`-setting from `api` to `poll`
   - Poll API PHP, JS, blueprints
   - Poll API resource-handling
   - Presentation-template

# v0.0.5
## 27-12-2018

1. [](#new)
   - Content API
2. [](#improved)
   - Broke up Utilities into Content API
   - Broke up Content API methods
   - Cascading blueprint-options for Plugin, Presentation, Slide
   - Options-handling in blueprint
   - Tweaked plugin's CSS

# v0.0.4
## 27-12-2018

1. [](#new)
   - Blueprints, translations
2. [](#improved)
   - Code-quality, code standards
   - README
   - Simplify plugin CSS
   - Improve template

# v0.0.3
## 12-12-2018

1. [](#new)
   - Images are unwrapped from paragraphs by default
   - Switch from UiB-theme to general Presentation-theme
   - Deprecation of Fullpage-settings
2. [](#improved)
   - Code-quality
   - README

# v0.0.2
## 10-11-2018

1. [](#new)
   - Slide-blueprint
   - Translations
   - Added support for ambiguous CSS-properties in FrontMatter
   - Added footer-template
   - Added optional support of Nomnoml diagrams
   - Added debugger-support
2. [](#improved)
   - Cleaned JS init
   - Started cleaning plugin options
   - Started cleaning Utilities class

# v0.0.1
## 07-11-2018

1. [](#new)
   - Alpha public release
