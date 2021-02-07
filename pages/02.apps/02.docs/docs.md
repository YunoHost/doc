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

{% set test = page.media["plugins://apps/apps.son"] %}

{{ test }}

![mytext](plugins://apps/apps.json)

{% for app in catalog["apps"] %}
    {{ app }}
{% endfor %}

<ul>
{% for p in page.collection %}
   <li><a href="{{ p.url }}">{{ p.title|e }}</a></li>
{% endfor %}
</ul>
