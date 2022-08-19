import createRepository from '~/repositories/_Repository'

export default (ctx, inject) => {
  inject('repositories', createRepository(ctx.$axios))
}
