---
title: Documentations
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
---

<ul>
{% for p in page.collection %}
   <li><a href="{{ p.url }}">{{ p.title|e }}</a></li>
{% endfor %}
</ul>
