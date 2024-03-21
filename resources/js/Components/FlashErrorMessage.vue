<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const flashMessage = ref(usePage().props.flash.message);

onMounted(() => {
  setTimeout(() => {
    usePage().props.flash.message = "";
  }, 3222000);
});
</script>

<template>
  <v-snackbar
    v-model="flashMessage"
    position="absolute"
    offset=" 100"
    timeout="4222000"
  >
    {{ flashMessage }}
  </v-snackbar>
</template>

<style></style>
