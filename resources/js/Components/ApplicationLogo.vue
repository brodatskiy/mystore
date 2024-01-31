<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["center"]);

const classes = computed(() =>
  props.center
    ? "d-flex align-baseline justify-center"
    : "d-flex align-baseline"
);
</script>
<template>
  <Link :href="route('/')" :class="classes">
    <v-icon icon="mdi-store" size="x-large" class=""></v-icon>
    <p class="font-weight-bold text-h4">MyStore</p>
  </Link>
</template>
