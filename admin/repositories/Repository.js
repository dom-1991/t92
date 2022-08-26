import UserRepository from '~/repositories/UserRepository'

export default ($axios) => ({
  user: UserRepository($axios),
})
