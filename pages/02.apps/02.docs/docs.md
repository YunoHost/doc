---
content:
    order:
        by: basename
        dir: asc
    pagination: false
    url_taxonomy_filters: true
    items:
      - '@self.children'
      - '@taxonomy.category': [docs, apps]
twig_first: true
process:
    twig: true
debugger:
  enabled: true                        # Enable Grav debugger and following settings
  shutdown:
    close_connection: true
twig:
    debug: true
errors:
  display: true
---

Test

{% set test = read_file('/var/www/app_yunohost/apps/apps.json') %}

{{ test }}

{% for app in catalog %}
    {{ app }}
{% endfor %}

<ul>
{% for p in page.collection %}
   <li><a href="{{ p.url }}">{{ p.title|e }}</a></li>
{% endfor %}
</ul>
