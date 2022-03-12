<script setup lang="ts">
import { ref } from "vue";

const count = ref(0);
</script>

<template>
  <div class="el_btn" @click="count++">Count: {{ count }}</div>
</template>

<style lang="scss" scoped>
.el_btn {
  @apply m-4;
}
</style>
