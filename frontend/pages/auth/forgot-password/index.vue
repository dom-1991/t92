<template>
  <div class="flex-1" style="background: url(/admin/static/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4">
          <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
            {{ $t('Reset password') }}
          </h1>
          <div class="card p-4 rounded-plus bg-faded">
            <form id="js-login" @submit.prevent="send">
              <template v-if="!showMess">
                <div class="form-group">
                  <label class="form-label" for="email">{{ $t('Email') }}</label>
                  <input v-model="form.email" name="email" id="email" class="form-control form-control-lg" placeholder="Email" required>
                  <div class="help-block">{{ $t('Your email') }}</div>
                </div>
                <div class="row no-gutters">
                  <div class="col-lg-12 pl-lg-1 my-2">
                    <button type="submit" class="btn btn-danger btn-block btn-lg">{{ $t('Reset password') }}</button>
                  </div>
                </div>
                <div class="form-group text-right">
                  <div class="col-lg-12 pl-lg-1 my-2">
                    <nuxt-link to="/auth/login">{{ $t('Login') }}</nuxt-link>
                  </div>
                </div>
              </template>
              <template v-else>
                <div class="form-group">
                  <h3 style="color: #1dc9b7">{{ $t('A confirmation url has been send to your email. This link will expire after 5 minutes, please check it!') }}</h3>
                </div>
                <div class="form-group text-right">
                  <div class="col-lg-12 pl-lg-1 my-2">
                    <button type="button" class="btn btn-default" @click="reset">{{ $t('Resend') }}</button>
                  </div>
                  <div class="col-lg-12 pl-lg-1 my-2">
                    <nuxt-link to="/auth/login">{{ $t('Login') }}</nuxt-link>
                  </div>
                </div>
              </template>

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
        email: ''
      },
      showMess: false
    }
  },
  mounted() {

  },
  methods: {
    async send() {
      const res = await this.$axios.$post('user/reset-password', this.form)
      if (res) {
        this.showMess = true
      }
    },
    reset() {
      this.showMess = false
      this.form = {
        email: ''
      }
    }
  }
}
</script>

<style></style>
