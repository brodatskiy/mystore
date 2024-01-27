<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
  <Link :href="route('/')" class="d-flex align-baseline">
    <v-icon icon="mdi-store" size="x-large" class=""></v-icon>
    <p class="font-weight-bold text-h4">MyStore</p>
  </Link>
</template>
