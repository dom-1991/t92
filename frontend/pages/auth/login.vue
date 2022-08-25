<template>
  <div class="flex-1">
    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
      <div class="row justify-content-center w-100">
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4">
          <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
            {{ $t('Secure login') }}
          </h1>
          <div class="card p-4 rounded-plus bg-faded">
            <form id="js-login" @submit.prevent="login">
              <div class="form-group">
                <label class="form-label" for="username">{{ $t('Username') }}</label>
                <input v-model="form.email" id="email" class="form-control form-control-lg" required>
              </div>
              <div class="form-group">
                <label class="form-label" for="password">{{ $t('Password') }}</label>
                <input v-model="form.password" type="password" id="password" class="form-control form-control-lg" required>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-12 pl-lg-1 my-2">
                  <NuxtLink to="/auth/register">
                    <button type="button" class="btn btn-outline-info">{{ $t('Register') }}</button>
                  </NuxtLink>
                  <button type="submit" class="btn btn-outline-primary">{{ $t('Login') }}</button>
                </div>
              </div>
              <div class="form-group text-right">
                <nuxt-link to="/auth/forgot-password">{{ $t('Forgot password') }}</nuxt-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'auth',
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  },
  mounted() {

  },
  methods: {
    async login() {
      try {
        const res = await this.$auth.loginWith('local', { data: this.form })
        if (res && res.status === 200) {
          this.$auth.setUser(res.data.user)
          this.$auth.setToken('token', 'Bearer ' + res.data.access_token)
          await this.$router.push('/')
        }
      } catch (e) {}
    }
  }
}
</script>

<style></style>
