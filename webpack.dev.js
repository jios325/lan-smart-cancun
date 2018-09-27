const merge = require('webpack-merge')
const common = require('./webpack.common.js')
const path = require('path')
const endPath = path.resolve(__dirname, 'dist')

module.exports = merge(common, {
  // output: {
  //   publicPath: 'http://localhost:9000/'
  // },
  devtool: 'inline-source-map',
  devServer: {
    hot: true,
    contentBase: endPath,
    // host: '10.124.1.204',
    // host: '192.168.6.26',
    host: 'localhost',
    inline: true,
    compress: true,
    port: 9000,
    publicPath: 'http://localhost:9000/'
  }
})
