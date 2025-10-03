const mqpacker = require('css-mqpacker');
const sortCSSmq = require('sort-css-media-queries');

module.exports = (ctx = {}) => {
  const cfg = (ctx.options && ctx.options.ctx) || ctx.ctx || {};

  const isProd =
    (cfg.env && cfg.env.production) ||
    (cfg.enabled && cfg.enabled.optimize) ||
    process.env.NODE_ENV === 'production';

  return {
    plugins: [
      require('autoprefixer'),
      // Make sure to arrange & pack all @media blocks to end of the file
      mqpacker({ sort: sortCSSmq }),
      ...(isProd
        ? [
            require('cssnano')({
              preset: [
                'default',
                { svgo: false, discardComments: { removeAll: true }, mergeRules: false },
              ],
            }),
          ]
        : []),
    ],
  };
};
