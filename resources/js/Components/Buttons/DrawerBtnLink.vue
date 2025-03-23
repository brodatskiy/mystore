<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>

    <Link
        v-bind="$attrs"
        class="flex w-full items-center cursor-pointer p-2 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-50 dark:hover:bg-surface-700 duration-150 transition-colors"
        as="button"
    >
        <slot/>
    </Link>

</template>

<style scoped>

</style>
