<template>
  <div>
    <NavBar />
    <SideBar :logout="logout" />
    <nuxt class="content-wrapper" />
    <Footer />
  </div>
</template>

<script>
import NavBar from '../components/pages/NavBar'
import SideBar from '../components/pages/SideBar'
import Footer from '../components/pages/Footer'
export default {
  components: {
    NavBar, SideBar, Footer
  },
  methods: {
    async logout () {
      this.$root.$loading.start()
      await this.$auth.logout()
      await this.$router.push('/auth/login')
      this.$root.$loading.finish()
    }
  }
}
</script>
