import Vuex from 'vuex';
import Vue from 'vue'
import createLogger from 'vuex/dist/logger';

// Modules

const debug = process.env.NODE_ENV !== 'production';

Vue.use(Vuex)

export default () => new Vuex.Store({
  modules: {
  },
  strict: debug,
  plugins: debug ? [createLogger()] : [],
})
