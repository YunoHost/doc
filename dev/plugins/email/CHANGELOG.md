# v3.1.5
## 01/03/22

1. [](#improved)
   * Updated to Swiftmailer `v6.3.0` with PHP 8.1 compatibility [#157](https://github.com/getgrav/grav-plugin-email/issues/157)

# v3.1.4
## 11/16/2021

1. [](#improved)
    * Added second parameter to `Email::send()` to get failed recipients

# v3.1.3
## 07/19/2021

1. [](#improved)
   * Pass page variable to processed forms [#141](https://github.com/getgrav/grav-plugin-email/pull/141)
   * Email configuration available to templates [#152](https://github.com/getgrav/grav-plugin-email/pull/152)
   * New Event after eMail was sent [#151](https://github.com/getgrav/grav-plugin-email/pull/151)

# v3.1.2
## 04/06/2021

1. [](#new)
    * Added new `onEmailMessage` event to make object available for editing [#150](https://github.com/getgrav/grav-plugin-email/pull/150)

# v3.1.1
## 01/31/2021

1. [](#improved)
    * Latest vendor updates including SwiftMailer `6.2.5`
    * Updated CLI commands
    * Minor code cleanup 

# v3.1.0
## 12/02/2020

1. [](#improved)
    * Added support for `auth_mode` in SMTP engine [#101](https://github.com/getgrav/grav-plugin-email/pull/101)
    * Obfuscate the password shown in the CLI `test-email` command [#140](https://github.com/getgrav/grav-plugin-email/pull/140)

# v3.0.10
## 11/09/2020

1. [](#improved)
    * Tweaked default `base.html.twig` template to better support dark-mode clients
    * Latest vendor updates
1. [](#bugfix)
    * Add missing support for `template:` in body array
    * Added check to process markdown with `text/html` content type only

# v3.0.9
## 06/08/2020

1. [](#improved)
    * Disable password autocomplete in password field
    * Don't save empty string in password field [#134](https://github.com/getgrav/grav-plugin-email/issues/134)

# v3.0.8
## 04/27/2020

1. [](#improved)
    * Updated vendor library files
    * Use Grav's Parsedown class

# v3.0.7
## 03/05/2020

1. [](#improved)
    * Updated email validator library
1. [](#bugfix)
    * Fixed `Invalid resource theme://` on CLI command `test-email` on Grav 1.6.21 and later versions [#128](https://github.com/getgrav/grav-plugin-email/issues/128)

# v3.0.6
## 02/11/2020

1. [](#improved)
    * Updated email validator library

# v3.0.5
## 02/03/2020

1. [](#bugfix)
    * Fixed a date in changelog (no other changes)

# v3.0.4
## 01/17/2020

1. [](#improved)
    * Added ZOHO configuration example
    * Updated SwiftMailer library for PHP 7.4 support

# v3.0.3
## 08/16/2019

1. [](#new)
    * Support an array of multiple emails in `email:` form process
    * Allow form values in email templates 
1. [](#improved)
    * Added Twig blocks for `content` and `footer` in `email/base.html.twig` template
    * Updated `README.md` to reflect working setup for GMail 

# v3.0.2
## 05/09/2019

1. [](#new)
    * Requires Form Plugin v3.0.3
    * Added Russian translation [#113](https://github.com/getgrav/grav-plugin-email/pull/113)
1. [](#bugfix)
    * Better fix for missing attachments when sending an email using a form [form#333](https://github.com/getgrav/grav-plugin-form/issues/333)

# v3.0.1
## 04/15/2019

1. [](#improved)
    * Put a `try/catch` around email attachments and log any errors rather than hard fail
1. [](#bugfix)
    * Fixed missing attachments when sending an email using a form [form#333](https://github.com/getgrav/grav-plugin-form/issues/333)

# v3.0.0
## 04/11/2019

1. [](#new)
    * Added new `template:` to choose twig template option for email form processing
    * Moved `buildMessage()` and `parseAddressValue()` to Email object and made public
    * Refactored the `EmailUtils::sendEmail()` to take an array of params or the old param list
    * Switched to SwiftMailer v.6.1.3 (requires PHP7/Grav 1.6)
    * SwiftMailer 6.x compatibility fixes  
    * Updated various translations 
    * Added support for Email Queue with Scheduler support
    * Code cleanup, composer update
    * Added a new `clear-queue-failures` CLI command to flush out failed sends
1. [](#improved)
    * Added backlink for scheduler task
    * Added support for `environment` option to `flushqueue` CLI command 
    * Fixed mailtrap hostname in README.md
    * Disable autocomplete on SMTP `user` and `password` fields
    
# v2.7.2
## 01/25/2019

1. [](#improved)
    * Added default for `to` address
    * Updated EN language [#99](https://github.com/getgrav/grav-plugin-email/pull/99)
    * Updated UK language [#98](https://github.com/getgrav/grav-plugin-email/pull/98)
    * Updated RU language [#100](https://github.com/getgrav/grav-plugin-email/pull/100)
    * Updated to SwiftMailer v5.4.12
1. [](#bugfix)
    * Fixed `mailtrap` hostname    

# v2.7.1
## 12/05/2017

1. [](#new)
    * Added new `onEmailSend()` event hook before sending [#70](https://github.com/getgrav/grav-plugin-email/pull/70)
1. [](#improved)
    * Added examples of setting up Email plugin with various SMTP providers
    * Updated RU language [#60](https://github.com/getgrav/grav-plugin-email/pull/60)
    * Updated to SwiftMailer v5.4.8

# v2.7.0
## 10/26/2017

1. [](#improved)
    * Now uses a dedicated `logs/email.log` file when `debug: true`
    * Improved the README.txt file with examples, and troubleshooting
    * Changed default engine to `sendmail` as `mail` is deprecated and not functioning [swiftmailer#866](https://github.com/swiftmailer/swiftmailer/issues/866}

# v2.6.2
## 09/30/2017

1. [](#improved)
    * Removed extraneous files from vendor folder 

# v2.6.1
## 09/07/2017

1. [](#improved)
    * Improved the error message when missing `from` in the configuration
    * Silently catch malformed email exceptions

# v2.6.0
## 05/22/2017

1. [](#improved)
    * Inherit options from plugin configuration [#39](https://github.com/getgrav/grav-plugin-email/pull/39)
1. [](#bugfix)
    * Also process translation on the email subject [https://github.com/getgrav/grav-plugin-comments/issues/38](https://github.com/getgrav/grav-plugin-comments/issues/38)

# v2.5.3
## 01/03/2017

1. [](#improved)
    * Updated to SwiftMailer 5.4.5 [#45](https://github.com/getgrav/grav-plugin-email/issues/45)

# v2.5.2
## 12/13/2016

1. [](#new)
    * RC released as stable

# v2.5.2-rc.1
## 11/26/2016

1. [](#new)
    * Added a new `process_markdown` option for emails in forms
1. [](#improved)
    * Improved the `Utils::sendEmail()` method to take the email type as an option

# v2.5.1
## 10/19/2016

1. [](#improved)
    * CLI command will fallback to use the `to` from email plugin config if not provided
    * Explicit Composer based class loader to fix issues with class case

# v2.5.0
## 09/07/2016

1. [](#new)
    * Added a new `bin/plugin email test-email` CLI command
1. [](#improved)
    * Moved Email `Utils` class from Login to Email plugin
    * Provide a sample base `email/base.html.twig` template for emails
1. [](#bugfix)
    * Fix handling attachments with the updated file upload field

# v2.4.3
## 08/16/2016

1. [](#improved)
    * Added Russian translation
    * Updated Swiftmailer to 5.4.3 [#37](https://github.com/getgrav/grav-plugin-email/issues/37)

# v2.4.2
## 08/10/2016

1. [](#improved)
    * Added Croatian translation

# v2.4.1
## 07/14/2016

1. [](#improved)
    * Allow multiple email recipients (comma separated) [#31](https://github.com/getgrav/grav-plugin-email/issues/31)
    * Added Danish and Spanish translations

# v2.4.0
## 05/11/2016

1. [](#improved)
    * Now includes Swiftmailer v5.4.2 which introduces a number of bug fixes and improvements
1. [](#bugfix)
    * Correct `starttls` implementation, bundled in TLS

# v2.3.0
## 04/20/2016

1. [](#improved)
    * Added debug option to enable logging on SwiftMailer.
    * Updated SwiftMailer from v5.1.0 to v5.4.1.
    * Added an option in the Admin settings to enable `starttls`
1. [](#bugfix)
    * Correctly name TLS in the Admin settings, the label was `TTS` (but the value was correctly named `tls`)

# v2.2.0
## 02/05/2016

1. [](#new)
    * Allow to send attachments in forms
    * Added French translation
1. [](#improved)
    * Throw an exception when trying to send emails without a `from` or `to` parameters setup, to intercept less meaningful errors and provide a better description on how to fix the problem
    * Changed SMTP password in admin to use a password field instead of plain text

# v2.1.0
## 12/18/2015

1. [](#new)
    * Added missing `content_type` to email.yaml
    * Added default values for CC and BCC
 1. [](#improved)
    * Improved documentation of new email params in `README.md`
    * Moved config setting of `mailer.default` to `mailer.engine`

# v2.0.0
## 12/11/2015

1. [](#new)
    * Added support for from/sender name (Thomas Keitel)
    * Added support for message content type (Thomas Keitel)
    * Added support for reply addresses (Thomas Keitel)
    * Added support for CC/BCC (Thomas Keitel)
    * Added support for multiple body parts (Thomas Keitel)
1. [](#bugfix)
    * Fix email engine selection (z38)

# v1.0.0
## 11/20/2015

1. [](#bugfix)
    * Fix for issue with no body parameter specified

# v0.2.1
## 09/11/2015

1. [](#bugfix)
    * Fix onFormProcessed event

# v0.2.0
## 08/11/2015

1. [](#improved)
    * Disable `enable` in admin

# v0.1.0
## 08/04/2015

1. [](#new)
    * ChangeLog started...
