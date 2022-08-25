export default {
  mode: 'spa',
  /*
  ** Headers of the page
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/fontawesome-free/css/all.min.css' },
      { rel: 'stylesheet', href: 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/jqvmap/jqvmap.min.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/dist/css/adminlte.min.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/daterangepicker/daterangepicker.css' },
      { rel: 'stylesheet', href: '/vendor/admin-lte/plugins/summernote/summernote-bs4.css' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' }
    ],
    script: [
      { src: '/vendor/admin-lte/plugins/jquery/jquery.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/jquery-ui/jquery-ui.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/chart.js/Chart.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/sparklines/sparkline.js', body: true },
      { src: '/vendor/admin-lte/plugins/jqvmap/jquery.vmap.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js', body: true },
      { src: '/vendor/admin-lte/plugins/jquery-knob/jquery.knob.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/moment/moment.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/daterangepicker/daterangepicker.js', body: true },
      { src: '/vendor/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/summernote/summernote-bs4.min.js', body: true },
      { src: '/vendor/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js', body: true },
      { src: '/vendor/admin-lte/dist/js/adminlte.js', body: true }
    ],
    bodyAttrs: {
      class: 'hold-transition sidebar-mini layout-fixed'
    }

  },
  /*
  ** Customize the progress-bar color
  */
  loading: '~/components/common/Loading.vue',
  /*
  ** Global CSS
  */
  css: [
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    '~plugins/axios',
    '~/plugins/repositories.js'
  ],

  router: {
    middleware: ['auth']
  },

  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    // Doc: https://github.com/nuxt-community/eslint-module
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/vendor',
    '@nuxtjs/auth-next'
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
    }
  },
  axios: {
    // proxy: true
    baseURL: process.env.API_URL,
  },

  auth: {
    strategies: {
      google: {
        clientId: process.env.GOOGLE_CLIENT_ID,
        codeChallengeMethod: '',
        responseType: 'id_token token',
      },
      facebook: {
        endpoints: {
          userInfo: 'https://graph.facebook.com/v6.0/me?fields=id,name,picture{url}'
        },
        clientId: process.env.FACEBOOK_CLIENT_ID,
        scope: ['public_profile', 'email']
      },
      local: {
        endpoints: {
          login: { url: '/auth/login', method: 'post' },
          logout: { url: '/auth/logout', method: 'post' },
          user: false,
        }
      }
    },
    redirect: {
      login: '/auth/login',
      home: '/',
    }
  },
  vendor: [ 'admin-lte' ]
}
