# v3.6.3
## 03/14/2022

1. [](#improved)
    * Improved multi-site support in user emails

# v3.6.2
## 01/12/2022

1. [](#new)
   * Support for `YubiKey OTP` 2-Factor authenticator
   * Requires Grav `v1.7.27`

# v3.6.1
## 01/03/2022

1. [](#bugfix)
   * Fixed issue with forgot password error message translation [#285](https://github.com/getgrav/grav-plugin-login/pull/285)

# v3.6.0
## 10/26/2021

1. [](#new)
    * Create a new "invite users" feature
    * Add CLI option for language [#277](https://github.com/getgrav/grav-plugin-login/issues/277)

# v3.5.3
## 09/29/2021

1. [](#bugfix)
    * Fixed double language in redirection after successful login [grav#3411](https://github.com/getgrav/grav/issues/3411)

# v3.5.2
## 09/14/2021

1. [](#new)
    * Require **Grav 1.7.21**
    * Added support for `{% throw 401 'Unauthorized' %}` and `{% throw 403 'Forbidden' %}` from twig template to show appropriate login pages
1. [](#improved)
    * Unauthorized page uses now `HTTP 403` code
    * Remove notification on unauthorized page
1. [](#bugfix)
    * Fixed broken CLI [#280](https://github.com/getgrav/grav-plugin-login/issues/280)
    * Remove dynamic defaults in `route_after_login` and `route_after_login` settings as they have no effect

# v3.5.1
## 08/31/2021

1. [](#bugfix)
   * Fixed white-page during new install with admin 

# v3.5.0
## 08/31/2021

1. [](#new)
   * Require **Grav 1.7.19**, **Form 5.1.0** and **Email 3.1.0**
   * Added support for adding login pages by `$grav['login']->addPage()`
   * Added support for getting all login routes by `$grav['login']->getRoute()`
   * Added support for form layouts
   * Deprecated methods `LoginPlugin::defaultRedirectAfterLogin()` and `LoginPlugin::defaultRedirectAfterLogout()`
1. [](#improved)
   * Speed up `visibility_requires_access` checks by restricting full check to only visible pages
1. [](#bugfix)
   * Fixed login pages with redirect breaking the site

# v3.4.4
## 06/16/2021

1. [](#new)
   * Updated 2FA library
1. [](#bugfix)
   * Fixed missing email conflict check when calling `Login::register()`

# v3.4.3
## 05/19/2021

1. [](#bugfix)
    * Fixed failing Flex User validation if user has changed in the filesystem (requires Grav 1.7.13) [#278](https://github.com/getgrav/grav-plugin-login/issues/278)

# v3.4.2
## 04/06/2021

1. [](#improved)
   * `Login::register()` now validates all the provided built-in user fields, not just username
   * Improved user field validation
   * Do not validate optional `fullname` field, it's already handled in the registration form

# v3.4.1
## 02/17/2021

1. [](#new)
  * Added Lithuanian translation [#270](https://github.com/getgrav/grav-plugin-login/pull/270)
  * Added Chinese Translation [#245](https://github.com/getgrav/grav-plugin-login/pull/345)
  * Added Brazillian Portuguese [#222](https://github.com/getgrav/grav-plugin-login/pull/222)

# v3.4.0
## 01/31/2021

1. [](#new)
   * Prevent information leak on every ACL protected page by always setting Cache-Control [#264](https://github.com/getgrav/grav-plugin-login/issues/264))
1. [](#improved)
   * Allow browser caching for all login/profile pages
   * Composer update 

# v3.3.8
## 12/11/2020

1. [](#bugfix)
   * Fixed saving another user in Admin with 2FA enabled regenerating 2FA secret [#268](https://github.com/getgrav/grav-plugin-login/issues/268)

# v3.3.7
## 12/02/2020

1. [](#bugfix)
    * Flex Users: Make sure the user object is fresh and not cached

# v3.3.6
## 09/24/2020

1. [](#bugfix)
    * Fixed typos causing invalid config for logout
    * Fixed cache issues with user login pages [#264](https://github.com/getgrav/grav-plugin-login/issues/264) 

# v3.3.5
## 06/10/2020

1. [](#bugfix)
    * Fixed broken lang strings [#258](https://github.com/getgrav/grav-plugin-login/pull/258)

# v3.3.4
## 06/08/2020

1. [](#improved)
    * Missing language strings [#254](https://github.com/getgrav/grav-plugin-login/pull/254)

# v3.3.3
## 06/05/2020

1. [](#bugfix)
    * Fixed saving in 'normal' mode with `visibility_requires_access` [#228](https://github.com/getgrav/grav-plugin-login/issues/228)
    * Fixed missing `|raw` on content in profile template
    * Fixed blueprint

# v3.3.2
## 06/03/2020

1. [](#new)
    * Grav 1.7 only: Added `Sync User in Session` feature [#252](https://github.com/getgrav/grav-plugin-login/issues/252)
1. [](#improved)
    * Refactored code to use helper methods to find redirect routes
    * Added error message when user cannot log in because of account has not been activated or it has been disabled
    * Set better defaults for redirects on login and logout
    * Fixed proper highlights and default states for admin option toggles

# v3.3.1
## 05/07/2020

1. [](#bugfix)
    * Set missing default logout route to `/` for homepage

# v3.3.0
## 04/30/2020

1. [](#new)
    * Rate limiter logic was moved to login events and can be turned on with `['rate_limit' => true]` option
    * Rate limiter sets `UserLoginEvent::AUTHENTICATION_CANCELLED` and triggers `onUserLoginFailure` event
    * Login now triggers extra `onUserLoginAuthorized` event if user is authorized
    * 2FA now triggers either `onUserLoginAuthorized` or `onUserLoginFailure` event with `AUTHORIZATION_CHALLENGE` state
1. [](#bugfix)
    * Fixed issue with backwards compatibility for `route_after_login` and `route_after_logout`
    * Removed duplicate entries in `blueprint.yaml` causing YAML errors
    * Fixed logout not removing task if there was no redirect set
    * Fixed remember me triggering `onUserLoginFailure`, use `onUserLoginGuest` event instead

# v3.2.0
## 04/27/2020

1. [](#new)
    * CHANGE: `redirect_to_login` and `redirect_after_logout` are now boolean, with accompanying `route_after_login` and `route_after_logout` options.  NOTE: Compatibility is maintained with existing config.
1. [](#improved)
    * Improved configuration layout
    * Better handling of login route when that page doesn't exist 
1. [](#bugfix)
    * Fixed guest only pages requiring login
    * Fixed issue when logging out, not redirecting, and attempting to log right back in

# v3.1.0
## 03/05/2020

1. [](#new)
    * Added new `onUserActivated` event [#242](https://github.com/getgrav/grav-plugin-login/issues/242)
    * Change session ID during login to prevent session fixation (requires Grav 1.7)
1. [](#bugfix)
    * Turn off extra debug messages [#244](https://github.com/getgrav/grav-plugin-login/issues/244)
    * Fixed `groups` field not listing available user groups

# v3.0.6
## 02/11/2020

1. [](#new)
    * Pass phpstan level 1 tests
    * Updated 2FA library to v1.7.0
1. [](#improved)
    * Added some debugging messages (turned off by default)

# v3.0.5
## 01/02/2020

1. [](#bugfix)
    * Fixed bug in `Login::isUserAuthorizedForPage()` where rules is a list of permissions
    * Fixed password reset link [#233](https://github.com/getgrav/grav-plugin-login/pull/233)
    * Fixed Typo [#236](https://github.com/getgrav/grav-plugin-login/pull/236)

# v3.0.4
## 10/03/2019

1. [](#bugfix)
    * Fixed bad redirect after login on multi-language site [#217](https://github.com/getgrav/grav-plugin-login/issues/217)
    * Fixed basic login not obeying `redirect_after_login` option
    * Provide default `redirect_after_activation` option [#225](https://github.com/getgrav/grav-plugin-login/issues/225)

# v3.0.3
## 07/01/2019

1. [](#bugfix)
  * Fix for not redirecting to secure page after login [#199](https://github.com/getgrav/grav-plugin-login/issues/199)
  * Fixed `bin/plugin login new-user` ACL when using Flex Users

# v3.0.2
## 05/09/2019

1. [](#new)
  * Added `ru` and `uk` translations [#208](https://github.com/getgrav/grav-plugin-login/pull/208)
1. [](#improved)
  * Fixed typo in README.md
  * Added support for IPv6 addresses for login rate limiting @Vivalldi [#204](https://github.com/getgrav/grav-plugin-login/issues/204)

# v3.0.1
## 04/17/2019

1. [](#improved)
    * Extra checks for page visibility [#166](https://github.com/getgrav/grav-plugin-login/issues/166)

# v3.0.0
## 04/11/2019

1. [](#new)
    * Added **2-Factor Authentication** support for front-end (2FA)
    * New CLI command to `lookup` users 
    * Check requirements to use new `lookup` command
    * Added support for the new `Flex User` object
1. [](#improved)
    * Use `$grav['accounts']` instead of `$grav['users']`
    * Update all Login classes to rely on `PageInterface` instead of `Page` class
    * Updated typehints from `User` to `UserInterface`
    * Use `$grav['users']` collection instead of deprecated static calls
    * Invalidate cache when modifying users from CLI
    * Updated code to PHP 7.1 features
1. [](#bugfix)
    * Fix login on registration (FlexUsers)      

# v2.8.4
## 03/20/2019

1. [](#improved)  
  * Enable "brute force" protection by default [#195](https://github.com/getgrav/grav-plugin-login/pull/195)
  * UPdated various language translations
1. [](#bugfix)
  * Set security timeouts in blueprints to use `minutes` rather than `seconds` [#194](https://github.com/getgrav/grav-plugin-login/issues/194)
  * Send "notification" email to `to` address rather than `from` [#188](https://github.com/getgrav/grav-plugin-login/pull/188)

# v2.8.3
## 01/25/2019
  
1. [](#new)
  * Wrap data in `onUserLoginRegisterData` event in object to allow reference  
1. [](#improved)  
  * IP pseudonymization for rate limiter [#196](https://github.com/getgrav/grav-plugin-login/pull/196)
  * Made some error lang strings more generic to relfect ability to change username/password requirements
1. [](#bugfix)
  * Fix redirectLangSafe in login controller [#192](https://github.com/getgrav/grav-plugin-login/pull/192)      

# v2.8.2
## 12/14/2018
  
1. [](#new)  
  * Fire `onUserLoginRegisteredUser()` event to allow manipulation of User object after registration

# v2.8.1
## 12/13/2018

1. [](#bugfix)
  * Fix various redirects to use `lang-safe` variety for better multi-language support [#186]((https://github.com/getgrav/grav-plugin-login/issues/186))
  * Ensure only defined `user_registration.fields` are allowed in registration and profile forms

# v2.8.0
## 11/12/2018

1. [](#new)
    * Store remember me triplets into `user://data/rememberme` instead of storing them into the cache
    * Ability to register + authorize but require accounts to be manually enabled [#180](https://github.com/getgrav/grav-plugin-login/issues/180)
1. [](#improved)
    * If login on registration or activation has been turned on, use login redirect if override is not set
    * Don’t set default templates for `register` and `unauthorized`, use overridable templates [#179](https://github.com/getgrav/grav-plugin-login/issues/179)
    * Updated `de.yaml` [#175](https://github.com/getgrav/grav-plugin-login/pull/175)
    * Updated `ru.yaml` [#176](https://github.com/getgrav/grav-plugin-login/pull/176)
1. [](#bugfix)
    * Fixed broken remember me functionality
    * Fixed client side validation in login forms
    * Fix uppercase and Unicode username handling [#177](https://github.com/getgrav/grav-plugin-login/pull/177)

# v2.7.3
## 06/20/2018

1. [](#bugfix)
    * Fixed regression with `redirect_after_login` setting [#164](https://github.com/getgrav/grav-plugin-login/issues/164)

# v2.7.2
## 06/11/2018

1. [](#new)
    * Norwegian translation added [#163](https://github.com/getgrav/grav-plugin-login/issues/163)
1. [](#bugfix)
    * Fixed issue with `redirect_after_login` being ignored [#164](https://github.com/getgrav/grav-plugin-login/issues/164)
    * CLI commands `change-user-state` and `change-password` were ignoring desired username [#161](https://github.com/getgrav/grav-plugin-login/issues/161)

# v2.7.1
## 06/03/2018

1. [](#bugfix)
    * Removed extra unnecessary username check [#159](https://github.com/getgrav/grav-plugin-login/issues/159)
    * CLI command `add-user` ignores desired username [#157](https://github.com/getgrav/grav-plugin-login/issues/157)

# v2.7.0
## 05/11/2018

1. [](#new)
    * Moved support for 2FA authentication into Login plugin (only supported in Admin currently)
    * Updated plugin dependencies (Grav >= 1.4.5, Form >=2.13.4, Email >=2.7.0)
1. [](#improved)
    * Added cleaner way for 3rd party providers to add twig templates to login form
    * Use `Login` class validation methods in CLI
    * Added logging of login exceptions
    * Show denied message only when authenticated but not authorized
1. [](#bugfix)
    * Don't allow Profile saving if a Grav user account doesn't exist (OAuth/LDAP users for example)
    * Don't allow PW reset if no current password exists (OAuth/LDAP users for example) 

# v2.6.3
## 04/12/2018

1. [](#bugfix)
    * Fixed issue with saving profile and stating email has already exists

# v2.6.2
## 04/12/2018

1. [](#new)
    * Added custom logout redirect configuration option
    * Added support for `Login::login()` and `Login::logout()` to return `UserLoginEvent` instance instead of `User`
    * Added support for custom login messages and redirects set in `UserLoginEvent`
1. [](#bugfix)
    * Fixed typo in activation email body [#151](https://github.com/getgrav/grav-plugin-login/issues/151) 
    
# v2.6.1
## 03/19/2018

1. [](#improved)
    * Fixed undefined index if login form didn't contain username/password

# v2.6.0
## 02/22/2018

1. [](#improved)
    * Disabled user registration by default. Enable it manually if you need it.
    * Disabled user-login-on-registration by default. Enable it manually if you need it.
    * Check for existing email addresses when updating User profile.

# v2.5.0
## 12/05/2017

1. [](#new)
    * Added `$grav['login']->login()` and `$grav['login']->logout()` functions with event hooks
    * Added `$grav['login']->getRateLimiter($context)` function
    * Added events `onUserLoginAuthenticate`, `onUserLoginAuthorize`, `onUserLoginFailure`, `onUserLogin`, `onUserLogout`
    * Logout message is now maintained during session destruction
1. [](#improved)
    * Remember entered username if login fails
    * Improved rate limiter to work without sessions and against distributed attacks
    * Removed `partials/messages.html.twig` and rely on new core version
    * Moved languages from unified file into dedicated language file structure
    * Welcome / Notice / Activation emails now more flushed out and in HTML like Reset Password
1. [](#bugfix)
    * Do not send nonce with activation link, email app can open the link in another browser

# v2.4.3
## 10/11/2017

1. [](#bugfix)
    * Fix an issue when a user only has `groups` and no `access` defined [#134](https://github.com/getgrav/grav-plugin-login/issues/134)
    * Escape untrusted URLs in the template files

# v2.4.2
## 09/29/2017

1. [](#bugfix)
    * Fixed issue with protected page media without access [#132](https://github.com/getgrav/grav-plugin-login/issues/132)
    * Improved validation of email to support RFC5322 [Grav#1648](https://github.com/getgrav/grav/issues/1648)

# v2.4.1
## 09/12/2017

1. [](#bugfix)
    * Fixed an issue with 3rd party login plugins [#130](https://github.com/getgrav/grav-plugin-login/issues/130)

# v2.4.0
## 09/07/2017

1. [](#new)
    * Added the ability to have a custom route for login page, but not redirect
    * Added a new `unauthorized.md` page that can be customized as needed
1. [](#improved)
    * Differentiated between `authenticated` and `authorized`
    * Moved rate-limiting logic to the Login class
    * Much code cleanup and removing of cruft
    * Updated vendor libraries
    * Added Russian translation
1. [](#bugfix)
    * Fixed login JSON response in case of login failure
    * Fixed issue with profile form displaying on login page
    * Store referrer page when trying to access Profile page
    * Fixed error when logging out with an expired session

# v2.3.2
## 06/22/2017

1. [](#bugfix)
    * Grav plugin cli error on password change [#120](https://github.com/getgrav/grav-plugin-login/issues/120)

# v2.3.1
## 05/16/2017

1. [](#improved)
    * Added routes to the Admin blueprints

# v2.3.0
## 04/19/2017

1. [](#new)
    * Added new built-in profile page support
    * Added optional flood protection for password resets and login attempts [#91](https://github.com/getgrav/grav-plugin-login/issues/91)
1. [](#improved)
    * Use new system configuration entries for username and password format
    * Use initialized form object in Twig templates rather than array from page.header
    * Improved alert styling in login templates
    * Added `appends` for number field
    * Added missing `route` options in admin options (blueprints)
1. [](#bugfix)
    * Set cookie path to `/` if `base_url_relative` is empty [#102](https://github.com/getgrav/grav-plugin-login/issues/102)
    * Fixed some redirect logic
    
# v2.2.1
## 01/24/2017

1. [](#bugfix)
    * Fix login form/status templates displaying user as logged in even if he's not authenticated
    * Use email validation instead of text validation in the forgot password form [https://github.com/gantry/gantry5/issues/1813](https://github.com/gantry/gantry5/issues/1813)

# v2.2.0
## 12/13/2016

1. [](#new)
    * RC released as stable

# v2.2.0-rc.5
## 12/07/2016

1. [](#improved)
    * Added support for hiding `Remember me` checkbox and and `Forgot` button (for Offline functionality)
1. [](#bugfix)
    * Fixed redirect issue in admin plugin

# v2.2.0-rc.4
## 12/04/2016

1. [](#improved)
    * Improved logic for redirect after login to not include login-related pages.

# v2.2.0-rc.3
## 11/26/2016

1. [](#improved)
    * Added some validity checks in the reset password form
1. [](#bugfix)
    * Correctly redirect to the last page visited after login, unless `redirect_after_login` is defined

# v2.2.0-rc.2
## 11/17/2016

1. [](#new)
    * Allow to set permissions using nested array syntax [#96](https://github.com/getgrav/grav-plugin-login/issues/96)
1. [](#improved)
    * Use the same feedback message when resetting the password if the email exists or not. Remove email in the message as we now recover via email, useless
1. [](#bugfix)
    * Fix registration form, fields were not visible [#97](https://github.com/getgrav/grav-plugin-login/issues/97)
    * Do not initialize the user session if the user exists but has no `site.login` permission

# v2.2.0-rc.1
## 11/09/2016

1. [](#new)
    * Allow login via `username` or `email`
    * Only allow password recovery via `email` address

# v2.1.2
## 10/01/2016

1. [](#bugfix)
    * Fixed an old reference to `LoginUtils` and replaced with new `EmailUtils`

# v2.1.1
## 09/08/2016

1. [](#improved)
    * Use better detection for admin allowing multi-site setup with subfolders

# v2.1.0
## 09/07/2016

1. [](#improved)
    * Added support for Grav's autoescape twig setting
    * Dropped unused variable reference
    * Moved Email Utils to Email plugin
    * Updated vendor libraries
    * Allow explicitly showing the login page on pages that are not the Login form template [#11](https://github.com/getgrav/grav-plugin-maintenance/issues/11)

# v2.0.1
## 08/10/2016

1. [](#improved)
    * Added Romanian

# v2.0.0
## 07/14/2016

1. [](#improved)
    * Optimized nonce creation
    * Point account path to core's account stream [#85](https://github.com/getgrav/grav-plugin-login/issues/85)

# v2.0.0-rc.2
## 06/21/2016

1. [](#new)
    * Add an option to login protect a login-protected page media accessed through the page route [#45](https://github.com/getgrav/grav-plugin-login/issues/45)
1. [](#improved)
    * Fixed some language keys
1. [](#bugfix)
    * Correctly show an error message when the reset password form does not provide the correct nonce

# v2.0.0-rc.1
## 06/01/2016

1. [](#improved)
    * French updated
1. [](#bugfix)
    * Enable twig processing in a page #75
    * Deny access to registration when user registration is disabled #72

# v2.0.0-beta.3
## 05/23/2016

1. [](#improved)
    * Added a redirect after activation
    * Changed hardcoded redirect routes to config-based
1. [](#bugfix)
    * Fix a redirect issue #74
    * Don't error if missing a HTTP_USER_AGENT browser string

# v2.0.0-beta.2
## 05/03/2016

1. [](#improved)
    * Improved the login form page once logged in
    * Translate welcome and logout strings
1. [](#bugfix)
    * Fixed logging out on the homepage
    * Fixed an issue in processing user registration

# v2.0.0-beta.1
## 04/20/2016

1. [](#new)
    * Introduce a more flexible Login plugin architecture, which allows separate authentication plugins to hook into the Login events. Separated OAuth to its own plugin.
    * OAuth has been separated to its own plugin, needs to be installed separately and configured. The users account filename format has changed too, to fix an issue that involved people with the same name on a service.
    * The `redirect` option  has been changed to `redirect_after_login`. Make sure you update your configuration file.
1. [](#improved)
    * Add a proper 'Access levels' config section for Login.
    * Various underlying improvements
    * Updated french, added german
1. [](#bugfix)
    * Make username field autofocus
    * Add validation to the password reset form
    * Fixed an issue that allowed a user logged in, without access to the actual permissions set to view a page, to see its content, and the login form again even if already logged in.

# v1.3.1
## 02/05/2016

1. [](#new)
    * Add translations for Username and Password (placeholders are not translated)
1. [](#improved)
    * Improve registration, forgot, reset and login forms accessibility by setting the id attribute
    * Improved french translation
    * Add the correct message type when raising a form processing error
1. [](#bugfix)
    * Show the correct error message when the user is not authorized to view a page
    * Fix showing the OAuth links in the login form

# v1.3.0
## 01/06/2016

1. [](#new)
    * Added a new CLI command to change a user's password
    * Added a new CLI command to edit the user state
1. [](#improved)
    * Improved french translation

# v1.2.1
## 12/18/2015

1. [](#new)
    * Croatian translation
1. [](#improved)
    * Use type `email` in registration form
    * Drop manual validation in registration

# v1.2.0
## 12/11/2015

1. [](#new)
    * Added account activation email upon registration
    * Added forgot password functionality
    * Support ACL from parent page
    * Allow login immediately after account activation
1. [](#improved)
    * Handle admin login page if available
    * Example registration form now provided by plugin
    * Better error handling of registration
    * Tab-based plugin configuration
    * Updated translations
1. [](#bugfix)
    * Prevent failing when no default values are set

# v1.1.0
## 12/01/2015

1. [](#new)
    * Support new **User Registration**
1. [](#improved)
    * Use new security salt for newer and fallback otherwise
    * Composer update of libraries
    * Check for session existence else throw a runtime error
1. [](#bugfix)
    * Fix remember-me functionality
    * Check page exists so as not to fail hard
    * Fix for static Inflector references #17


# v1.0.1
## 11/23/2015

1. [](#improved)
    * Hardening cookies with user-agent and system cache key instead of deprecated system hash
    * Set a custom route for login only if it's not an admin path

# v1.0.0
## 11/21/2015

1. [](#new)
    * Added OAuth login support for _Facebook_, _Google_, _GitHub_ and _Twitter_
    * Added **Nonce** form security support
    * Added option to "redirect after login"
    * Added "remember me" functionality
    * Added Hungarian translation
2. [](#improved)
    * Added blueprints for Grav Admin plugin (multi-language support!)

# v0.3.3
## 09/11/2015

1. [](#improved)
    * Changed authorise to authorize
1. [](#bugfix)
    * Fix denied string

# v0.3.2
## 09/01/2015

1. [](#improved)
    * Broke out login form into its own partial

# v0.3.1
## 08/31/2015

1. [](#improved)
    * Added username field autofocus

# v0.3.0
## 08/24/2015

1. [](#new)
    * Added simple CSS styling
    * Added simple login status with logout
1. [](#improved)
    * Improved README documentation
    * More strings translated
    * Updated blueprints

# v0.2.0
## 08/11/2015

1. [](#improved)
    * Disable `enable` in admin

# v0.1.0
## 08/04/2015

1. [](#new)
    * ChangeLog started...

# v1.3.1
## 02/05/2016

1. [](#new)
    * Add translations for Username and Password (placeholders are not translated)
1. [](#improved)
    * Improve registration, forgot, reset and login forms accessibility by setting the id attribute
    * Improved french translation
    * Add the correct message type when raising a form processing error
1. [](#bugfix)
    * Show the correct error message when the user is not authorized to view a page
    * Fix showing the OAuth links in the login form

# v1.3.0
## 01/06/2016

1. [](#new)
    * Added a new CLI command to change a user's password
    * Added a new CLI command to edit the user state
1. [](#improved)
    * Improved french translation

# v1.2.1
## 12/18/2015

1. [](#new)
    * Croatian translation
1. [](#improved)
    * Use type `email` in registration form
    * Drop manual validation in registration

# v1.2.0
## 12/11/2015

1. [](#new)
    * Added account activation email upon registration
    * Added forgot password functionality
    * Support ACL from parent page
    * Allow login immediately after account activation
1. [](#improved)
    * Handle admin login page if available
    * Example registration form now provided by plugin
    * Better error handling of registration
    * Tab-based plugin configuration
    * Updated translations
1. [](#bugfix)
    * Prevent failing when no default values are set

# v1.1.0
## 12/01/2015

1. [](#new)
    * Support new **User Registration**
1. [](#improved)
    * Use new security salt for newer and fallback otherwise
    * Composer update of libraries
    * Check for session existence else throw a runtime error
1. [](#bugfix)
    * Fix remember-me functionality
    * Check page exists so as not to fail hard
    * Fix for static Inflector references #17


# v1.0.1
## 11/23/2015

1. [](#improved)
    * Hardening cookies with user-agent and system cache key instead of deprecated system hash
    * Set a custom route for login only if it's not an admin path

# v1.0.0
## 11/21/2015

1. [](#new)
    * Added OAuth login support for _Facebook_, _Google_, _GitHub_ and _Twitter_
    * Added **Nonce** form security support
    * Added option to "redirect after login"
    * Added "remember me" functionality
    * Added Hungarian translation
2. [](#improved)
    * Added blueprints for Grav Admin plugin (multi-language support!)

# v0.3.3
## 09/11/2015

1. [](#improved)
    * Changed authorise to authorize
1. [](#bugfix)
    * Fix denied string

# v0.3.2
## 09/01/2015

1. [](#improved)
    * Broke out login form into its own partial

# v0.3.1
## 08/31/2015

1. [](#improved)
    * Added username field autofocus

# v0.3.0
## 08/24/2015

1. [](#new)
    * Added simple CSS styling
    * Added simple login status with logout
1. [](#improved)
    * Improved README documentation
    * More strings translated
    * Updated blueprints

# v0.2.0
## 08/11/2015

1. [](#improved)
    * Disable `enable` in admin

# v0.1.0
## 08/04/2015

1. [](#new)
    * ChangeLog started...
