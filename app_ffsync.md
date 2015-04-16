# Firefox Sync
Firefox Sync permits synchronize plugins, tabs, bookmarks, favorites, history over many Firefox instances.

### Firefox configuration
#### Firefox desktop
In Firefox URL bar put: `about:config`.

Search for: `services.sync.tokenServerURI`.

Replace the URL by: https://mydomain.tld/path/token/1.0/sync/1.5

Create an account at Mozilla: https://accounts.firefox.com/signup

#### Firefox mobile
Install the plugin `fxa-custom-server-addon`.