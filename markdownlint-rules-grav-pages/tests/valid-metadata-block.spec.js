const markdownlint = require('markdownlint');
const validMetadataBlockRule = require('../rules/valid-metadata-block');

// TODO add more test cases

test('validate valid minimum block', () => {
    const src = `${__dirname}/assets/valid-metadata-block/valid-minimum-block.md`;
    const results = markdownlint.sync({
        customRules: validMetadataBlockRule,
        files: [src],
    });

    expect(results[src]).toEqual([]);
});

test('validate too long title', () => {
    const src = `${__dirname}/assets/valid-metadata-block/invalid-too-long-title.md`;
    const results = markdownlint.sync({
        customRules: validMetadataBlockRule,
        files: [src],
    });

    expect(results[src]).toEqual([{
        errorContext: 'title: VeryLongTitleVeryLongTitleVeryLongTitleVeryLongTitleVeryLongTitleVeryLongTitleVeryLongTitleVeryLongTitleVeryLongTitle',
        errorDetail: 'instance.title does not meet maximum length of 80',
        errorRange: null,
        lineNumber: 5,
        ruleDescription: 'Rule that reports if a file does not have a valid grav metadata block',
        ruleInformation: null,
        ruleNames: ['valid-metadata-block'],
    }]);
});

test('validate unrecognized property', () => {
    const src = `${__dirname}/assets/valid-metadata-block/invalid-unrecognized-property.md`;
    const results = markdownlint.sync({
        customRules: validMetadataBlockRule,
        files: [src],
    });

    expect(results[src]).toEqual([{
        errorContext: 'title: My Page\ninvalid: field',
        errorDetail: 'instance additionalProperty "invalid" exists in instance when not allowed',
        errorRange: null,
        lineNumber: 6,
        ruleDescription: 'Rule that reports if a file does not have a valid grav metadata block',
        ruleInformation: null,
        ruleNames: ['valid-metadata-block'],
    }]);
});

test('validate valid taxonomy', () => {
    const src = `${__dirname}/assets/valid-metadata-block/valid-taxonomy.md`;
    const results = markdownlint.sync({
        customRules: validMetadataBlockRule,
        files: [src],
    });

    expect(results[src]).toEqual([]);
});
