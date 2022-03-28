# v1.2.0
## 03/28/2022

1. [](#new)
    * Require **Grav 1.7.32** and **Form 6.0.0**
2. [](#improved)
    * Improved flex router event to include directory
3. [](#bugfix)
    * Fixed caching issues in dynamic flex forms
    * Fixed flex content in unauthorized module causing the whole page to become unauthorized

# v1.1.9
## 03/14/2022

1. [](#new)
    * Added support for flex router to return a response instead of a page

# v1.1.8
## 01/28/2022

1. [](#new)
    * Require **Grav 1.7.29**
3. [](#improved)
    * Made path handling unicode-safe, use new `Utils::basename()` and `Utils::pathinfo()` everywhere

# v1.1.7
## 01/03/2022

1. [](#new)
    * Allow intercepting object `create`, `update` and `delete` tasks by using `FlexTaskEvent` event
2. [](#improved)
    * Added optional `$scope` parameter to `ObjectController::checkAuthorization()`
3. [](#bugfix)
    * Fixed continue task with `PageInterface` types
    
# v1.1.6
## 11/29/2021

1. [](#bugfix)
    * Fixed regression `Call to a member function getRoute() on null` when using CLI [#151](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/151)

# v1.1.5
## 11/24/2021

1. [](#new)
    * Added method `ObjectController::checkAuthorizations()` to check if one of the actions is true
2. [](#bugfix)
    * Fixed regression when calling flex router with a path

# v1.1.4
## 11/16/2021

1. [](#new)
    * Require **Grav 1.7.25**
1. [](#improved)
    * Changed flex router not to trigger `onPageNotFound` event
    * Changed flex router to be called also with empty path
    * If ACL check for the object fails, display unauthorized page instead of 404
1. [](#bugfix)
    * Fixed unescaped messages in JSON responses
    * Fixed `Call to a member function getName() on null` when using file field [#149](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/149)

# v1.1.3
## 10/26/2021

1. [](#improved)
    * Updated JS dependencies to latest
    * Optimized import of certain JS dependencies
    * Dev: Moved away from deprecated UglifyJsPlugin in favor of TerserPlugin
    * Use active form from the Form plugin to get page metadata
    * Added page header `flex.access.override: true`, which allows flex to replace page `access` when user is allowed to perform action in flex
1. [](#bugfix)
    * Fixed flex object page access for super users when permission was denied

# v1.1.2
## 09/14/2021

1. [](#new)
    * Require **Grav 1.7.21**, optionally **Error 1.8.0**, **Login 3.5.2** and **Form 5.1.1**
    * Added file upload/delete support to frontend forms
    * Support proper error, login and unauthorized pages if all requirements are met
    * Added page header `flex.router: [ROUTER]` which triggers `flex.router.[ROUTER]` event for child routes of the page
    * Added `flex.[type].task.create.after`, `flex.[type].task.update.after` and `flex.[type].task.delete.after` events for frontend

# v1.1.1
## 09/01/2021

1. [](#bugfix)
    * Fixed XSS in page admin
    * Fixed check for bad folder name, prevent bad characters

# v1.1.0
## 08/31/2021

1. [](#new)
   * Require **Grav 1.7.19** and **Form 5.1.0**
   * Added basic frontend editing support
   * Added `onBeforeFlexFormInitialize` event to help to initialize the frontend form
1. [](#bugfix)
   * Fixed error in admin when field validation fails

# v1.0.16
## 07/19/2021

1. [](#new)
   * Added basic new modal support for all flex types
1. [](#bugfix)
   * Fixed authorization check for user configuration

# v1.0.15
## 06/16/2021

1. [](#improved)
   * Better checks against missing Flex Type inside tasks
   * Better authorization checks, falls back to directory level authorization checks if objects do not support authorization
1. [](#bugfix)
   * Fixed missing handling of child_type in Flex Pages [getgrav/grav-plugin-admin#2087](https://github.com/getgrav/grav-plugin-admin/issues/2087)
   * Added support for multiple `Exports` in a dropdown
   * Admin is no longer a dependency of Flex Objects [#130](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/130)
   * Fixed authorization checks during page creation for users who have limited access to some pages [getgrav/grav#3382](https://github.com/getgrav/grav/issues/3382)
   * Fixed permission check when moving a page [getgrav/grav#3382](https://github.com/getgrav/grav/issues/3382)

# v1.0.14
## 06/07/2021

1. [](#improved)
   * Added enhanced copy modal from Pages list [getgrav/grav-plugin-admin#2139](https://github.com/getgrav/grav-plugin-admin/issues/2139)

# v1.0.13
## 06/03/2021

1. [](#bugfix)
   * Fixed expert mode for Flex Pages

# v1.0.12
## 06/02/2021

1. [](#bugfix)
   * Fixed logic to get form blueprints and object, prevents events from being fired twice
   * Fixed breadcrumb item in Pages list not translating HTML entities [#127](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/127)

# v1.0.11
## 05/24/2021

1. [](#improved)
   * Allow file uploads to send data such as `data[media_order]`

# v1.0.10
## 05/19/2021

1. [](#bugfix)
   * Fixed `Add Folder` not updating the page list until cache is cleared
   * Fixed broken error message translations

# v1.0.9
## 04/29/2021

1. [](#bugfix)
   * Fixed fatal error when copying a page in admin if no modal is being shown [getgrav/grav#3335](https://github.com/getgrav/grav/issues/3335)

# v1.0.8
## 04/23/2021

1. [](#new)
   * Require **Admin 1.10.13**
   * Require **Form Plugin 5.0.2**
1. [](#improved)
   * Added a few missing translations
   * Utilize new Admin detector to prevent Save actions that triggers unsaved notice on unload [getgrav/grav-plugin-admin#2125](https://github.com/getgrav/grav-plugin-admin/issues/2125)
   * Improved copying page by adding a modal for new page title and folder name

# v1.0.7
## 04/06/2021

1. [](#new)
   * Require **Grav 1.7.10**
   * Added deny option support to `filepicker` field [#119](https://github.com/trilbymedia/grav-plugin-flex-objects/pull/119)
1. [](#bugfix)
   * Prevent expert editing mode from anyone else than super users [grav-plugin-admin#2094](https://github.com/getgrav/grav-plugin-admin/issues/2094)
   * Fixed not being able to add new folder [grav#3293](https://github.com/getgrav/grav/issues/3293)
   * Fixed Flex directories defined only in theme not showing up [grav#3292](https://github.com/getgrav/grav/issues/3292)

# v1.0.6
## 03/30/2021

1. [](#bugfix)
   * Fixed automatic git-sync in admin save and delete [#120](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/120)
   * Prevent Add Page / Add Module modals from closing if clicking on the outside overlay [grav-plugin-admin#2089](https://github.com/getgrav/grav-plugin-admin/issues/2089)

# v1.0.5
## 03/19/2021

1. [](#new)
   * Require **Grav 1.7.9**
   * Require **Form Plugin 5.0.1**
1. [](#improved)
   * Catch JSON decoding issues in controllers
1. [](#bugfix)
   * Fixed broken media upload/picker fields with `@self/path` notations [grav#3275](https://github.com/getgrav/grav/issues/3275)
   * Fixed `filepicker` field not including newly uploaded and excluding newly deleted files before saving the object
   * Fixed `Flex Page` CRUD ACL when creating a new page [#115](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/115)
   * Bumped dependencies versions [#116](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/116)
   * Fixed clicking `move` button on some pages resulting in endless loading spinner [grav-plugin-admin#2095](https://github.com/getgrav/grav-plugin-admin/issues/2095) 

# v1.0.4
## 03/17/2021

1. [](#improved)
   * Added id attributes for buttons to help on acceptance testing
1. [](#bugfix)
   * Fixed fatal error in `/admin/flex-objects` [#114](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/114)
   * Fixed `onAdminSave` original page having empty header [grav#3259](https://github.com/getgrav/grav/issues/3259)
   * Fixed flash issues on uploading files into a new page

# v1.0.3
## 02/17/2021

1. [](#improved)
   * List field: added new `placement` property to decide whether to add new items at the top, bottom or based on the *position* of the clicked button [#105](https://github.com/trilbymedia/grav-plugin-flex-objects/pull/105)
  * Added default styling for Flex-Objects Admin list view
1. [](#bugfix)
   * Fixed fatal error if configuration is missing directories [#107](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/107)
   * Fixed case-sensitive `accept` in `filepicker` field
   * Fixed pages admin being accessible without read/write permissions [grav-plugin-admin#2053](https://github.com/getgrav/grav-plugin-admin/issues/2053)
   * Fixed missing event `onAdminCreatePageFrontmatter` when creating a new page [grav-plugin-auto-date#8](https://github.com/getgrav/grav-plugin-auto-date/issues/8)
   * Fixed missing event `onAdminAfterDelMedia` when deleting a file from a page
   * Fixed filepicker support for old `theme@:/` and `page@:/` notations [#109](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/109)
   * Fixed adding the same new page twice remembering content from the last try
   * Fixed saving a new page with invalid data makes blueprint fields disappear [grav-plugin-admin#2068](https://github.com/getgrav/grav-plugin-admin/issues/2068)

# v1.0.2
## 02/01/2021

1. [](#new)
   * Require **Grav 1.7.4**
1. [](#bugfix)
   * Fixed saving page in expert mode [grav#3174](https://github.com/getgrav/grav/issues/3174)

# v1.0.1
## 01/20/2021

1. [](#bugfix)
   * Fixed 404 when trying to edit a page with accented characters [grav-plugin-admin#2026](https://github.com/getgrav/grav-plugin-admin/issues/2026)

# v1.0.0
## 01/19/2021

1. [](#new)
   * Added `$grav['flex_objects']->getAdminController()` method
1. [](#improved)
   * Added support for relative paths in `getLevelListing` action
1. [](#bugfix)
   * Fixed admin not working with types that do not implement `FlexAuthorizeInterface`
   * Fixed bad redirect when creating new flex object and choosing to create another return to the list
   * Fixed bad redirect when changing parent of new page and saving [grav-plugin-admin#2014](https://github.com/getgrav/grav-plugin-admin/issues/2014)
   * Fixed page forms being empty if multi-language is enabled, but there's just one language [grav#3147](https://github.com/getgrav/grav/issues/3147)
   * Fixed copying a page within a parent with no create permission [grav-plugin-admin#2002](https://github.com/getgrav/grav-plugin-admin/issues/2002)
   
# v1.0.0-rc.20
## 12/15/2020

1. [](#improved)
    * Default cookies usage to SameSite Lax [grav-plugin-admin#1998](https://github.com/getgrav/grav-plugin-admin/issues/1998)
    * Fixed typo [#89](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/89)

# v1.0.0-rc.19
## 12/02/2020

1. [](#improved)
    * Just keeping sync with Grav rc.19

# v1.0.0-rc.18
## 12/02/2020

1. [](#new)
    * Require **PHP 7.3.6**
1. [](#improved)
    * Improved frontend templates
    * Improve blueprint structure
    * Hooked up Duplicate and Move from within Pages list [#81](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/81)
    * Respect CRUD ACL actions for items shortcuts in pages list [#82](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/82)
    * Refresh object on controllers to make sure it is up to date
1. [](#bugfix)
    * Fixed fatal error in admin if list view hasn't been defined
    * Fixed fatal error in admin if directory throws exception
    * Fixed attempts to add an existing page
    * Fixed form loosing its form state if saving fails when using `ObjectController`
    * Fixed missing context when rendering collection in frontend
    * Fixed Flex Admin activating on too old Admin plugin versions
    
# v1.0.0-rc.17
## 10/07/2020

1. [](#bugfix)
    * Fixed media uploads for objects which do not implement `FlexAuthorizeInterface`
    * Fixed file picker field not recognizing `folder: @self` variants

# v1.0.0-rc.16
## 09/01/2020

1. [](#improved)
    * Simplified `Flex Pages` admin not to differentiate between default language file extensions [#47](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/47)
1. [](#bugfix)
    * Fixed extra space in Flex admin pages
    * Fixed folder creation with parent other than root [#66](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/66)
    * Fixed task redirects in sub-folder multi-site environments
    * Fixed typo in default permissions (should have been `admin.flex-objects`) [grav#2915](https://github.com/getgrav/grav/issues/2915)

# v1.0.0-rc.15
## 07/22/2020

1. [](#new)
    * Released with no changes to keep sync with Grav + Admin

# v1.0.0-rc.14
## 07/09/2020

1. [](#new)
    * Released with no changes to keep sync with Grav + Admin

# v1.0.0-rc.13
## 07/01/2020

1. [](#bugfix)
    * Fixed bad link in directory listing template
    * Fixed admin save task displaying error message about non-existing data type
    * Fixed `pagemedia` field not uploading/deleting files right away
    * Fixed `Flex Pages` add, copy and move buttons appearing in edit view when no permissions
    * Fixed `Flex Pages` permission issues
    * Fixed some admin redirect issues

# v1.0.0-rc.12
## 06/08/2020

1. [](#new)
    * Code updates to match Grav 1.7.0-rc.12
1. [](#improved)
    * Changed class `admin-pages` to `admin-{{ target }}` [#59](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/59)   

# v1.0.0-rc.11
## 05/14/2020

1. [](#new)
    * Added integration with Admin's new preset events to style the CSS
1. [](#improved)
    * JS Maitenance    
1. [](#bugfix)
    * Fixed `Accounts` Configuration tab

# v1.0.0-rc.10
## 04/27/2020

1. [](#bugfix)
    * Fixed custom actions not working
    * Fixed custom folder in `mediapicker` field not working
    * Fixed export title when not using CVS [#51](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/51)
    * Fixed preview in Page list view [admin#1845](https://github.com/getgrav/grav-plugin-admin/issues/1845)
    * Fixed `404 Not Found` error after saving a new object

# v1.0.0-rc.9
## 03/20/2020

1. [](#bugfix)
    * Fixed issue with touch devices and scrollbars hidden, preventing native scrolling to work [admin#1857](https://github.com/getgrav/grav-plugin-admin/issues/1857) [#1858](https://github.com/getgrav/grav-plugin-admin/issues/1858)
    
 
# v1.0.0-rc.8
## 03/19/2020

1. [](#new)
    * Added a basic **Convert Data** CLI Command.  Works with `Yaml` <-> `Json`
1. [](#bugfix)
    * Fixed jump of the page when applying filters [grav-admin#1830](https://github.com/getgrav/grav-plugin-admin/issues/1830)
    * Fixed form resetting when validation fails [grav#2764](https://github.com/getgrav/grav/issues/2764)

# v1.0.0-rc.7
## 03/05/2020

1. [](#new)
    * Added option to change perPage amount of items in Flex List. 'All' also available by only at runtime.
1. [](#improved)
    * Page filters now obey admin hide type settings
1. [](#bugfix)
    * Fixed fatal error if there is missing blueprint [grav#2834](https://github.com/getgrav/grav/issues/2834)
    * Fixed redirect when moving a page [grav#2829](https://github.com/getgrav/grav/issues/2829)
    * Fixed no default access set when creating new user from admin [#31](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/31)
    * Flex Pages: Fixed page visibility issues when creating a new page [grav#2823](https://github.com/getgrav/grav/issues/2823)
    * Flex Pages: Fixed translated page having non-translated status with `system.languages.include_default_lang_file_extension: false`
    * Flex Pages: Fixed preview on home page

# v1.0.0-rc.6
## 02/11/2020

1. [](#new)
    * Pass phpstan level 1 tests
    * Removed legacy classes for pages, cleanup deprecated Flex types
1. [](#bugfix)
    * Fixed call to `grav.flex_objects.getObject()` causing fatal error
    * Minor bug fixes

# v1.0.0-rc.5
## 02/03/2020

1. [](#new)
    * No changes, just keeping things in sync with Grav RC version

# v1.0.0-rc.4
## 02/03/2020

1. [](#new)
    * Added support for arbitrary admin menu route for editing a flex type
    * Added support for new improved ACL
    * Added support for custom layouts by adding `/:layout_name` in url
    * Added support for Flex Directory specific Configuration
    * Added support for action aliases (`/accounts/configure` instead of `/accounts/users/:configre`)
    * Added Flex type `Configuration`
    * Enabled `Pages`, `Accounts` and `User Groups` by default
    * Stop using deprecated `onAdminRegisterPermissions` event
    * Renamed directory `grav-pages` to `pages`
    * Renamed directory `grav-accounts` to `user-accounts`
    * Renamed directory `grav-user-groups` to `user-groups`
1. [](#improved)
    * Flex caching settings were moved into Grav core
    * Flex Objects plugin now better integrates to Grav core
1. [](#bugfix)
    * Fixed empty directory entries in plugin configuration
    * Fixed plugin configuration displaying directories outside of the plugin
    * Fixed broken blueprints if there's folder with the name of the blueprint file
    * Fixed visible save button when in 404 page
    * Fixed missing save location when file does not exist
    * Fixed multiple ACL related issues (no access, bad links, information leaks)
    * Fixed Admin Panel Page list buttons not appearing in Flex Pages

# v1.0.0-rc.3
## 01/02/2020

1. [](#new)
    * Added root page support for `Flex Pages`
1. [](#bugfix)   
    * Fixed after save: Edit
    * Fixed JS failing on initial filters setup due to no fallback implemented [#2724](https://github.com/getgrav/grav/issues/2724)

# v1.0.0-rc.2
## 12/04/2019

1. [](#new)
    * Admin: Added support for editing `User Groups`
    * Admin: `Flex Pages` now support **searching** and **filtering**
1. [](#bugfix)     
    * Hide hidden/system types (pages, accounts, user groups) from Flex Objects page type [#38](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/38)

# v1.0.0-rc.1
## 11/06/2019

1. [](#new)
    * Added directory configuration option for custom admin templates
    * Added `Flex Accounts (Admin)` type to administer user accounts in Flex independently from Grav system setting
    * Added `Flex Pages (Admin)` type to administer pages in Flex independently from Grav system setting
    * Added blueprint option to hide directory from Flex Objects types page in frontend 
    * Deprecated all `Flex Page` classes and traits in favor of the new classes in Grav core
    * Moved flex object/collection templates to `templates/flex/{TYPE}` which is easier to remember
    * Admin: Added support customizable preview and export
1. [](#improved)
    * Admin: Allow custom title template when editing object
    * Translations: rename MODULAR to MODULE everywhere
1. [](#bugfix) 
    * Flex Pages: Fixed default language not being translated in both `translatedLanguages()` and `untranslatedLanguages()` results
    * Flex Pages: Language interface compatibility fixes
    * Flex Pages: Fixed frontend issues with plugin events [#5](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/5)
    * Flex Pages: Fixed `filePathClean()` and `filePathClean()` not returning file for folder
    * Flex Pages: Fixed multiple multi-language related issues in admin [#10](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/10)
    * Flex Pages: Fixed raw edit mode
    * File upload is broken for nested fields [#34](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/34)

# v1.0.0-beta.10
## 10/03/2019

1. [](#bugfix)
    * Flex Pages: Fixed moving visible page in admin causing ordering issues [#6](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/6)
    * Flex Pages List: Fixed issue where auto-hiding scrollbars in macOS would throw off the dropdown position [#20](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/20)
    * Flex Pages: Fixed prev/next page missing pages if pagination was turned on in page header

# v1.0.0-beta.9
## 09/26/2019

1. [](#improved)
    * Show/hide dropdown menu as needed when scrolling the page columns container left and right
1. [](#bugfix)
    * PHP 7.1: Fixed error when activating `Flex Pages` in Plugin parameters [#13](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/13)
    * Flex Pages: Fixed page template cannot be changed [#4](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/4)
    * Flex Pages: Fixed new pages being created with wrong template [#22](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/22)
    * Flex Pages: Fixed `Preview` not working [#17](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/17)
    * Fixed error caused by automatic path selection from cookie when destination not available [#23](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/23)
    * Fixed breadcrumb issue in Flex Pages List [#19](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/19)
    * Flex Pages: Fixed unable to change page template [#4](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/4)
    * Fixed `Error 404` when adding new contact [#14](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/14)
    * Flex Pages: Non-visible items appear in Nav menu [#24](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/24)
    * Disabling plugin breaks saving plugin configuration [#11](https://github.com/trilbymedia/grav-plugin-flex-objects/issues/11)

# v1.0.0-beta.8
## 09/19/2019

1. [](#new)
    * Initial public release (all previous versions were in a private repo)
