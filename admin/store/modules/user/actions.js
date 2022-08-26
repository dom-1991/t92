/* ============
 * Actions for the account module
 * ============
 *
 * The actions that are available on the
 * account module.
 */

export default {
  async socialGetToken({ commit }) {
    const payload = {
      provider: this.$auth.strategy.options.name,
      token: this.$auth.strategy.token.get().replace('Bearer ', '')
    }
    await this.$repositories.user.socialGetToken(payload)
  },

  async loginLocal({ commit }, payload) {
    try {
      const res = await this.$auth.loginWith('local', payload)
      if (res && res.status === 200) {
        const { data } = res
        await this.$auth.$storage.syncUniversal('_token.local',  'Bearer ' + data.access_token)
        await this.$auth.setUser(data.user)
        await this.$router.push('/')
      }
    } catch (e) {
      const { response } = e
      if (response && response.status === 422) {
        this.errors = response.data
        commit('SET_ERRORS', response.data)
      }
    }
  },

  async resetErrorMessage ({ commit }) {
    const blankError = {
      email: [],
      password: [],
      new_password: [],
      new_password_confirmation: [],
    }
    commit('SET_ERRORS', blankError)
  },

  async forgotPassword({ commit }, payload) {
    try {
      const res = await this.$repositories.user.forgotPassword(payload)
      if (res && res.status === 200) {
        commit('SET_SUCCESS', true)
      }
    } catch (e) {
      const { response } = e
      commit('SET_SUCCESS', false)
      if (response && response.status === 422) {
        this.errors = response.data
        commit('SET_ERRORS', response.data)
      }
    }
  },

  async resetPassword({ commit }, payload) {
    try {
      const res = await this.$repositories.user.resetPassword(payload)
      if (res && res.status === 200) {
        await this.$router.push('/auth/login')
        this.$toast.success(res.data.message).goAway(3000)
      }
    } catch (e) {
      const { response } = e
      if (response && response.status === 422) {
        this.errors = response.data
        commit('SET_ERRORS', response.data)
      } else {
        this.$toast.error(e.response.data.message).goAway(3000)
      }
    }
  },

  async checkTokenResetPassword({ commit }, payload) {
    try {
      const res = await this.$repositories.user.checkTokenResetPassword(payload)
      if (res && res.status === 200) {
        commit('SET_SUCCESS', true)
      }
    } catch (e) {
      await this.$router.push('/auth/forgot-password')
      this.$toast.error(e.response.data.message).goAway(3000)
      commit('SET_SUCCESS', false)
    }
  },
}
