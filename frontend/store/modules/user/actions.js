export default {
  async get_users({ commit }) {
    const res = await this.$repositories.user.all()
    const { status, data } = res
    if (status === 200 && data.success && data.code) {
      const { data } = data
      commit('SET_USERS', data)
    } else {
      // Handle error here
    }
  },

  async get_user({ commit }, user) {
    const res = await this.$repositories.post.show(user)
    const { status, data } = res
    if (status === 200 && data.success && data.code) {
      const { data } = data
      commit('SET_USER', data)
    } else {
      // Handle error here
    }
  },

  async create_user({ commit }, user) {
    const res = await this.$repositories.post.create(user)
    const { status, data } = res
    if (status === 200 && data.success && data.code) {
      const { data } = data
      commit('SET_USER', data)
    } else {
      // Handle error here
    }
  },

  async update_user({ commit }, id, user) {
    const res = await this.$repositories.post.update(id, user)
    const { status, data } = res
    if (status === 200 && data.success && data.code) {
      const { data } = data
      commit('SET_USER', data)
    } else {
      // Handle error here
    }
  },

  async delete_user({ commit }, id) {
    const res = await this.$repositories.post.delete(id)
    const { status, data } = res
    if (status === 200 && data.success && data.code) {
      // Remove from store
    } else {
      // Handle error here
    }
  },

  async logout() {
    const res = await this.$repositories.auth.logout(this.$auth.getToken('token'))
    const { status, data } = res
    if (status === 200) {
      this.$auth.logout()
      this.$auth.setToken('token', '')
    } else {
      // Handle error here
    }
  }
};
