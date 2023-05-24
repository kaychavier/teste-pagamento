<script setup>
defineProps({
  color: String,
});
</script>
<template>
  <div
    :class="`spinner-border spinner-border-sm text-${color || 'light'}`"
  ></div>
</template>
