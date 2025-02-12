const transliteration = require('transliteration');
const fs = require('fs');
const url = require('url');
const md = require('markdown-it')({ html: true });
const helpers = require('markdownlint/helpers/helpers');
const flat = require('../lib/flat');

const validateAnchor = (link, href, tokens, onError) => {
    let anchorFound = false;
    tokens.filter((token) => token.type === 'heading_open').forEach((heading) => {
        if (!heading.line) {
            return;
        }

        const headingAnchor = transliteration.slugify(heading.line.toLowerCase(), {
            replace: {
                ä: 'ae',
                ö: 'oe',
                ü: 'ue',
            },
        });

        if (`#${headingAnchor}` === href) {
            anchorFound = true;
        }
    });
    if (!anchorFound) {
        onError({
            lineNumber: link.lineNumber,
            detail: `Did not find matching heading for anchor '${href}'`,
            context: link.line,
        });
    }
};

// Annotate tokens with line/lineNumber, duplication from markdownlint because function
// is not exposed
const annotateTokens = (tokens, lines) => {
    let tbodyMap = null;
    return tokens.map((token) => {
        // Handle missing maps for table body
        if (token.type === 'tbody_open') {
            tbodyMap = token.map.slice();
        } else if ((token.type === 'tr_close') && tbodyMap) {
            tbodyMap[0] += 1;
        } else if (token.type === 'tbody_close') {
            tbodyMap = null;
        }
        const mappedToken = token;
        if (tbodyMap && !token.map) {
            mappedToken.map = tbodyMap.slice();
        }
        // Update token metadata
        if (token.map) {
            mappedToken.line = lines[token.map[0]];
            mappedToken.lineNumber = token.map[0] + 1;
            // Trim bottom of token to exclude whitespace lines
            while (token.map[1] && !(lines[token.map[1] - 1].trim())) {
                mappedToken.map[1] -= 1;
            }
            // Annotate children with lineNumber
            let childLineNumber = token.lineNumber;
            (token.children || []).map((child) => {
                const mappedChild = child;
                mappedChild.lineNumber = childLineNumber;
                mappedChild.line = lines[childLineNumber - 1];
                if ((child.type === 'softbreak') || (child.type === 'hardbreak')) {
                    childLineNumber += 1;
                }
                return mappedChild;
            });
        }

        return mappedToken;
    });
};

const parseMarkdownContent = (fileContent) => {
    // Remove UTF-8 byte order marker (if present)
    let content = fileContent.replace(/^\ufeff/, '');
    // Ignore the content of HTML comments
    content = helpers.clearHtmlCommentText(content);
    // Parse content into tokens and lines
    const tokens = md.parse(content, {});
    const lines = content.split(helpers.newLineRe);
    return annotateTokens(tokens, lines);
};

module.exports = {
    names: ['valid-internal-links'],
    description: 'Rule that reports if a file has an internal link to an invalid file',
    tags: ['test'],
    function: function rule(params, onError) {
        flat(params.tokens).filter((token) => token.type === 'link_open').forEach((link) => {
            link.attrs.forEach((attr) => {
                if (attr[0] === 'href') {
                    const href = attr[1];
                    if (href.match(/^#/)) {
                        validateAnchor(link, href, params.tokens, onError);
                    } else if (href && !href.match(/^(mailto:|https?:)/)) {
                        const parsedHref = url.parse(href);
                        let path;
                        if (parsedHref.pathname.match(/^\//)) {
                            path = `pages${parsedHref.pathname}`;
                        } else {
                            path = `${params.name.split('/').slice(0, -1).join('/')}/${parsedHref.pathname}`;
                        }
                        if (!fs.existsSync(path) || !fs.lstatSync(path).isFile()) {
                            onError({
                                lineNumber: link.lineNumber,
                                detail: `Relative link '${href}' does not link to a valid file.`,
                                context: link.line,
                            });
                        } else if (parsedHref.hash) {
                            // console.log(md.parse(fs.readFileSync(path).toString()));
                            validateAnchor(
                                link,
                                parsedHref.hash,
                                parseMarkdownContent(fs.readFileSync(path).toString()),
                                onError,
                            );
                        }
                    }
                }
            });
        });
    },
};
