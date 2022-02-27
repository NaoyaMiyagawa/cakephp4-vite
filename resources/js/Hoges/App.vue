<script setup lang="ts">
import { ref } from "vue";

const count = ref(0);
</script>

<template>
  <div class="p-4">
    <button @click="count++" class="button">Add: {{ count }}</button>
  </div>
</template>

<style lang="scss" scoped>
.button {
  @apply p-2 px-6 bg-blue-500 rounded-full;
}
</style>
