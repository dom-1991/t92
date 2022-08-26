<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <nuxt-link to="/" class="h1"><b>Admin</b>LTE</nuxt-link>
        </div>
        <div class="card-body">
          <div class="alert alert-success" v-if="isSuccess">We have e-mailed your password reset link!</div>
          <p class="login-box-msg" v-if="!isSuccess">You forgot your password? Here you can easily retrieve a new password.</p>
          <form @submit.prevent="forgotPassword">
            <div class="input-group">
              <input type="email" v-model="form.email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <validate-message :messages="errors.email" />
            <div class="row mt-3">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block" v-if="!isSuccess">Request new password</button>
                <button type="submit" class="btn btn-primary btn-block" v-if="isSuccess">Re-send</button>
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
        email: '',
      }
    }
  },
  computed: {
    isSuccess() { return this.$store.state.user.isSuccess },
    errors() { return this.$store.state.user.errors }
  },
  methods: {
    async forgotPassword() {
      await this.$root.$loading.start()
      await this.$store.dispatch('user/resetErrorMessage')
      await this.$store.dispatch('user/forgotPassword', this.form)
      await this.$root.$loading.finish();
    },
  }
}
</script>
