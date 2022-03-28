# Contributing and Development

Pull Requests and Issues are very welcome on this repository, but please review this document first.

## Bugs

A bug is a _demonstrable problem_ that is caused by the code in the repository.

Guidelines for bug reports:

1. Check that you satisfy the **[Grav requirements](http://learn.getgrav.org/basics/requirements)**

2. **Check that this happens on a clean Grav installation** &mdash; check if the issue happens on any Grav site, or just with a specific configuration of plugins / themes

3. Use the **[GitHub issue search](https://github.com/OleVik/grav-plugin-presentation/issues)** &mdash; check if the issue has already been reported

4. Check if the issue is already being solved in a **[Pull Request](https://github.com/OleVik/grav-plugin-presentation/pulls)**

5. Create a [reduced test case](http://css-tricks.com/reduced-test-cases/) and **provide step-by-step instructions on how to recreate the problem**: Include code samples, Page snippets or YAML-configuration like plugin settings or FrontMatter as needed, **as well as the version of Grav, the plugin, and other plugins or themes**

A good bug report shouldn't leave out information. Please try to be as detailed as possible in your report.

- What is your environment? Is it localhost, OSX, Linux, on a remote server? Is the same thing happening locally or on the remote server, or just on Windows?

- What steps will reproduce the issue? What browser(s) and OS' experience the problem?

- What would you expect to be the outcome?

- Did the problem start happening recently &mdash; e.g. after updating to a new version of something &mdash; or was this always a problem?

- Can you reliably reproduce the issue? If not, provide details about how often the problem happens and under which conditions it normally happens.

All these details will help to fix any potential bugs.

Important: [include Code Samples in triple backticks](https://help.github.com/articles/github-flavored-markdown/#fenced-code-blocks) so that Github will provide a proper indentation. [Add the language name after the backticks](https://help.github.com/articles/github-flavored-markdown/#syntax-highlighting) to add syntax highlighting to the code snippets.

## Feature requests

Feature requests are welcome, and submitted to [issues](https://github.com/OleVik/grav-plugin-presentation/issues). But take a moment to find out whether your idea fits with the scope and aims of the project. It's up to *you* to make a strong case to convince the project's developers of the merits of this feature. Please provide as much detail and context as possible.

## Pull requests

Good pull requests - patches, improvements, new features - are a fantastic help. They should remain focused in scope and not contain unrelated commits. They must also adhere to the current code standards. See [Using Pull Request](https://help.github.com/articles/using-pull-requests/) and [Fork a Repo](https://help.github.com/articles/fork-a-repo/) if you are not familiar with Pull Requests.

**IMPORTANT**: By submitting a patch, you agree to allow the project owner to
license your work under the same license as that used by the project.

## PHP Code Standards

This plugin follows PSR-1, PSR-2, and PEAR coding standards (use CodeSniffer), as well as PSR-4.

## Style-compilation

Use a SCSS-compiler, like [LibSass](https://github.com/sass/libsass), eg. [node-sass](https://github.com/sass/node-sass) and compiled `scss/presentation.scss` to `css/presentation.css` in the theme-folder. For example: `node-sass --watch --source-map true --output-style compressed scss/presentation.scss css/presentation.css`. Requires Node-modules to be installed first.

## Extending

As demonstrated by the `content`, `parser`, and `transport` options, you can fairly easily extend the behavior of the plugin. For example, if you install the [Presentation Deckset Plugin](https://github.com/OleVik/grav-plugin-presentation-deckset/), you could set this to `parser: 'DecksetParser'` to use the [Deckset](https://www.deckset.com/)-syntax. Addons written this way must implement the corresponding interface, and extend the base class provided by the plugin. Eg., `class DecksetParser extends Parser implements ParserInterface`.

## Customizing the blueprints

The plugin searches for `presentation.yaml` and `slide.yaml` in the current theme's blueprints-folder, and then user's blueprints-folder, to override the Plugin's own Page-blueprints. With you can use your Theme or Skeleton to create custom blueprints for this Page Types.
