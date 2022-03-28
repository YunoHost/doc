var webpack = require('webpack'),
    path = require('path');

module.exports = env => {
    console.log("Environment: " + env.NODE_ENV);

    return {
        entry: './app/main.js',
        /* entry: {
            app: './app/main.js',
            vendor: ['whatwg-fetch', 'history', 'lodash']
        },*/
        devtool: env.dev ? 'cheap-module-eval-source-map' : 'nosources-source-map',
        output: {
            path: path.resolve(__dirname, 'assets'),
            filename: 'tntsearch.js'
        },
        plugins: [
            new webpack.ProvidePlugin({
                'fetch': 'imports-loader?this=>global!exports-loader?global.fetch!whatwg-fetch'
            }),
            // new webpack.optimize.CommonsChunkPlugin({ name: 'vendor', filename: 'vendor.js' }),
            new webpack.optimize.UglifyJsPlugin({
                compress: { warnings: false },
                sourceMap: env.dev,
                output: { comments: false, semicolons: true }
            })
        ],
        module: {
            rules: [
                { enforce: 'pre', test: /\.json$/, loader: 'json-loader' },
                { enforce: 'pre', test: /\.js$/, loader: 'eslint-loader', exclude: /node_modules/ },
                { test: /\.css$/, loader: 'style-loader!css-loader' },
                {
                    test: /\.js$/,
                    loader: 'babel-loader',
                    exclude: /node_modules/,
                    query: {
                        presets: ['es2015', 'stage-3']
                    }
                }
            ]
        }
    }
};
