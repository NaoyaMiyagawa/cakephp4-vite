<script setup lang="ts">
import { ref } from "vue";

const count = ref(0);
</script>

<template>
  <div class="p-4">
    <button @click="count++" class="el_button">Add: {{ count }}</button>
  </div>
</template>

<style lang="scss" scoped>
.el_button {
  @apply p-2 px-6 text-white bg-blue-500 rounded-full;
  // @apply p-4 px-8 text-white bg-green-500 rounded-full;
}
</style>
