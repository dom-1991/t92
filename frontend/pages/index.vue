<template>
  <div class="container-fluid">
    <div class="p-4 justify-content-center">
      <logo />
    </div>
    <div class="row">
      <NuxtLink to="/auth/login" v-if="!this.$store.state.auth.loggedIn">
        <button class="btn btn-outline-primary">Login</button>
      </NuxtLink>
      <div>
        <button class="btn btn-outline-primary"  @click.prevent="logout" v-if="this.$store.state.auth.loggedIn">Logout</button>
      </div>
      <p>{{ this.$auth.getToken('token') }}</p>
    </div>
    <div class="row">
<!--      <post v-for="(post, i) in posts" :key="i" :post="post" />-->
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import Logo from '~/components/Logo.vue'
export default {
  components: {
    Logo,
  },
  // async fetch({ store }) {
  //   await store.dispatch('user/get_users')
  // },
  // computed: {
  //   ...mapState({
  //     users: (state) => {
  //       return state.user.users
  //     }
  //   })
  // }
  methods: {
    async logout() {
      await this.$store.dispatch('user/logout')
    }
  }
}
</script>

<style>
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
  'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
