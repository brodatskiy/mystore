<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  navLinks: {
    type: Object,
  },
});
</script>
<template>
  <v-list :lines="false">
    <template v-for="(item, i) in navLinks" :key="i" :value="item">
      <Link :href="route(item.href)">
        <v-list-item
          :active="route().current(item.href)"
          color="primary"
          :title="item.title"
          :prepend-icon="item.icon"
        >
        </v-list-item>
      </Link>
    </template>
  </v-list>
</template>
