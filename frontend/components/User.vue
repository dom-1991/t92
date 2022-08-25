<template>
  <div class="col-4">
    <b-card :title="user.title">
      <b-card-text>{{ user.body }}</b-card-text>
      <nuxt-link
        :to="{
          name: 'post-id',
          params: { id: user.id }
        }"
        class="card-link"
        >Read more</nuxt-link
      >
    </b-card>
  </div>
</template>

<script>
export default {
  props: { user: { type: [Array, Object] } }
}
</script>
