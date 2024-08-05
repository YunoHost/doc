const markdownlint = require('markdownlint');
const validImagesRule = require('../rules/valid-images');

test('validate images', () => {
    const src = `${__dirname}/assets/valid-images/test.md`;
    const results = markdownlint.sync({
        customRules: validImagesRule,
        files: [src],
    });

    expect(results[src]).toEqual([
        {
            lineNumber: 13,
            ruleNames: ['valid-images'],
            ruleDescription: 'Rule that reports if a file has valid image references',
            ruleInformation: null,
            errorDetail: 'Image src \'test.invalid\' does not link to a valid file.',
            errorContext: '![AltText](test.invalid)',
            errorRange: null,
        },
        {
            lineNumber: 17,
            ruleNames: ['valid-images'],
            ruleDescription: 'Rule that reports if a file has valid image references',
            ruleInformation: null,
            errorDetail: 'Image src \'../invalid/test.image\' does not link to a valid file.',
            errorContext: '![AltText](../invalid/test.image)',
            errorRange: null,
        },
    ]);
});
