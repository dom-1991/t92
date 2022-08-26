<template></template>

<script>
export default {
  layout: 'auth',
  mounted() {
    this.$store.dispatch('user/socialGetToken')
  },
}
</script>
