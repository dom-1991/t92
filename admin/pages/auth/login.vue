<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <nuxt-link to="/"  class="h1"><b>Admin</b>LTE</nuxt-link>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form @submit.prevent="login">
            <div class="input-group">
              <input type="email"
                     v-model="form.email"
                     class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <validate-message :messages="errors.email" />
            <div class="input-group mt-3">
              <input type="password"
                     v-model="form.password"
                     class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <validate-message :messages="errors.password" />
            <div class="row mt-3">
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" @click.prevent="loginFacebook" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" @click.prevent="loginGoogle" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-0">
            <nuxt-link to="/auth/forgot-password">Forgot password</nuxt-link>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<script>

import ValidateMessage from '~/components/common/ValidateMessage.vue';
export default {
  layout: 'auth',
  auth: 'guest',
  components: {
    ValidateMessage
  },
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
    }
  },
  computed: {
    errors() { return this.$store.state.user.errors }
  },
  methods: {
    async login() {
      await this.$root.$loading.start()
      await this.$store.dispatch('user/resetErrorMessage')
      await this.$store.dispatch('user/loginLocal', { data: this.form })
      await this.$root.$loading.finish();
    },

    loginGoogle() {
      this.$auth.loginWith('google', { params: { prompt: "select_account" } })
    },

    loginFacebook() {
      this.$auth.loginWith('facebook')
    },
  }
}
</script>
