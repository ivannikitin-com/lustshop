const defaultConfig = require('./node_modules/@wordpress/scripts/config/webpack.config');
const path = require('path');
const postcssAutoprefixer = require('autoprefixer');
const postcssPresetEnv = require('postcss-preset-env');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const IgnoreEmitPlugin = require('ignore-emit-webpack-plugin');

module.exports = {
    ...defaultConfig,
    entry: {
        index: path.resolve(process.cwd(), 'src', 'index.js'),
        style: path.resolve(process.cwd(), 'src', 'sass', 'style.scss'),
        'editor-style': path.resolve(process.cwd(), 'src', 'sass', 'editor-style.scss'),
        woocommerce: path.resolve(process.cwd(), 'src', 'sass', 'woocommerce.scss'),
    },
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
            {
                test: /\.s[ac]ss$/i,
                exclude: /node_modules/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader',
                    {
                        loader: 'sass-resources-loader',
                        options: {
                            resources: [
                                './src/sass/_variables.scss',
                                './src/sass/mixins/**/*.scss',
                            ],
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: () => [
                                postcssAutoprefixer(),
                                postcssPresetEnv({
                                    stage: 3,
                                    features: {
                                        'custom-media-queries': {
                                            preserve: false,
                                        },
                                        'custom-properties': {
                                            preserve: true,
                                        },
                                        'nesting-rules': true,
                                    },
                                }),
                            ],
                        },
                    },
                    'import-glob-loader',
                ],
            },
        ],
    },
    plugins: [
        ...defaultConfig.plugins,
        new MiniCssExtractPlugin({
            filename: '[name].css',
            chunkFilename: '[id].css',
            ignoreOrder: false,
        }),
        new IgnoreEmitPlugin([/\.php$/, /\.map$/, 'style.js', 'editor-style.js', 'woocommerce.js']),
    ],
};
