---
title: Guide Markdown
template: docs
taxonomy:
    category: docs
routes:
  default: '/doc_markdown_guide'
---

Markdown is a markup language created in 2004, many add-ons developing the possibilities of this language exist. The objective of this guide is to aim for the exhaustiveness of the possibilities of this formatting language within the framework of the YunoHost documentation and not Markdown languages in general.

Markdown allows text to be formatted using tags, it allows *human* reading of the text; even with formatting. Even if only one notepad is needed there are many markdowns software (Markdown on [framalibre.org (fr)](https://framalibre.org/recherche-par-crit-res?keys=markdown)). It is relatively easy to use.

## The different levels of titles

By writing titles as follows:
```markdown
# Level 1 title
## Level 2 title
### Level 3 title
#### Level 4 title
##### Level 5 title
###### Level 6 title
```

They appear like this:
# Level 1 title
## Level 2 title
### Level 3 title
#### Level 4 title
##### Level 5 title
###### Level 6 title

## Formatting in paragraphs

To type a line break without creating a new paragraph, it is necessary to type **two consecutive spaces**. Otherwise, the text will continue in a row respecting the general constraints of the page style.

By writing this:

```markdown
For text in *italic you have to frame it with an asterisk* `*`
To write **bold text by two asterisks** `**`
You can also ~~bar the text~~ by framing it with two tildes `~`
```

It reads like this:

For text in *italic you have to frame it with an asterisk* `*`
To write **bold text by two asterisks** `**`
You can also ~~bar the text~~ by framing it with two tildes `~`

## Create links

To create a link to a site outside of the YunoHost documentation:

```markdown
[Text to display](https://lelien.tld)
```

will be displayed as such:
[Text to display](https://lelien.tld)

It is the same for the documentation pages, except that the link is internal. The page name is its default route, as defined in its page header:
```markdown
[Wiki Page](/write_documentation)
```

The link will return to the page with the correct language setting if the page exists, or defaults to the next available language (French, usually):
[Wiki page](/write_documentation)

! Note that language codes are thus not to be included at the beginning of the links to other documentation pages: `/en`, `/fr`, etc. are superfluous.

### Create anchors
An anchor allows you to make a link to a specific point in a page, that's how the indexes at the top of the page work. To create an anchor, you need to insert code at the anchor location in the following form :

```markdown
Text that will be doesn't even know it has an anchor.
```

What's displayed is:
Text that will be doesn't even know it has an anchor.

It is also possible to return an anchor directly to the title, noting the link in lower case with `-`s instead of spaces.
All that remains is to designate the anchor to the text you want to make interactive:

```markdown
[My Anchor Returns to Lists](#anchorname)
[My Anchor that refers to the title of the tables](#tables)
```

[My Anchor Returns to Lists](#anchorame)
[My Anchor that refers to the title of the tables](#tables)

## Displaying images

To display images, the principle is the same as for links, except that a `!` is added before the text to be displayed, which is considered here as the text to be displayed if the image cannot be loaded. A description of the image is appropriate.

```markdown
![YunoHost Logo](image://logo.png)
```
![YunoHost Logo](image://logo.png)


It is possible to make a link with an image, for example:
```markdown
[![YunoHost Logo](image://logo.png)](/write_documentation)
```
[![YunoHost Logo](image://logo.png)](/write_documentation)

The insert of *text to be displayed if the image cannot be loaded* between the brackets in the image link is not mandatory but strongly recommended.

## Format a quote

Quotes are used to highlight a statement made by another person, the wiki itself manages the way it is highlighted. Markdown uses a closing chevron, this symbol: `>`, to announce a quote. Just add it before the quote, as such:

```markdown
>First level quotation text
>which can be formatted in different lines

>> And a second quote
>> with double rafters
```
Will be displayed:

>First level quotation text
>which can be formatted in different lines

>> And a second quote
>> with double rafters

## Lists

Lists allow to display a series of texts in an easy presentation, this is how indexes such as the [contributing documentation](/contributordoc) page are written.

### Ordered lists

The ordered lists can be incremented as much as you wish, it is not necessary to give the right match to the number. It is possible to write down with `1.` and put in three spaces to mark the increment. For a better understanding of the plain text, it may be fine to use the numbers in ascending order to mark the increment, but it is the three consistent `spaces' before the sub-list that will mark the increment.

```markdown
1. List 1
1. List 2
1. list 3
   1. List 3a
   1. List 3b
      1. List 3b1
      1. List 3b2
      1. List 3b3
         1. List 1
         1. List 2
         1. list 3
1. List 4
1. List 5
1. list 6
```

You get:

1. List 1
1. List 2
1. list 3
   1. List 3a
   1. List 3b
      1. List 3b1
      1. List 3b2
      1. List 3b3
         1. List 1
         1. List 2
         1. list 3
5. List 4
3. List 5
4. list 6

### Unordered lists<a name="anchorname"></a>

To create an unordered list, use the symbols `*`, `+` or `*`. This will not change the appearance of the marker in the text output. It is the incrementing of the list that will define the visual. For a better reading of the plain text, it may be good to use the different symbols to mark the increment, but it is the three spaces before the sub-list that will indicate the increment.
As such:
```markdown
+ List 1
+ List 2
+ list 3
   - List 3a
   - List 3b
      * List 3b1
      * List 3b2
      * List 3b3
         + List 1
         + List 2
         + list 3
- List 4
* List 5
+ list 6
```

This will read:
+ List 1
+ List 2
+ list 3
   - List 3a
   - List 3b
      * List 3b1
      * List 3b2
      * List 3b3
         + List 1
         + List 2
         + list 3
- List 4
* List 5
+ list 6

## Tables

To create an array, use the vertical bar `|` and dashes `--`. It is mandatory to add a line of dashes under the first line of the table. There is no constraint in the size of the table. It is possible to format the array with the `:` in the second row of the array, three options are available:

| Left aligned column | Centered column | Right aligned column |
|:--------------------|:---------------:|---------------------:|
|`:-----` | `:----:` | `-----:` |

```markdown
| **One table** | One column | One second | As many as you want |
|:-------------:|:----------:|:----------:|:-------------------:|
| | And formatted line | | And bold text | | Or *italic* |
| More lines | |![An image](image://cd.jpg) | [Or a link](/contributordoc) |
```
Which would say this:

| **One table** | One column | One second | As many as you want |
|:-------------:|:----------:|:----------:|:-------------------:|
| | And formatted line | | And bold text | | Or *italic* |
| More lines | |![An image](image://cd.jpg) | [Or a link](/contributordoc) |

## Code block

To display plain text, `blocks of code' can be created using the grave accent `Alt Gr + è` :

```markdown
Either inline, for example to highlight a key like `Ctrl`.
```

or directly as a block.
The only difference is in the amount of bass accents:
At least three low pitched accents at the opening and closing of the block and two low pitched accents that frame the piece of text to be formatted in a line.

Which will give the rendering:

Either inline, for example to highlight a key like `Ctrl`.
&#39;&#39;&#39;
```markdown
or directly as a block.
The only difference is in the amount of bass accents:
At least three low pitched accents at the opening and closing of the block and two low pitched accents that frame the piece of text to be formatted in a line.
```
&#39;&#39;&#39;

## Useful links

 + The documentation of the original Markdown language: [daringfireball.net/projects/markdown](https://daringfireball.net/projects/markdown/)
 + Markdown Tutorial on [markdowntutorial.com](https://markdowntutorial.com)

## Going further

In a more general way, to understand how a text is formatted just inspect the source document with a note application. This does not mean that the YunoHost wiki will be able to exploit it. There are many other possibilities to use markdown syntax, feel free to add missing features. If you've noticed some missing features and/or have questions, please contact us on [the forum](https://forum.yunohost.org) or by direct message on the IRC room: **#yunohost** on [irc.freenode.net](https://irc.freenode.net).
