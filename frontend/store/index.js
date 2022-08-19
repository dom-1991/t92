import Vuex from 'vuex';
import Vue from 'vue'
import createLogger from 'vuex/dist/logger';

// Modules
import user from './modules/user';

const debug = process.env.NODE_ENV !== 'production';

Vue.use(Vuex)

export default () => new Vuex.Store({
  modules: {
    user,
  },
  strict: debug,
  plugins: debug ? [createLogger()] : [],
})
