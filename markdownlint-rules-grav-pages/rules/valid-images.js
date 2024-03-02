const fs = require('fs');
const flat = require('../lib/flat');

module.exports = {
    names: ['valid-images'],
    description: 'Rule that reports if a file has valid image references',
    tags: ['test'],
    function: function rule(params, onError) {
        flat(params.tokens).filter((token) => token.type === 'image').forEach((image) => {
            image.attrs.forEach((attr) => {
                if (attr[0] === 'src') {
                    let imgSrc = attr[1];
                    if (!imgSrc.match(/^(https?:)/)) {
                        if (imgSrc.includes('?')) {
                            imgSrc = imgSrc.slice(0, imgSrc.indexOf('?'));
                        }
                        const path = `${params.name.split('/').slice(0, -1).join('/')}/${imgSrc}`;

                        if (!fs.existsSync(path) || !fs.lstatSync(path).isFile()) {
                            onError({
                                lineNumber: image.lineNumber,
                                detail: `Image src '${imgSrc}' does not link to a valid file.`,
                                context: image.line,
                            });
                        }
                    }
                }
            });
        });
    },
};
