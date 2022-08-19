<template>

</template>

<script>
import { mapState } from 'vuex'
export default {
  async fetch({ store }) {
    await store.dispatch('user/get_users')
  },
  computed: {
    ...mapState({
      users: (state) => {
        return state.user.users
      }
    })
  }
}
</script>
