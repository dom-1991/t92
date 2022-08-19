const resource = '/api/auth'
export default ($axios) => ({
  logout(token) {
    $axios.setHeader('Authorization', token)
    return $axios.post(`${resource}/logout`)
  },
})
