---
title: Guide to writing application documentation
template: docs
taxonomy:
    category: docs
routes:
  default: '/doc_writing_guide'
---

## Users / Administrators documentation pages

Add a one-click install button (such as https://yunohost.org/app_piwigo) and a button on the application integration level.

Classification of available applications by tags (genre, Git, association management, e-mails, etc.).

## Some typical and general uses (writing framework)

 + rename the images in the following order:`description_application.ext`.

### General frame application documentation

 1. Logo (dimension 80 pixels high) + level 1 title.
 1. One-click install button, Integration level for each type of processor.
 1. An index at the top of the documentation with cross-references to all the chapters of the documentation.
 1. A general presentation of the application and its function.
 2. A configuration part of the application.
 1. An administration part of the application.
 1. A part on limitations related to YunoHost.
 1. A part on desktop clients (if any). A link to different third-party applications if there are several (possible link to the applications catalgue [framalibre.org](https://framalibre.org)) or a link to the page about desktop applications if official applications are provided.
 1. A part with:
    - the link to the official site
    - the link to the documentation
    - Links to the YunoHost package and issues

Screen for writing documentation pages: [here](/app_writing_guide)

## Roadmap

1. Document applications.
   1. Document applications at work (marked: work) level 8/7/6.
   1. Translate the documentation page at least into French and English.
   1. Do a PR on the application repository
