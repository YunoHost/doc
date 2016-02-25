<a class="btn btn-lg btn-default" href="packaging_apps_en">Application packaging</a>

### Multi-instance
Multi-instance is application capacity to be installed several times.

#### Scripts
When YunoHost installs the application a second time, it gives to the script, at last argument, `${id}__2` with the application `${id}` coming from the manifest. The value `n` in `${id}__n` is incremented each time a new instance of the application is installed.

**E.g.** in the roundcube script, database is called `roundcube`, the install directory `roundcube` and the [Nginx configuration](packaging_apps_nginx_conf_en) `roundcube`. This way, the second instance of roundcube will not conflict with the first one, and will be installed in the `roundcube__2` database, in the `roundcube__2`directory, and with the `roundcube__2` Nginx configuration.

Retrieve last variable given to scripts:
```bash
APP=${!#}
```

#### Manifest
Set `multi_instance` variable to `true` in the [manifest](packaging_apps_manifest_en):
```json
 "multi_instance": "true",
```