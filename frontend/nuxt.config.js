export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  server: {
    port: 3000,
    host: '0.0.0.0'
  },
  head: {
    title: 'Base frontend',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/repositories.js',
    '~/config/constant.js'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    'bootstrap-vue/nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/dotenv',
    '@nuxtjs/auth',
    'nuxt-i18n'
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },

  i18n: {
    locales: [
      {
        code: 'vn',
        iso: 'vn-VN',
        name: 'Vietnamese',
        file: 'vn.json'
      },
      {
        code: 'en',
        iso: 'en-US',
        name: 'English',
        file: 'en.json'
      }
    ],
    defaultLocale: 'vn',
    seo: false,
    lazy: true,
    detectBrowserLanguage: {
      cookieKey: 'redirected',
      useCookie: true
    },
    langDir: 'config/locales/',
    parsePages: false,
    pages: {},
    strategy: 'no_prefix',
    vueI18n: {
      fallbackLocale: 'vn',
      silentTranslationWarn: true, // Disable warning
      silentFallbackWarn: true, // Disable warning
    }
  },

  axios: {
    // proxy: true
    baseURL: process.env.API_URL,
  },

  moment: {
    defaultTimezone: 'Asia/Ho_Chi_Minh',
    locales: ['vi']
  },

  auth: {
    strategies: {
      local: {
        token: {
          property: 'token',
          global: true,
          // required: true,
          // type: 'Bearer'
        },
        user: {
          property: 'user',
          // autoFetch: true
        },
        endpoints: {
          login: { url: '/api/auth/login', method: 'post'},
          logout: false,
          user: false
        }
      }
    }
  },

  loading: {
    color: 'blue',
    height: '5px'
  }
}
