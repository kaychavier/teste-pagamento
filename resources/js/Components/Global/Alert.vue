<script setup>
defineProps({
  color: String,
  text: String,
  message: String,
});
</script>
<template>
  <div
    :class="`alert alert-${color || 'primary'} text-${text || 'white'}`"
    v-if="message"
  >
    {{ message }}
  </div>
</template>
