<template lang="html">
  <div class="loading-page" v-if="loading">
    <div class="spinner-border text-primary"></div>
  </div>
</template>

<script>
export default {
  data: () => ({
    loading: false
  }),
  methods: {
    start() {
      this.loading = true
    },
    finish() {
      this.loading = false
    },
    fail(error) {
      this.loading = false
    }
  }
}
</script>

<style scoped>
.loading-page {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  font-family: sans-serif;
  display: flex;
  z-index: 9999;
  justify-content: center;
  align-items: center;
}
</style>
