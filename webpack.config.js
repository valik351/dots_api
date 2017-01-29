var webpack = require('webpack');
var path = require('path');

module.exports = {
    devtool: 'source-map',
    entry: path.resolve(__dirname, 'resources/assets/js/app.js'),
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname, 'public/assets'),
        publicPath: '/',
    },
    plugins: [
        new webpack.ProvidePlugin({
            jQuery: 'jquery',
            $: 'jquery',
            'Tether': 'tether',
        }),
    ],
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                loader: 'babel?presets[]=es2015',
            },
            {
                test: /\.scss$/,
                loader: 'style!css!resolve-url-loader!sass?sourceMap'
            },
            {
                test: /\.woff(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/font-woff&name=fonts/[name].[ext]&publicPath=/assets/'
            }, {
                test: /\.woff2(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/font-woff&name=fonts/[name].[ext]&publicPath=/assets/'
            }, {
                test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/octet-stream&name=fonts/[name].[ext]&publicPath=/assets/'
            }, {
                test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'file?name=fonts/[name].[ext]&publicPath=/assets/'
            }, {
                test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=image/svg+xml&name=fonts/[name].[ext]&publicPath=/assets/'
            }, {
                test: /\.(jpe?g|png|gif|svg)$/i,
                loader: 'url?limit=10000!img?progressive=true'
            }
        ]
    },
    devServer: {
        contentBase: 'public',
        colors: true,
        publicPath: 'http://localhost:8080'
    }
};