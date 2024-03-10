<script setup>
const props = defineProps({
  links: Array,
  meta: Object,
});
</script>

<template>
  <div class="flex items-center justify-center mt-10">
    <span v-for="(link, i) in links" :key="i">
      <Link
        v-if="link.url"
        :href="link.url"
        v-html="link.label"
        class="px-4 py-3 text-xs rounded mr-2 select-none text-center align-middle font-sans font-medium text-gray-900 transition-all"
        :class="
          link.active
            ? 'bg-gray-900/20 text-black hover:bg-gray-900/30'
            : 'bg-gray-200 text-zinc-600 hover:bg-gray-900/10'
        "
        as="button"
        :disabled="link.active"
      ></Link>
    </span>
  </div>
</template>
