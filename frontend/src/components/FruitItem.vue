<script setup lang="ts">
defineProps<{
  isFavorite?: boolean,
  isFavoriteClick?: (payload: MouseEvent) => void,
}>()
</script>

<template>
  <div class="item">
    <slot name="family"></slot>
    <div class="header">
      <h3 class="header__name">
        <slot name="name"></slot>
      </h3>
      <button @click="isFavoriteClick">
        <span v-if="!isFavorite">Add to Favorite</span>
        <span v-else>Remove from Favorite</span>
      </button>
    </div>
    <hr>
    <slot></slot>
  </div>
</template>

<style scoped>
.header {
  display: flex;
}

.header__name {
  flex: 1 1 100%;
}

.item {
  margin: 1rem;
  display: flex;
  flex-direction: column;
}

h3 {
  font-size: 1.2rem;
  font-weight: 500;
  margin-bottom: 0.4rem;
  color: var(--color-heading);
}
</style>
