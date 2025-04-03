<script setup>
import {Link} from "@inertiajs/vue3";
</script>
<template>
    <Button asChild>
        <Link
            v-bind="$attrs"
            class="flex items-center px-2 py-2 hover:text-primary-600 dark:hover:text-primary-300 hover:bg-surface-100 dark:hover:bg-surface-600 text-surface-950 dark:text-surface-50 transition-all"
        >
            <slot/>
        </Link>
    </Button>
</template>
<style scoped></style>
