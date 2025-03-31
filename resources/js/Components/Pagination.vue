<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
    meta: Object,
});

console.log(props);
</script>

<template>
    <div class="flex items-center justify-center">
    <span v-for="(link, i) in links" :key="i">
      <Link
          v-if="link.url"
          :href="link.url"
          v-html="link.label"
          class="px-4 py-3 cursor-pointer text-sm rounded-md mr-2 select-none text-center align-middle transition-all"
          :class="
          link.active
            ? 'bg-primary-600 dark:bg-primary-300 text-white dark:text-black!'
            : 'bg-surface-300 dark:bg-surface-600 dark:text-white hover:bg-surface-400 dark:hover:bg-surface-500'
        "
          as="button"
          :disabled="link.active"
      ></Link>
    </span>
    </div>
</template>
