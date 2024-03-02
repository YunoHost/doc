# Markdown Lint Rules for Grav Pages

[![Build Status](https://travis-ci.org/syseleven/markdownlint-rules-grav-pages.svg?branch=master)](https://travis-ci.org/syseleven/markdownlint-rules-grav-pages)

This package contains additional linting rules for [markdownlint](https://github.com/DavidAnson/markdownlint)
that check if a Markdown file is a valid [Grav CMS](https://getgrav.org/) page.

## Rules

### valid-images

* Checks if a relatively referenced image is present.

### valid-internal-links

* Checks if a link to a another markdown file in the same repo is correct.

### valid-metadata-block

* Checks if a Frontmatter metadata block is present and valid.

## Usage

See https://github.com/DavidAnson/markdownlint/blob/master/doc/CustomRules.md

## Development

To lint all source files run:

```bash
$ npm run lint
```

To run all tests:

```bash
$ npm run test
```

To release a new version, ensure that the checkout is clean, then run:

```bash
$ npm run release && git push --follow-tags origin master && npm publish
```
