---
title: Administration from the API or an external application
template: docs
taxonomy:
    category: docs
routes:
  default: '/admin_api'
---

All command line actions can also be ran from the web API. The API is available at https://your.server/yunohost/api.

## Test with curl
You must first retrieve a login cookie thanks to the /login route to perform the other actions.

```bash
# Login (with admin password)
curl -k -H "X-Requested-With: customscript" \
        -d "credentials=supersecretpassword" \
        -dump-header headers \
        https://your.server/yunohost/api/login

# GET example
curl -k -i -H "Accept: application/json" \
           -H "Content-Type: application/json" \
           -H 'Cookie: yunohost.admin="XXXXXXXX"' \
           -L -b headers -X GET https://your.server/yunohost/api/ROUTE \
        | grep } | python -mjson.tool
```

## Test with our swagger doc

 1. Login on the [Webadmin of demo.yunohost.org](https://demo.yunohost.org/yunohost/admin/)
 2. Use the `Try it out` button on the API endpoint you want to test

<div id="swagger-ui"></div>
<style>
#swagger-ui .topbar {
    display: none;
}
</style>
<link rel="stylesheet" type="text/css" href="/user/themes/yunohost-docs/css/swagger-ui.css" />
<script src="/user/themes/yunohost-docs/js/swagger-ui-bundle.js" charset="UTF-8"> </script>
<script src="/user/themes/yunohost-docs/js/swagger-ui-standalone-preset.js" charset="UTF-8"> </script>
<script src="/user/themes/yunohost-docs/js/openapi.js" type="text/javascript" language="javascript"></script>
<script>
    window.onload = function() {
  //<editor-fold desc="Changeable Configuration Block">
  // the following lines will be replaced by docker/configurator, when it runs in a docker-container
  window.ui = SwaggerUIBundle({
    spec: openapiJSON,
    dom_id: '#swagger-ui',
    deepLinking: true,
    displayOperationId: true,
    validatorUrl: null,
    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset
    ],
    withCredentials: true,
    layout: "StandaloneLayout"
  });

  //</editor-fold>
};

</script>

