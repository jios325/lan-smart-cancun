const webpack = require('webpack')
const path = require('path')
const endPath = path.resolve(__dirname, 'dist')
// const ExtractWebpackPlugin = require('extract-text-webpack-plugin')
const HtmlWebpackHarddiskPlugin = require('html-webpack-harddisk-plugin')
// const ModernizrWebpackPlugin = require('modernizr-webpack-plugin')
// let config = {
//   'feature-detects': [
//     'input',
//     'canvas',
//     'css/resize',
//     'css/backgroundcliptext'
//   ],
//   'options': [
//     'setClasses',
//     'testAllProps',
//     'addTest'
//   ]
// }
require('babel-polyfill')
let plugins = [
  new webpack.HotModuleReplacementPlugin(),
  new webpack.NamedModulesPlugin(),
  // new ExtractWebpackPlugin('css/estilos.css'),
  // new ModernizrWebpackPlugin(config),
  new HtmlWebpackHarddiskPlugin(),
  new webpack.optimize.CommonsChunkPlugin({
    name: 'common' // Specify the common bundle's name.
  })
]

let webPack = {
  resolve: {
    extensions: ['.js', '.jsx', '.json']
  },
  // context: path.resolve(__dirname, 'src'),
  cache: true,
  entry: {
    common: ['babel-polyfill'],
    app: './src/js/index.js'
  },
  output: {
    path: endPath,
    filename: './js/[name].bundle.js'
  },
  externals: {
    jquery: 'jQuery'
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        use: [
          'babel-loader'
        ],
        exclude: '/node_modules/'
      },
      {
        test: /\.json$/,
        use: 'json-loader'
      },
      {
        test: /\.(jpe?g|gif|png)$/i,
        use: [{
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: 'img/', // solo para produccion
            publicPath: (process.env.NODE_ENV === 'production') ? '../' : 'http://localhost:9000/'
          }
        }
        ]
      },
      {
        test: /\.css$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: { modules: true }
          }
        ]
      }
    ]
  },
  plugins: plugins
}

module.exports = webPack
