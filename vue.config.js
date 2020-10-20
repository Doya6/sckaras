module.exports = {
  publicPath: process.env.NODE_ENV === 'production'
    ? '/production-sub-path/'
    : '/',
  //lintOnSave: false,
  lintOnSave: process.env.NODE_ENV !== 'production',
  transpileDependencies: [
    'vuetify'
  ]
}
