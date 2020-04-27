require('dotenv').config()
const ncp = require('ncp').ncp;
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')
const PORT = process.env.NUXT_PORT || 3000;

module.exports = {
  mode: 'universal', // Comment this for SSR
  server: {
    port: PORT
  },
  srcDir: __dirname,

  env: {
    appName: process.env.APP_NAME || 'Laravel Nuxt',
    appLocale: process.env.APP_LOCALE || 'en',
  },

  head: {
    title: 'Mirrorshop',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  loading: { color: '#007bff' },

  css: [
    { src: '~assets/sass/app.scss', lang: 'scss' }
  ],

  plugins: [
    '~plugins/i18n',
    '~plugins/VeeValidate',
    // '~plugins/nuxt-client-init', // Comment this for SSR
  ],

  modules: [
    '@nuxtjs/router',
    '@nuxtjs/svg-sprite',
  ],

  svgSprite: {
    input: '~/static/images/sprite-original',
    output: '~/static/images/sprite',
    spriteClassPrefix: null,
    elementClass: null,
  },

  router: {
    base: '/',
  },

  build: {
    extractCSS: true
  },

  hooks: {
    generate: {
      done (generator) {
        // Copy dist files to public/_nuxt
        if (generator.nuxt.options.dev === false && generator.nuxt.options.mode === 'spa') {
          const publicDir = join(generator.nuxt.options.rootDir, 'public', '_nuxt')
          removeSync(publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '_nuxt'), publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '200.html'), join(publicDir, 'index.html'))
          removeSync(generator.nuxt.options.generate.dir)
        }
      }
    },
    build: {
      done (builder) {
        const publicDir = join(builder.nuxt.options.rootDir, 'public', '_nuxt');
        removeSync(publicDir);
        
        const src = join(builder.nuxt.options.buildDir, '/dist/client');
        ncp(src, publicDir, function (err) {
          if (err) {
            return console.error(err);
          }
          console.log('done!');
         });
      }
    }
  }
}
