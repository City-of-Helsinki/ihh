module.exports = {
  'extends': ['stylelint-config-standard'],
  'plugins': ['stylelint-scss'],
  'rules': {
    'at-rule-no-unknown': null,
    'scss/at-rule-no-unknown': true,

    'selector-pseudo-element-colon-notation': 'double',
    'no-descending-specificity': null,
    'no-empty-source': null,

    'declaration-colon-newline-after': null,
    'selector-combinator-space-before': null,
    'selector-descendant-combinator-no-non-space': null,
    'comment-whitespace-inside': null,
    'no-duplicate-selectors': null,
    'indentation': null,
  },
};
