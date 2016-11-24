# Contributing to the Yunohost core

You wish to implement a new feature in the Yunohost core, but don't know how to
proceed ? This guide takes you through the various steps of the development and
contribution process. 

If you're looking for stuff to implement or fix, the bugtracker is 
[here](https://dev.yunohost.org/issues/) !

## Setting up a development environment

- **Use [ynh-dev](https://github.com/YunoHost/ynh-dev)** (see the README) to
  setup a development environment - locally in a virtual machine, or on a VPS.
  This will setup a working Yunohost instance, using git repositories and
  symlinks. That way, you will be able to edit files, test your changes, commit
  stuff and push/pull directly from your development environment.

- Implement and test your feature. Depending on what you want to develop, you
  will want to :
   - **Python/CLI core** : work in `/vagrant/yunohost/`, i.e. the Python/CLI core
   - **Web administration interface** : work in `/vagrant/yunohost-admin/`
   - You can also work on the other projects (SSOwat, moulinette) in similar ways

## Developping on the Yunohost Python/CLI core

- Work in `/vagrant/yunohost/`

- The actionsmap file (`data/actionsmap/yunohost.yml`) defines the various
  categories, actions and arguments of the yunohost CLI. Define how you want
  users to use your feature, and add/edit the corresponding categories, actions
  and arguments. For example in `yunohost domain add some.domain.tld`, the
  category is `domain`, the action is `add`, and `some.domain.tld` is an
  argument.

- Moulinette will automatically map commands in the actionsmap to python
  functions (and their arguments) located in `src/yunohost/`. For example, typing
  `yunohost domain add some.domain.tld` will call the function
  `domain_add(domainName)` in `domain.py`, with the argument `domainName` equal
  to `"some.domain.tld"`.

#### Helpers / coding style

- To handle exceptions, you should raise some `MoulinetteError()`

- To help with internationalizing the messages, use `m18n.n('some-message-id')`
  and put your string in `locales/en.json`. You can also put arguments and use
  them in the string with `{{some-argument:s}}`. Don't edit other locales files,
  only the en.json !

- Yunohost tries to follow the [pep8](http://pep8.org/) coding style. Tools
  exist to automatically check conformity.

- Name of "private" functions should start with a `_`

#### Don't forget

- (Might not be necessary anymore) Each time you edit the actionsmap, you should
  force the refresh of the cache with `rm
  /var/cache/moulinette/actionsmap/yunohost.pkl`

## Adding stuff to the Yunohost web administration interface

- Work in `/vagrant/yunohost-admin/src/`

- Make sure the web admin interface of your development environment works, by
  opening `https://domain.tld/yunohost/admin`. If not, run `npm install` and
  `npm run build` in `yunohost-admin/src/`. [Not sure about this, to be checked]

- Run `/vagrant/ynh-dev use-git yunohost-admin`. It launches gulp, such as each 
  time you modify sources, it recompiles the code and you can use it by 
  refreshing (Ctrl+F5) your web administration. To stop the command, just do Ctrl+C.

- The web interface uses the API to interact with Yunohost. The API
  commands/requests are also defined via the actionsmap. For instance, accessing
  the page ```https://domain.tld/yunohost/api/users``` corresponds to a `GET
  /domains` requests on the Yunohost API. It is mapped to the function
  `user_list()`. Accessing the URL should display the json returned by this
  function. 'GET' requests are typically meant to ask information to the server.
  'POST' requests are meant to ask the server to edit/change some information,
  or to execute some actions.

- `js/yunohost/controllers` contains the javascript parts,
  and define which requests to make to the API when loading a specific page of
  the interface, and how to process the data to generate the page, using
  templates.

- `views` contains the various templates for the pages of the interface. In the
  template, data coming from the javascript part can be used with the syntax
  `{{some-variable}}`, which will be replaced when building/accessing the page.
  It is also possible to have conditions using the
  [handlebars.js](http://handlebarsjs.com) syntax : ```{{#if
  some-variable}}<p>Some conditionnal HTML code here !</p>{{/if}}```

- For internationalized strings, use `y18n.t('some-string-code')` in the
  javascript, or `{{t 'some-string-code'}}` in the HTML template, and put your
  string in `locales/en.json`. Don't edit other locales files, only the 
  en.json !

#### Don't forget

- Each time you edit the actionsmap, you should restart the yunohost-api :
  ```service yunohost-api restart```
  (You'll need to retype your admin password in the web interface)

- You might need to force-clear the cache of your browser sometimes to refresh 
  the javascript and/or html (so each time you edit something in `js` or `views`).


## Your feature is working and you want it to be integrated in Yunohost

- Fork the relevant repo on Github, and commit stuff to a new branch. We recommend
  to name the branch with the following convention :
  - For an enhancement or new feature : `enh-REDMINETICKET-name-of-feature`, where 
    REDMINETICKET is optional and is the id of a corresponding ticket on RedMine.
  - For a bugfix fix-IDREDMINETICKET-description-of-fix", where 
    REDMINETICKET is optional and is the id of a corresponding ticket on RedMine.

- Once you're ready, open a Pull Request (PR) on Github. Please include "[fix]" or 
  "[enh]" at the beginning of the title of your PR.

- After reviewing, testing and validation by other contributors, your branch
should be merged in `testing` (?) !


