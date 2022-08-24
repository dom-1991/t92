<template>
  <span class="text-danger" v-if="messages">{{ messages[0] }}</span>
</template>
<script>
  export default {
    props: {
      messages: {type: Array}
    }
  }
</script>
