<template>
  <div class="flex-1">
    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4">
          <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
            {{ $t('Secure login') }}
          </h1>
          <div class="card p-4 rounded-plus bg-faded">
            <form id="js-login" @submit.prevent="login">
              <div class="form-group">
                <label class="form-label" for="username">{{ $t('Username') }}</label>
                <input v-model="form.username" id="username" class="form-control form-control-lg" required>
                <div class="help-block">{{ $t('Your unique username to app') }}</div>
              </div>
              <div class="form-group">
                <label class="form-label" for="password">{{ $t('Password') }}</label>
                <input v-model="form.password" type="password" id="password" class="form-control form-control-lg" required>
                <div class="help-block">{{ $t('Your password') }}</div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-12 pl-lg-1 my-2">

                  <button type="submit" class="btn btn-primary">{{ $t('Login') }}</button>
                </div>
              </div>
              <div class="form-group text-right">
                <nuxt-link to="/auth/forgot-password">{{ $t('Forgot password') }}</nuxt-link>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
        2020 © Grooo web framework
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
        username: '',
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
          await this.$router.push('/')
        }
      } catch (e) {}
    }
  }
}
</script>

<style></style>
