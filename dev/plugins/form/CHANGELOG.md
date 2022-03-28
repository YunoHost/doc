# v6.0.0
## 03/28/2022

1. [](#improved)
    * Added log warning when trying to access form by non-unique name
    * Optimized form caching by not initializing the forms in `onPageProcessed` event anymore
    * **BACKWARD COMPATIBILITY**: As form initialization has been delayed, logic relaying on `onPageProcessed` with forms may not work anymore
1. [](#bugfix)
    * Fixed select field where option is iterable (#558)
    * Fixed `FormPlugin::getForm()` to properly search the current page first
    * Fixed `FormPlugin::getForm()` to ignore fallback if the page was given as parameter
    * Fixed dynamic forms to work with cache turned on
    * Fix nested `toggleable`: originalValue now checks with `??` instead of `is defined`

# v5.1.7
## 03/14/2022

1. [](#new)
    * Added `access` support for buttons
2. [](#bugfix)
   * Fixed tabs in the frontend to ensure JS is loaded
   
# v5.1.6
## 02/07/2022

1. [](#bugfix)
    * Fixed Select field when using OptGroups, not allowing key/values [#541](https://github.com/getgrav/grav-plugin-form/issues/541)
    * Support for translatable OptGroup labels in Select field [#540](https://github.com/getgrav/grav-plugin-form/issues/540)

# v5.1.5
## 01/24/2022

1. [](#bugfix)
    * Fixed case in selectize field where custom new entries would not be stored in non `multiple` lists

# v5.1.4
## 11/16/2021

1. [](#bugfix)
    * Fixed buttons no longer rendered [#537](https://github.com/getgrav/grav-plugin-form/issues/537) 
    * Allow `select` field to customize `autocomplete` attribute

# v5.1.3
## 10/26/2021

1. [](#new)
    * Require **Grav 1.7.24**
    * Added support to disable a form, making it readonly
    * Added `|value_and_label` Twig filter to convert options to value/label pairs
1. [](#improved)
    * Improved Twig function `include_form_field()` to allow the second parameter to be an array of layouts

# v5.1.2
## 09/29/2021

1. [](#improved)
    * Improved support for Twig 2/3

# v5.1.1
## 09/14/2021

1. [](#new)
    * Require **Grav 1.7.21**
1. [](#bugfix)
    * Fixed accidental admin plugin requirement for YAML filter in the form
    * Fixed `GravForm.config` JS to have correct `current_url` and `current_params` settings
    * Fixed custom file upload and remove routes
    * Fixed bug where uploading file has no effect [#349](https://github.com/getgrav/grav-plugin-form/issues/349)
    * Fixed field with numeric field name in `prepare_form_fields()` [#530](https://github.com/getgrav/grav-plugin-form/issues/530)

# v5.1.0
## 08/31/2021

1. [](#new)
    * Require **Grav 1.7.19**
    * Added support for custom form layouts
    * Added Twig function `prepare_form_fields()` and `prepare_form_field()` to prepare form fields and field array
    * Added Twig function `include_form_field()` to get all include paths for the field type
    * Make `nonce` to a customizable field
1. [](#bugfix)
    * Fixed bad cookie value for remembering the position of nested tabs

# v5.0.3
## 06/15/2021

1. [](#improved)
   * Removed the windows `\r\n` line breaks + extraneous escaping in `data.txt.twig`
   * Use `base64_encode` filter rather than function

# v5.0.2
## 04/23/2021

1. [](#improved)
   * Better message for invalid nonce [#513](https://github.com/getgrav/grav-plugin-form/issues/513)
   * Better error if `Form::getPage()` gets called too early [#518](https://github.com/getgrav/grav-plugin-form/issues/518)
   * Added support for custom Toggle id

# v5.0.1
## 03/17/2021

1. [](#improved)
   * Updated `de` language [#510](https://github.com/getgrav/grav-plugin-form/pull/510)
   * Better field type definitions for avatar and file fields
1. [](#bugfix)
   * Fixed toggle highlight when there's no value
   * Fixed wrong selected values in `select` field with integer and boolean values
   * Fixed changelog display [#502](https://github.com/getgrav/grav-plugin-form/pull/502)

# v5.0.0
## 02/17/2021

1. [](#new)
   * Requires **Grav 1.7.0**
   * Allow admins to temporarily disable form process actions by setting the value to `false` [#481](https://github.com/getgrav/grav-plugin-form/pull/481)
1. [](#improved)
   * Add `id` attribute to hidden field [#495](https://github.com/getgrav/grav-plugin-form/pull/495)
   * Escape text as YAML in multi-line textarea [#464](https://github.com/getgrav/grav-plugin-form/pull/464)
1. [](#bugfix)
   * Fixed reCaptcha v3 incompatibility with multiple forms on the same page sharing different actions [#416](https://github.com/getgrav/grav-plugin-form/issues/416)
   * Toggle fields do not save `false` if they are `toggleable` [#497](https://github.com/getgrav/grav-plugin-form/issues/497)
   * Data template fixes [#494](https://github.com/getgrav/grav-plugin-form/pull/494)
   * Fix deprecated Twig method

# v4.3.1
## 01/31/2021

1. [](#improved)
   * Updated deprecated `Twig_SimpleFunction` code
   * Added Lithuanian translation [#485](https://github.com/getgrav/grav-plugin-form/pull/485)
1. [](#bugfix)
   * Fixed state of the checkbox if no value is provided
   * Fixed evaluating default value in `hidden` field (thanks @NicoHood)
   * Fixed default value to come from the `Form` in overridable field (thanks @NicoHood)
   * Fix for disabling `client_side_validation` [#482](https://github.com/getgrav/grav-plugin-form/pull/482)
   * Fix for translations in `select` field in data template [#475](https://github.com/getgrav/grav-plugin-form/pull/475)
   * PHPDoc fixes 

# v4.3.0
## 12/14/2020

1. [](#new)
    * Added a new ‘condition’ attribute for tab for logic to process if it should display or not
1. [](#improved)
    * Added priority to form translations/config
1. [](#bugfix)
    * Fix admin access check [#463](https://github.com/getgrav/grav-plugin-form/pull/463)

# v4.2.0
## 12/02/2020

1. [](#improved)
    * Added support for arbitrary `attributes` on `form`, `textarea` and `checkbox` and `buttons`. [#447](https://github.com/getgrav/grav-plugin-form/issues/447) [#448](https://github.com/getgrav/grav-plugin-form/issues/448)
    * Better support for array field key/value when either key or value are left empty
    * Allow data-* form parameters to be used as <form> attributes. [#336](https://github.com/getgrav/grav-plugin-form/pull/336) 
    * Allow action param when including form partial [#410](https://github.com/getgrav/grav-plugin-form/pull/410)  
    * Also support validate min/max for textarea [#455](https://github.com/getgrav/grav-plugin-form/pull/455)  
    * Translate form labels also in text file [#444](https://github.com/getgrav/grav-plugin-form/pull/448)
1. [](#bugfix)
    * Fixed KeepAlive issue where too large of a session value would fire the keep alive immediately
    * Fixed stringable objects breaking the inputs
    * Remove unused route variable from `file` field
    * Fix condition for required attribute in toggle field [#451](https://github.com/getgrav/grav-plugin-form/pull/451)
    * Fix form data template when select field is set to multiple [#452](https://github.com/getgrav/grav-plugin-form/pull/452)  
    * Fix has-errors for select and other fields [#454](https://github.com/getgrav/grav-plugin-form/pull/454)
    * Fix #453 section title level [#459](https://github.com/getgrav/grav-plugin-form/pull/459)

# v4.1.2
## 10/07/2020

1. [](#bugfix)
    * Added some missing class attributes

# v4.1.1
## 09/01/2020

1. [](#bugfix)
    * Key field should not escape the value

# v4.1.0
## 07/29/2020

1. [](#new)
    * Support JSON based form submissions
1. [](#improved)
    * Improved handling of error messages with more details + translation [#428](https://github.com/getgrav/grav-plugin-form/pull/428) [#429](https://github.com/getgrav/grav-plugin-form/pull/429)
    * Various improvements for nested form data in  `data.html.twig` and `data.txt.twig`
    * Use `|length` rather than `|count` twig filter
    * Various language updates
1. [](#bugfix)
    * Disabled the EXIF library for Dropzone for fixing the orientation as it was getting applied twice [#1923](https://github.com/getgrav/grav-plugin-admin/issues/1923)
    * Forked Dropzone fo fix issue with Resize + EXIF orientation [#1923](https://github.com/getgrav/grav-plugin-admin/issues/1923)

# v4.0.10
## 06/08/2020

1. [](#improved)
    * Updated languages
1. [](#bugfix)
    * Fixed redirect causing empty form on homepage forms with no action set

# v4.0.9
## 06/03/2020

1. [](#bugfix)
    * Fixed bad `id` attribute on `checkbox` field [#421](https://github.com/getgrav/grav-plugin-form/issues/421)
    * Show the `description` span even for an empty description [#313](https://github.com/getgrav/grav-plugin-form/pull/313)

# v4.0.8
## 04/30/2020

1. [](#bugfix)
    * Fixed issue with `force_bool` in `toggle` field to be more robust

# v4.0.7
## 04/27/2020

1. [](#new)
    * Added ability to hide form fields in `data.html.twig` and `data.txt.twig` with `field.store: false`
1. [](#improved)
    * Updated node dependencies
    * Added new `force_bool: true|false` option to `toggle` field to cast strings for use in BC situations
1. [](#bugfix)
    * Fix markdown links in changelog [#415](https://github.com/getgrav/grav-plugin-form/pull/415)

# v4.0.6
## 03/19/2020

1. [](#new)
    * CHANGE: Form labels are now displayed in `raw` format so you can use HTML in them
    * Added support for `name` attribute on buttons [#411](https://github.com/getgrav/grav-plugin-form/issues/411)
1. [](#improved)
    * Added support for `classes` option in `avatar` field
    * Recompiled JS with latest NPM libraries
1. [](#bugfix)
    * Fixed password field outputting the contents to HTML (will now always be empty when loading the page)
    * Escape default output in `formdata.html.twig` [#384](https://github.com/getgrav/grav-plugin-form/issues/384)
    * Better JS rendering of captcha field scripts for VueJS template compatibility

# v4.0.5
## 03/05/2020

1. [](#bugfix)
    * Fixed form actions that post to page anchors should not have current base_url added (e.g. `#contact-us`)
    * Fixed toggleable buttons no longer holding false state [#406](https://github.com/getgrav/grav-plugin-form/issues/406)

# v4.0.4
## 02/25/2020

1. [](#bugfix)
    * Fix for `enctype` in multipart forms [#408](https://github.com/getgrav/grav-plugin-form/issues/408)

# v4.0.3
## 02/11/2020

1. [](#new)
    * Pass phpstan level 1 tests

# v4.0.2
## 02/03/2020

1. [](#improved)
    * Allow checkbox field to have custom value, default to 1
1. [](#bugfix)
    * Fixed `toggle` field not working with `toggleable: true`
    * Fixed fatal error when form type is disabled

# v4.0.1
## 01/02/2020

1. [](#improved)
    * Improve Grav 1.7 support by not using deprecated `$page->modular()` call
    * Use form scope if it is defined
1. [](#bugfix)
    * Fixed bad HTML in select, radio, key, toggle, checkbox ad textarea when using tabindex attribute
    * Fixed bad looking `tabs` field with a single tab in admin

# v4.0.0
## 11/06/2019

1. [](#new)
    * Added `tabindex` to global attributes of default field
    * Add ability to Sanitize SVGs on upload (Grav 1.7+ required)
1. [](#improved)
    * Deprecate `select_optgroup` as `select` can handle optgroups now
    * Added missing tabindex checks
    * Refactored field inheritance to make things more reliable
    * Removed jQuery dependency for the reCaptcha field and VanillaJS-ified it instead
    * Removed a stray `dump()` command
    * Refactored the base `templates/forms/default` twig templates to make things more extensible
    * Added a new `templates/forms/layouts` set of twit templates to allow for easier customization
1. [](#bugfix)
    * Fixed `Badly encoded JSON data` warning when uploading files [grav#2663](https://github.com/getgrav/grav/issues/2663)
    * Fixed a number of escaping issues [#368](https://github.com/getgrav/grav-plugin-form/issues/368)

# v3.0.9
## 09/19/2019

1. [](#improved)
    * Removed jQuery dependency for the reCaptcha field and VanillaJS-ified it instead
    * Updated to ReCaptcha library version `1.2.3`
1. [](#bugfix)
    * Fixed `Badly encoded JSON data` warning when uploading files [grav#2663](https://github.com/getgrav/grav/issues/2663)

# v3.0.8
## 08/14/2019

1. [](#improved)
    * Change form save action location to `user-data://` stream [#353](https://github.com/getgrav/grav-plugin-form/issues/353)
    * Updated `eu`, `fr` and `pl` language
    * Make `Form::initialize()` chainable
    * Added `folder` option to `save:` action with fallback
1. [](#bugfix)
    * Fixed Submit & Redirect not working as expected [#355](https://github.com/getgrav/grav-plugin-form/issues/355)
    * Fixed oversensitive refresh prevention [#354](https://github.com/getgrav/grav-plugin-form/issues/354)
    * Fixed issue with Form JS when pipeline is enabled [grav#2592](https://github.com/getgrav/grav/issues/2592)
    * Fixed `accept` for SVG in file field [#364](https://github.com/getgrav/grav-plugin-form/pull/364)
    * Fixed issue with plugin not returning expected form [#309](https://github.com/getgrav/grav-plugin-form/pull/309)
    * Fixed form message not showing up after reset process
    * Fixed form fields inside a single tab not using value from the form object if it is available
    * Fixed file form field failing resolution checks in certain circumstances

# v3.0.7
## 07/01/2019

1. [](#bugfix)
    * Fixed file upload when `$grav['user']` is not set [#352](https://github.com/getgrav/grav-plugin-form/issues/352)
    * Fixed label markdown being escaped [#356](https://github.com/getgrav/grav-plugin-form/pull/356)

# v3.0.6
## 06/24/2019

1. [](#bugfix)
    * Fixed regression breaking forms external to the page in some sites
    * Fixed regression with form action in sub-path folders

# v3.0.5
## 06/21/2019

1. [](#new)
    * Added support for form state saving with dynamic unique id appended to the URL
1. [](#improved)
    * Avoid creating form state if there is no data to be saved
1. [](#bugfix)
    * Fixed missing check for maximum allowed files in `files` field
    * Fixed unique form ids getting cached, they should change on every page reload

# v3.0.4
## 06/14/2019

1. [](#improved)
    * Captcha field: fail silently and display error in console if site_key was not defined
    * Support inline-errors, prepend, append in `textarea`
1. [](#bugfix)
    * Use less-strict comparison when checking version 3 [#344](https://github.com/getgrav/grav-plugin-form/issues/344)

# v3.0.3
## 05/09/2019

1. [](#new)
    * Added Text `field.copy-to-clipboard` which can be used by admin plugin
1. [](#bugfix)
    * Fixed Flex route issue in list page
    * Fix flex-height of signature field
    * Fix for broken `field.recaptcha_site_key` [#344](https://github.com/getgrav/grav-plugin-form/issues/344)
    * Fix for checkbox data lang string [#343](https://github.com/getgrav/grav-plugin-form/issues/343)
    * Fix for duplicate inline error messages [#337](https://github.com/getgrav/grav-plugin-form/issues/337)
    * Fixed bad folder permissions when creating folder for file uploads

# v3.0.2
## 04/22/2019

1. [](#new)
    * Support for Google Recaptcha theme (light/dark) doesn't work in v3 yet.
1. [](#improved)
    * Visual upgrade for form field descriptions [#335](https://github.com/getgrav/grav-plugin-form/pull/335)
1. [](#bugfix)
    * Fixed issue with `recaptcha_not_validated` property not being used

# v3.0.1
## 04/15/2019

1. [](#new)
    * Added support for form task in blueprint
1. [](#bugfix)
    * Fix url field output in list view

# v3.0.0
## 04/11/2019

1. [](#new)
    * Allow streams in `file` field widget [#119](https://github.com/getgrav/grav-plugin-form/issues/119)
    * Use new unified `|t` translate filter in all fields
    * Google reCAPTCHA v3 support added
    * Google reCAPTCHA v2 Invisible support added
    * Added mutliple forms with reCAPTCHA support
    * Form no longer extends `Grav\Common\Iterator` (may have some backward compatibility issues with plugins, likely not)
    * Form now uses `NestedArrayAccessWithGetters` (with '/' separator) and `FormTrait` traits
    * Added `view`, `key`, `ignore`, `section`, `toggle`, `tabs` and `tab` form fields
    * Added support for `toggleable` inputs, which can be disabled/enabled by user
    * Added `$grav['forms']` to allow plugins to better use forms [#307](https://github.com/getgrav/grav-plugin-form/pull/307)
    * Added support for custom form types
    * Forms can now remember their state after page reload with YAML `datasets: store-state: true` set in the fields
    * Added `clear-state` AJAX task
    * Added task to clear form flash
    * Added support for file-upload and file-remove tasks
    * Added ability to set a custom `clear_redirect_url` on a form
    * Added `Form::setMessage()` method
    * Added new form field templates for edit list table
    * Requires Grav 1.6.0-beta.7 (and optionally Admin 1.9.0-beta.7)
    * Backwards incompatibility: Do not allow static `Form::getNonce()` call, only `$form->getNonce()` works now
    * Backwards incompatibility: All form field twig files are required to extend `field.html.twig` to work properly
    * Allow using custom nonce field/action by setting `nonce.name` and `nonce.action` inside the form YAML
    * Added `html: true` support for form buttons (will not escape the button value)
    * Added `toggle`, `tabs` and `tab` form fields
    * Added support for toggleable inputs, which can be disabled/enabled by user
    * Added proper support for hiding form fields in blueprints by using dynamic property like `security@: admin.foobar` to any field
1. [](#improved)
    * Make fields `formname`, `uniqueid` and `honeypot` non-inputs in form validation
    * Update all Form classes to rely on `PageInterface` instead of `Page` class
    * Removed `media.upload_limit` references
    * Added field type `hidden` to `ip` and `timestamp` actions
    * Improved the `hidden` field logic to support `value` or `default` set
    * Set the message globally on `messages` object when using a redirect in form
    * Improved logic for finding the current form
    * Added support for data-sets in `textarea` and `select` fields
    * Simplify `shouldProcessForm()` logic
    * Do not cache flat forms list, regenerate it instead
    * Fixed some inconsistencies on how blueprints are handled
    * Improved uploads handling, added new `upload: true|false` process
    * Make `Form` implement `FormInterface`
    * Added `field.size` in `array`, `select`, and `textarea`
    * Enable forms in admin plugin
    * Removed submit of unchecked fields in frontend
    * Make sure that the images in the file field are not cached in browser
    * Updated code to use PHP 7.1 features
    * Added some extra blocks to `file` field to make it more extensible
    * Added `field.classes` to form field to allow customization
    * Used Google reCAPTCHA API all token validation
    * Better filename and mime type handling
    * Now using the new core Grav language prefix
    * Make all form fields to extend `field.html.twig`
1. [](#bugfix)
    * Fixed old way to access form name
    * Fixed minor bugs
    * Fixed null date/time in list view
    * Fixed forms not being cached properly
    * Fixed issue with `selectize`, automatically selecting an unintended value
    * Throw exception if you try to `add` to a file and don't provide `filename` [#324](https://github.com/getgrav/grav-plugin-form/issues/324)
    * Fixed file field saving with nested name
    * Fixed file saving if destination folder does not exist
    * Fixed FormFlash object not getting deleted on form post
    * Regression: Fixed ignored form action [#318](https://github.com/getgrav/grav-plugin-form/issues/318)
    * Regression: Fixed modular form submit not triggering the action sometimes
    * Fixed modular form submits without defined `action: /path` inside the form
    * Fixed form processing in nested modular pages
    * Fixed container fields breaking values from the child fields
    * Fixed form fields not accepting object values
    * Fixed some form fields having no value for nested field sets
    * Fixed double escaping of `file` type input JSON value
    * Fixed double locking of file when calling processor save
    * Fixed some missing backwards compatibility
    * Fixed some issues with flashed form
    * Fixed Twig 2 compatibility issue
    * Fixed files uploading before captcha check
    * Fixed files uploading before data has been stored
    * Fixed some issues with reCAPTCHA v3
    * Fixed error responses when file actions fail in the form
    * Pass unique_id when uploading files if available

# v2.16.4
## 12/14/2018

1. [](#improved)
    * Better handling of invalid file names during upload
    * Better MIME type checking of files during file upload
    * Do not rely on jQuery for merging languages from form fields [#290](https://github.com/getgrav/grav-plugin-form/issues/290) [#291](https://github.com/getgrav/grav-plugin-form/issues/291)
2. [](#bugfix)
    * Remove jQuery dependency in form.html.twig (#290)
3. [](#new)
    * Added Object.assign-polyfill (#291)

# v2.16.3
## 09/21/2018

1. [](#improved)
    * Use `Url:post()` to get the `$_POST` variable (allows common security checks/filtering for the POST data)
    * Various JS tweaks and enhancements
1. [](#bugfix)
    * Fixed issue where `select` set up as `multiple` and with `selectize: create: true` would not properly merge newly created values on rendering.

# v2.16.2
## 08/23/2018

1. [](#improved)
    * Switched to new Grav `Yaml` class to support Native + Fallback YAML libraries
    * Simple styling fixes for `array` field
1. [](#bugfix)
    * Fixed issue with translations of placeholder text in `array` field

# v2.16.1
## 08/20/2018

1. [](#new)
    * Fixed a regression issue with `file` & `array` field

# v2.16.0
## 08/20/2018

1. [](#new)
    * Added new `form.keep_alive` option to keep session alive [#275](https://github.com/getgrav/grav-plugin-form/issues/275)
    * Added `array` field for frontend use
1. [](#improved)
    * Improving compatibility `autocomplete` spec [#274](https://github.com/getgrav/grav-plugin-form/pull/274)

# v2.15.1
## 06/20/2018

1. [](#improved)
    * Including EXIF JS library in the modules dependencies to fix orientation when uploading images
1. [](#bugfix)
   * Fix HTML data template for checkboxes fields where 'use' property is "keys" [#258](https://github.com/getgrav/grav-plugin-form/pull/258)

# v2.15.0
## 05/31/2018

1. [](#new)
    * Added support for `Uri::post()`
    * Added support for `autocapitalize`, `inputmode`, and `spellcheck` options in field definitions

# v2.14.1
## 05/15/2018

1. [](#bugfix)
    * Fixed regression with select field, causing issues with filepicker field [grav-plugin-admin#1441](https://github.com/getgrav/grav-plugin-admin/issues/1441)

# v2.14.0
## 05/11/2018

1. [](#new)
    * Make `pagemedia` field available outside of pages context
    * Added option on fields to disable displaying of label (`display_label: false`)
    * Moved Dropzone HTML into an overridable Twig template
    * Added support for image upload delete in Dropzone `file` field
1. [](#improved)
    * Added support for `optgroup` within select field
    * Save forms only once (stops extra work being done)
    * Allow file field to pass dropzone options
    * Added datasets support to fields
    * Added `field.classes` support to display field
1. [](#bugfix)
    * Removed overridden class in `password` field
    * Worked around forms being lost if form cache expired before page cache, see [#240](https://github.com/getgrav/grav-plugin-form/pull/240)
    * Fixed default form in dynamically created page if header uses `forms` instead of old `form` field
    * Escape placeholder text in default field

# v2.13.3
## 04/13/2018

1. [](#new)
    * Added support to save form data in raw format (yaml or json)
    * Added new `timestamp` action to add a timestamp field

# v2.13.2
## 04/12/2018

1. [](#new)
    * Added event `onFormPrepareValidation` to allow some pre-processing before form validation
    * Added new `postfix` and `dateraw` options to "Save" action
1. [](#improved)
    * Added support for `nest_id` boolean flag to `fieldset` field to nest sub-fields with name of fieldset
    * Added classes attribute to `spacer` field
1. [](#bugfix)
    * Fixed `Form::setFields()` causing validation to fail on added and removed fields

# v2.13.1
## 03/21/2018

1. [](#improved)
    * CAPTCHA fallback to `cURL` if `Fopen` is not allowed [#224](https://github.com/getgrav/grav-plugin-form/pull/244)
    * Use `visibility:hidden` rather than `display:none` for honeypot field [#235](https://github.com/getgrav/grav-plugin-form/pull/235)
    * Added support for markdown in checkbox field [#233](https://github.com/getgrav/grav-plugin-form/pull/233)
    * Added option to control `inline_css: true|false` for fields such as honeypot
    * Added class and CSS for honeypot field

# v2.13.0
## 03/09/2018

1. [](#new)
    * Forced registration of `Form` page template for admin
    * Implemented support for `resolution` setting for images in file field
    * Implemented support for `resizeWidth`, `resizeHeight`, `resizeQuality` and updated Dropzone to latest version
    * Added a new `signature` field
1. [](#improved)
    * Force an `onPageProcessed()` event if page cache expires before form cache [#240](https://github.com/getgrav/grav-plugin-form/pull/240)
1. [](#bugfix)
    * Fixed an issue where unlimited size `0` was not being set properly in File field
    * `field.description` now translated and displays properly

# v2.12.0
## 02/22/2018

1. [](#new)
    * Added toggle to enable/disable client-side HTML5 validation
    * Added toggle to enable/disable inline-error messages
1. [](#improved)
    * Reformatted `form.php` plugin class for better readability
1. [](#bugfix)
    * Fixed an issue with in-content Twig forms not working because forms were not initialized yet


# v2.11.5
## 02/16/2018

1. [](#new)
    * Added support for `form: process: - call: ['Class', 'method']` for custom form handling
1. [](#bugfix)
    * Fixed regression in v2.11.4: Call to a member function post() on null [grav#1720](https://github.com/getgrav/grav/issues/1720)

# v2.11.4
## 02/15/2018

1. [](#improved)
    * Stopped Chrome from auto-completing admin user profile form [grav#1847](https://github.com/getgrav/grav/issues/1847)
    * Start using composer to autoload classes
    * Added support for `switch` to be treated as checkbox
1. [](#bugfix)
    * Fixed missing form submit in dynamically created pages

# v2.11.3
## 01/31/2018

1. [](#new)
    * Added support for `file` in **Display** field. Allows the ability to read a file and output it, works in combination with `|markdown` filter
    * Added `minlength` and `maxlength` to **Textarea** field [#231](https://github.com/getgrav/grav-plugin-form/pull/231)

# v2.11.2
## 01/22/2018

1. [](#new)
    * Added support for markdown in all form fields for `label`, `help`, and `description` when `markdown: true` is set on field

# v2.11.1
## 12/18/2017

1. [](#improved)
    * Updated default fields to make them more consistent with class names

# v2.11.0
## 12/05/2017

1. [](#new)
    * Added ability to set `novalidate: true` on form definition to turn off all HTML5 form validation
1. [](#improved)
    * Improved logic to handle dynamically added forms to be more reliable
    * Added Dutch Translation [#207](https://github.com/getgrav/grav-plugin-form/pull/207)
    * Improved both HTML and JSON error output by utilizing `form.status`
    * Code Cleanup
1. [](#bugfix)
    * Fix AJAX response message and wrong status [#211](https://github.com/getgrav/grav-plugin-form/pull/211)
    * Escaped YAML to form save action to prevent parsing errors [#206](https://github.com/getgrav/grav-plugin-form/pull/206)
    * Fixed RU translations [#204](https://github.com/getgrav/grav-plugin-form/pull/204)
    * Fixed nonce check fail not setting status to `error` [#213](https://github.com/getgrav/grav-plugin-form/issues/213)
    * Fixed validation fail not setting status to `error` [#209](https://github.com/getgrav/grav-plugin-form/issues/209)
    * Catch ValidationException to avoid potential fatal error
    * Fixed regression issue on reset fields
    * Removed `required` attribute in individual checkboxes as it forces all to be checked
    * Security fix to ensure file uploads are not manipulated mid-post - thnx @FLH!

# v2.10.0
## 10/26/2017

1. [](#new)
    * Added ability to 'remember' field values in cookie between submissions [#200](https://github.com/getgrav/grav-plugin-form/pull/200)
1. [](#improved)
    * Added back improved `filesize` option that falls back to PHP file upload limits by default [#202](https://github.com/getgrav/grav-plugin-form/issues/202)
    * Added missing file upload options into blueprints and language files
    * Added the ability for a form to have an `http_response_code` and use it for `form-messages.html.twig` (requires Grav v1.3.6+)

# v2.9.3
## 10/11/2017

1. [](#improved)
    * Removed `filesize` plugin configuration in favor of `system.media.upload_limit`
    * Consolidated `field.classes` and `field.wrapper_classes` in radio/checkbox/checkboxes [#193](https://github.com/getgrav/grav-plugin-form/issues/)
    * Remove trailing slash from form action [#195](https://github.com/getgrav/grav-plugin-form/issues/195)
    * Improved `honeypot` validation check [#198](https://github.com/getgrav/grav-plugin-form/issues/198)

# v2.9.2
## 09/30/2017

1. [](#improved)
    * Improved Polish translation
1. [](#bugfix)
    * Added missing `@input: false` attributes to some non-display fields [#189](https://github.com/getgrav/grav-plugin-form/issues/189)

# v2.9.1
## 09/14/2017

1. [](#bugfix)
    * Fixed backwards compatibility issue with conditional field [#188](https://github.com/getgrav/grav-plugin-form/pull/188)

# v2.9.0
## 09/07/2017

1. [](#new)
    * Added **Refresh Prevention** capabilities (Not enabled by default) [#184](https://github.com/getgrav/grav-plugin-form/issues/184)
    * Added support for field `attributes` [#176](https://github.com/getgrav/grav-plugin-form/pull/176)
    * Added global variables for setting form classes
    * Added support for new `select_optgroup` form field [#165](https://github.com/getgrav/grav-plugin-form/issues/165)
1. [](#improved)
    * Moved messages output into partial to allow style overriding
    * Logic cleanup
    * Updated Italian and Russian translations
1. [](#bugfix)
    * Fixed an issue with conditional field not always displaying properly
    * Only add Twig form variable if not already set
    * Fixed issue with multiple forms on a page failing on Captcha client-side validation [#182](https://github.com/getgrav/grav-plugin-form/issues/182)
    * Fixed issue with Ajax forms return full form HTML on error [#163](https://github.com/getgrav/grav-plugin-form/issues/163)

# v2.8.2
## 08/18/2017

1. [](#new)
    * Added new `columns` and `column` fields for controlled form layout

# v2.8.1
## 08/15/2017

1. [](#improved)
    * Added extra class support to the default field for more flexible styling

# v2.8.0
## 07/16/2017

1. [](#bugfix)
    * Fixed a typo in the spanish translation [#167](https://github.com/getgrav/grav-plugin-form/pull/167)

# v2.8.0-rc.2
## 06/22/2017

1. [](#improved)
    * Add default client-side validation for captcha, with error popup [#139](https://github.com/getgrav/grav-plugin-form/issues/139)
    * Added key observe for select
    * Added Czech translation
1. [](#bugfix)
    * Bug fix for radio type form field [#154](https://github.com/getgrav/grav-plugin-form/pull/154)
    * Remove double escaping [#155](https://github.com/getgrav/grav-plugin-form/issues/154)

# v2.8.0-rc.1
## 05/22/2017

1. [](#new)
    * Bundled as RC release for Grav/Admin RC releases

# v2.7.1
## 05/22/2017

1. [](#improved)
    * Force modular sub-pages with forms to set `$never_cache_twig = true` to improve form processing reliability [#153](https://github.com/getgrav/grav-plugin-form/issues/153)
    * Use new `Utils::getPagePathFromToken()` method

# v2.7.0
## 05/16/2017

1. [](#bugfix)
    * Fix issue with dynamically added forms (Registration, Profile, Comments, etc) not processed [#149](https://github.com/getgrav/grav-plugin-form/issues/149)
    * Fixed issue with nested values not being repopulated on form error [#140](https://github.com/getgrav/grav-plugin-form/issues/140)

# v2.6.0
## 05/04/2017

1. [](#new)
    * Allow form item replacement in redirect location [#144](https://github.com/getgrav/grav-plugin-form/issues/144)
1. [](#bugfix)
    * Fix regression with file uploads introduced in 2.5.0

# v2.5.0
## 04/24/2017

1. [](#new)
    * Support proper form handling with nested fields [#141](https://github.com/getgrav/grav-plugin-form/issues/141)
1. [](#bugfix)
    * Added check for valid Grav forms before trying to create a form object

# v2.4.0
## 04/19/2017

1. [](#new)
    * Added the ability for front-end forms to use advanced blueprint features such as `data-*@` and `config-*@`
    * Added support for dynamically added pages to process forms properly
    * Added a new avatar field for displaying account avatar
    * Added method to get all `data` from a form
    * Support `task` in button types
1. [](#improved)
    * Added `step` to range field [#136](https://github.com/getgrav/grav-plugin-form/issues/136)
    * Added a new default ajax handler twig template
    * Moved twig events to always process even if forms are not defined
    * Some code cleanup
    * Handle `null` with session-based form
    * Added support for append/prepend to number field
1. [](#bugfix)
    * Always process form events as long as a `$_POST` exists [login #101](https://github.com/getgrav/grav-plugin-login/issues/101)
    * Various fixes for `file` field
    * Allow manually added pages to process forms and upload files
    * Fixed issue with nested fileds not showing up in `data.*.twig` templates

# v2.3.1
## 03/23/2017

1. [](#bugfix)
    * Only include `outerclasses` DIV if defined [#135](https://github.com/getgrav/grav-plugin-form/issues/135)

# v2.3.0
## 03/17/2017

1. [](#new)
    * Ability to process any form on any page via `action:`.  Super useful if you want to handle form processing on some other non-form page (or Ajax)
    * Added the ability for the form to set the `template:` to use to render the form processing response.
1. [](#bugfix)
    * Fix `number` field so it works with min value `0` [#130](https://github.com/getgrav/grav-plugin-form/issues/130)

# v2.2.0
## 03/13/2017

1. [](#new)
    * Added new `fieldset` form field [#125](https://github.com/getgrav/grav-plugin-form/issues/125)
    * Added new `conditional form field` to show fields only if some `condition` is set
1. [](#improved)
    * Added the option to have outer-classes on buttons [#124](https://github.com/getgrav/grav-plugin-form/issues/124)
    * Added the option to disable fields label if not defined [#126](https://github.com/getgrav/grav-plugin-form/issues/126)

# v2.1.1
## 02/17/2017

1. [](#improved)
    * Better default output for select, checkbox and checkboxes fields in the form destination page and in the emails sent via form submit [#121](https://github.com/getgrav/grav-plugin-form/issues/121)


# v2.1.0
## 02/10/2017

1. [](#improved)
    * Reworked logic so form caching is based on `Pages::getPagesCacheId()`
    * Added `url` option for button field
1. [](#bugfix)
    * Fixed issue with `honeypot` field not throwing exception properly

# v2.0.10
## 02/08/2017

1. [](#improved)
    * Optimistically set 'status' to `success` when requesting a form via Ajax. Form processing listeners should take care of setting status to something else
1. [](#bugfix)
    * File uploads are now adding a `__form-file-uploader__` POST field to better allow identifying them with Ajax
    * Require jQuery when using the File field, as it's needed by the form.min.js file required in the file upload functionality

# v2.0.9
## 01/24/2017

1. [](#bugfix)
    * Translate the labels in data.html.twig [https://github.com/getgrav/grav-plugin-comments/issues/38](https://github.com/getgrav/grav-plugin-comments/issues/38)
    * Fixed file input when `System` > `Twig` > `Autoescape` is set to `Yes`

# v2.0.8
## 12/13/2016

1. [](#new)
    * RC released as stable
    * Added a new `honeypot` field for form anti-spam protection

# v2.0.8-rc.1
## 11/26/2016

1. [](#bugfix)
    * Fixed Forms 2.0 changes for registration form [#101](https://github.com/getgrav/grav-plugin-form/issues/101)
    * Fixed errant reference to Grav DI container in Form#getPagePathFromToken [#105](https://github.com/getgrav/grav-plugin-form/issues/105)
    * Fixed issue with spacer fields being displayed first, not in order [#104](https://github.com/getgrav/grav-plugin-form/issues/104)

# v2.0.7
## 11/17/2016

1. [](#improved)
    * Added method to set all data in a form
    * Added params to form action URL
    * Added ability to add ids to buttons and to set them disabled
1. [](#bugfix)
    * Moved Files Upload GC logic to function in front-end only

# v2.0.6
## 10/19/2016

1. [](#bugfix)
    * Fixed translations for `display` field
    * Fixed [#95](https://github.com/getgrav/grav-plugin-form/issues/95) multilanguage forms submission
    * Fixed duplicate textarea class tag [#98](https://github.com/getgrav/grav-plugin-form/issues/98)

# v2.0.5
## 09/15/2016

1. [](#bugfix)
    * Fix passing updating the header through event, no need for return value

# v2.0.4
## 09/15/2016

1. [](#improved)
    * Allow filling the page header form dynamically (e.g. use case: Comments plugin)

# v2.0.3
## 09/12/2016

1. [](#improved)
    * Use `Page::slug()` for form name if not set in the form itself (better backwards compatibility)

# v2.0.2
## 09/08/2016

1. [](#improved)
    * Added support for Grav's autoescape twig setting
    * Allow to add additional markup fields in form and field twig overrides
    * Updated the french language translation

# v2.0.1
## 09/07/2016

1. [](#bugfix)
    * Fixed a backwards compatibility issue with Admin forms

# v2.0.0
## 09/07/2016

1. [](#new)
    * Forms now supports multiple forms per page!
    * Access forms from any other page within the current page
    * Instantiate forms directly in page content with Twig processing enabled
    * New Twig function to get forms data from any other page
    * Ability to use Twig in saved filename
    * Reworked the `file` field. All files get uploaded via Ajax and are stored upon Submit. Fully backward compatible, `file` field now includes also a `limit` and `filesize` option. The former determines how many files are allowed to be uploaded when in combination with `multiple: true` (default: 10), the latter determines the file size limit (in MB) allowed for each file (default: 5MB)
1. [](#improved)
    * Added several missing HTML5 form input field types [#87](https://github.com/getgrav/grav-plugin-form/issues/87)
    * Added Support for CSS id in form definition

# v1.3.2
## 08/10/2016

1. [](#improved)
    * Added Romanian translation
1. [](#bugfix)
    * Fixed an issue with Recaptcha secret throwing errors [#84](https://github.com/getgrav/grav-plugin-form/pull/84)

# v1.3.1
## 07/27/2016

1. [](#improved)
    * Added support for multiple emails in `email` field (add `multiple: true` to enable)
1. [](#bugfix)
    * Fixed backward incompatibility with forms submission and data retrieval [getgrav/grav#933](https://github.com/getgrav/grav/issues/933)

# v1.3.0
## 07/14/2016

1. [](#improved)
    * When uploading a file through a form, if the file is already existing prepend the current day and time to the filename instead of overwriting it.

# v1.3.0-rc.4
## 06/21/2016

1. [](#bugfix)
    * Fixed running on Grav 1.0.x

# v1.3.0-rc.3
## 06/17/2016

1. [](#new)
    * Set hints for checkboxes options and allow field descriptions

# v1.3.0-rc.2
## 06/08/2016

1. [](#new)
    * Allow to process Twig in a hidden field, by setting `evaluate: true`

# v1.3.0-rc.1
## 06/01/2016

1. [](#improved)
    * French updated

# v1.3.0-beta.6
## 05/23/2016

1. [](#new)
    * Added support for advanced blueprint functionality in forms
    * Added site-wide form options to set Google Captcha site + secret keys [#34](https://github.com/getgrav/grav-plugin-form/pull/34)
    * Session-based 'flash' storage of form for redirects [#48](https://github.com/getgrav/grav-plugin-form/issues/48)
    * Added ability to **append** to file if you include a `process: save: body:` template attribute [#65](https://github.com/getgrav/grav-plugin-form/issues/65)
1. [](#improved)
    * Support `keyname` form format like admin forms
    * Added backwards compatibility for Captcha field
    * Added 'markdown-notices' style output for better errors
    * Added `Forms::getValue()` method to retrieve values programatically
    * Changed `datetime` form field to simply extend `text` until implemented
    * Updated french language
1. [](#bugfix)
    * Refactored the files upload logic
    * Missing Language string
    * Fixed errors not getting output

# v1.3.0-beta.5
## 05/12/2016

1. [](#improved)
    * Moved form/field.html.twig file to the default folder, to be more easily extended in themes

# v1.3.0-beta.4
## 05/04/2016

1. [](#new)
    * Added support for `prepend` and `append` field attributes for Text input

# v1.3.0-beta.3
## 05/03/2016

1. [](#bugfix)
    * Fix for select field admin translation

# v1.3.0-beta.2
## 04/27/2016

1. [](#bugfix)
    * Fix for autoescape in spacer and display form fields
    * Fix issue with form reset action [#66](https://github.com/getgrav/grav-plugin-form/pull/66)

# v1.3.0-beta.1
## 04/20/2016

1. [](#new)
    * Added the HTML5 `range` input field with `min` and `max` parameters
1. [](#improved)
    * Allow to override classes in Form definition for the form element
    * Add more blocks in the Form twig template, so classes can be overridden more easily in themes
    * Reworked some fields to fit the new Admin
    * Use `scope` for form fields to allow fields to be excluded from the data by adding `input@: false` to their definition
    * Added german translation
    * Allow to add inline Twig to the form message definition
1. [](#bugfix)
    * Fixed the form action URL for home page forms
    * Fix stopping form events propagation, correctly stop when one event is stopped
    * Allow to translate the fields placeholders and the form message
    * Fix captcha javascript function ordering. Also, render it in the site active language
    * Support attribute `for="id"` on label for checkbox
    * Fix select fields with the multiple option enabled
    * Fixed select options escaping with autoescape on - [#502](https://github.com/getgrav/grav-plugin-admin/issues/502)

# v1.2.2
## 02/11/2016

1. [](#bugfix)
    * Fixed case issue when including form file.

# v1.2.1
## 02/11/2016

1. [](#new)
    * Allow placeholder for **select** field
1. [](#improved)
    * Use common language strings in blueprints
    * Use `for` attribute in labels
    * Improved `README.md`
    * Code lint
1. [](#bugfix)
    * Moved `nl2br` to correct place or will break for arrays

# v1.2.0
## 01/06/2016

1. [](#bugfix)
    * Correctly merge the file field configuration
    * restore full file information save

# v1.1.0
## 12/18/2015

1. [](#new)
    * Croatian translation
    * Added id, style, and disabled options to select fields
1. [](#improved)
    * Allow adding form labels and help text as lang strings
    * Allow translating field content
    * Allow translating button and checkbox labels
    * Allow adding classes to the form field container with `field.outerclasses`
    * Updated French translation
1. [](#bugfix)
    * Fixed error message on file upload
    * Fixed overriding defaults for the file type in forms

# v1.0.3
## 12/11/2015

1. [](#improved)
    * Updated languages
    * Allow an action to stop processing
1. [](#bugfix)
    * Fix captcha validation
    * Fix issue where Form was unsetting valid page

# v1.0.2
## 12/01/2015

1. [](#bugfix)
    * Fixed merge of defaults settings
    * Support for arrays in `data.txt.twig`
    * Fixed blueprint for admin

# v1.0.1
## 12/01/2015

1. [](#new)
    * New **file upload** field
    * Added modular form template
    * Spanish translation
    * Hungarian translation
    * Italian translation

# v1.0.0
## 11/21/2015

1. [](#new)
    * Server-side validation of forms #11
    * Added french translation
    * Added **nonce** form security
1. [](#improved)
    * Show a more meaningful error when the display page is not found
    * Added links to learn site for form examples
    * Label can be omitted
    * Allow user to set the CSS class for buttons
1. [](#bugfix)
    * Fixed multi-language forms
    * Checkbox is translatable
    * Minor fixes

# v0.6.0
## 10/21/2015

1. [](#bugfix)
    * Fixed for missing attributes in textarea field
    * Fixed checkbox inputs

# v0.5.0
## 10/15/2015

1. [](#new)
    * New `operation` param to allow different file saving strategies
    * Ability to add new file saving strategies
    * Now calls a `process()` method during form processing
1. [](#improved)
    * Added server-side captcha validation and removed front-end validation
    * Allow `filename` instead of `prefix`, `format` + `extension`
1. [](#bugfix)
    * Fixed radio inputs

# v0.4.0
## 9/16/2015

1. [](#new)
    * PHP server-side form validation
    * Added new Google Catpcha field with front-end validation
1. [](#improved)
    * Add defaults for forms, moved from the themes to the Form plugin
    * Store multi-line fields with line endings converted to HTML

# v0.3.0
## 9/11/2015

1. [](#improved)
    * Refactored all the forms fields

# v0.2.1
## 08/24/2015

1. [](#improved)
    * Translated tooltips

# v0.2.0
## 08/11/2015

1. [](#improved)
    * Disable `enable` in admin

# v0.1.0
## 08/04/2015

1. [](#new)
    * ChangeLog started...
