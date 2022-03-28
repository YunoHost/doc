var webpack = require('webpack');
var path = require('path');
var TerserPlugin = require('terser-webpack-plugin');
var isProd = process.env.NODE_ENV === 'production' || process.env.NODE_ENV === 'production-wip';
var VueLoaderPlugin = require('vue-loader/lib/plugin');
const ESLintWebpackPlugin = require('eslint-webpack-plugin');

module.exports = {
    entry: {
        'flex-objects': './app/main.js'
    },
    devtool: isProd ? false : 'eval-source-map',
    target: 'web',
    output: {
        path: path.resolve(__dirname, 'js'),
        filename: '[name].js',
        chunkFilename: 'flex-objects-vendor.js'
    },
    optimization: {
        minimize: isProd,
        minimizer: [
            new TerserPlugin({
                terserOptions: {
                    compress: {
                        drop_console: true
                    },
                    dead_code: true
                }
            })
        ]
        /* , splitChunks: {
            cacheGroups: {
                vendors: {
                    test: /[\\/]node_modules[\\/]/,
                    priority: 1,
                    name: 'vendor',
                    enforce: true,
                    chunks: 'all'
                }
            }
        }*/
    },
    plugins: [
        new webpack.ProvidePlugin({
            'fetch': 'imports-loader?this=>global!exports-loader?global.fetch!whatwg-fetch'
        }),
        new VueLoaderPlugin(),
        new ESLintWebpackPlugin()
    ],
    externals: {
        jquery: 'jQuery',
        'grav-config': 'GravConfig'
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env'],
                    plugins: ['@babel/plugin-proposal-object-rest-spread']
                }
            },
            { test: /\.vue$/, use: ['vue-loader'] },
            { test: /\.(png|jpg|gif|svg)$/, loader: 'file', options: { name: '[name].[ext]?[hash]' } }
        ]
    }
};
