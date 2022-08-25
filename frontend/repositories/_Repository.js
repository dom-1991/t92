import UserRepository from '~/repositories/UserRepository'
import AuthRepository from '~/repositories/AuthRepository'

export default ($axios) => ({
  user: UserRepository($axios),
  auth: AuthRepository($axios),
})
