const DirectoryNamedWebpackPlugin = require('directory-named-webpack-plugin');

module.exports = {
  filenameHashing: false,
  publicPath: process.env.NODE_ENV === 'development'
    ? `http://${process.env.DEV_HOST}:${process.env.DEV_PORT}/`
    : '/',
  configureWebpack: {
    resolve: {
      plugins: [
        new DirectoryNamedWebpackPlugin(),
      ],
    },
    optimization: {
      splitChunks: false,
    },
  },
  chainWebpack: (webpackConfig) => {
    webpackConfig.plugins.delete('html');
    webpackConfig.plugins.delete('preload');
    webpackConfig.plugins.delete('prefetch');
  },
  devServer: {
    host: process.env.DEV_HOST,
    port: process.env.DEV_PORT,
    disableHostCheck: true,
    headers: {
      'Access-Control-Allow-Origin': '*',
    },
  },
};
