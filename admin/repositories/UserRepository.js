const resource = '/auth'
export default ($axios) => ({
  socialGetToken(payload) {
    return $axios.post(`${resource}/${payload.provider}/user-from-token`, {token: payload.token})
  },

  forgotPassword(payload) {
    return $axios.post(`${resource}/forgot-password`, payload)
  },

  resetPassword(payload) {
    return $axios.post(`${resource}/change-pass-from-email-link`, payload)
  },

  checkTokenResetPassword(payload) {
    return $axios.post(`${resource}/check-token-valid`, payload)
  },
})
