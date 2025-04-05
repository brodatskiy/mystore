<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
    meta: Object,
});
</script>

<template>
    <div class="flex items-center justify-center">
    <span v-for="(link, i) in links" :key="i">
      <Link
          v-if="link.url"
          :class="
          link.active
            ? 'bg-primary-500 text-white'
            : 'bg-surface-300 dark:bg-surface-600 dark:text-white hover:bg-surface-400 dark:hover:bg-surface-500'
        "
          :disabled="link.active"
          :href="link.url"
          as="button"
          preserve-scroll
          class="px-4 py-3 cursor-pointer text-sm rounded-md mr-2 select-none text-center align-middle transition-all"
          v-html="link.label"
      />
    </span>
    </div>
</template>
