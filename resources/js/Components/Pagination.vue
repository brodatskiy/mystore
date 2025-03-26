<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
    meta: Object,
});

console.log(props);
</script>

<template>
    <div class="flex items-center justify-center mt-10">
    <span v-for="(link, i) in links" :key="i">
      <Link
          v-if="link.url"
          :href="link.url"
          v-html="link.label"
          class="px-4 py-3 text-sm rounded-md mr-2 select-none text-center align-middle transition-all"
          :class="
          link.active
            ? 'dark:bg-primary-300 dark:text-black dark:hover:bg-primary-400'
            : 'bg-surface-100 text-zinc-600 hover:bg-surface-900/10'
        "
          as="button"
          :disabled="link.active"
      ></Link>
    </span>
    </div>
</template>
