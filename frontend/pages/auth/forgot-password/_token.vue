<template>
  <div class="flex-1" style="background: url(/admin/static/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4">
          <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
            {{ $t('Change password') }}
          </h1>
          <div class="card p-4 rounded-plus bg-faded">
            <form id="js-login" @submit.prevent="send">
              <div class="form-group">
                <label class="form-label" for="password">{{ $t('New password') }}</label>
                <input type="password" :class="showMess ? 'is-invalid' : ''" v-model="form.password" name="password" id="password" class="form-control form-control-lg" placeholder="New password" required>
                <div v-if="showMess" class="invalid-feedback">{{ $t('Password does not match') }}</div>
                <div class="help-block">{{ $t('New password') }}</div>
              </div>
              <div class="form-group">
                <label class="form-label" for="password_confirmation">{{ $t('Confirm password') }}</label>
                <input type="password" :class="showMess ? 'is-invalid' : ''" v-model="form.password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Confirm password" required>
                <div v-if="showMess" class="invalid-feedback">{{ $t('Password does not match') }}</div>
                <div class="help-block">{{ $t('Confirm password') }}</div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-12 pl-lg-1 my-2">
                  <button type="submit" class="btn btn-danger btn-block btn-lg">{{ $t('Change password') }}</button>
                </div>
              </div>
              <div class="form-group text-right">
                <nuxt-link to="/auth/login">{{ $t('Login') }}</nuxt-link>
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
  auth: 'guest',
  data() {
    return {
      form: {
        extra_token: '',
        password: '',
        password_confirmation: ''
      },
      showMess: false
    }
  },
  watch: {
    form: {
      handler(data) {
        this.showMess = !!(data.password && data.password_confirmation && (data.password !== data.password_confirmation))
      },
      deep: true
    }
  },
  created() {
    this.form.extra_token = this.$route.params.token
  },
  methods: {
    async send() {
      const res = await this.$axios.$post('user/reset-password-change', this.form)
      if (res) {
        await this.$router.push('/auth/login')
      }
    }
  }
}
</script>

<style></style>
