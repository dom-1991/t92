<template>
  <div class="hold-transition login-page" v-if="isSuccess">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <nuxt-link to="/" class="h1"><b>Admin</b>LTE</nuxt-link>
        </div>
        <div class="card-body">
          <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
          <form @submit.prevent="resetPassword">
            <div class="input-group">
              <input type="email" v-model="form.email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <validate-message :messages="errors.email" />
            <div class="input-group mt-3">
              <input type="password" v-model="form.new_password" class="form-control" placeholder="New Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <validate-message :messages="errors.new_password" />
            <div class="input-group mt-3">
              <input type="password" v-model="form.new_password_confirmation" class="form-control" placeholder="Confirm New Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <validate-message :messages="errors.new_password_confirmation" />
            <div class="row mt-3">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Change password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <p class="mt-3 mb-1">
            <nuxt-link to="/auth/login">Login</nuxt-link>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
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
        email: this.$route.query.email,
        new_password: '',
        new_password_confirmation: '',
        token: this.$route.query.token
      }
    }
  },
  computed: {
    isSuccess() { return this.$store.state.user.isSuccess },
    errors() { return this.$store.state.user.errors }
  },
  created() {
    this.$store.dispatch('user/checkTokenResetPassword', {token: this.form.token, email: this.form.email})
  },
  methods: {
    async resetPassword() {
      await this.$root.$loading.start()
      await this.$store.dispatch('user/resetErrorMessage')
      await this.$store.dispatch('user/resetPassword', this.form)
      await this.$root.$loading.finish();
    },
  }
}
</script>
