<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
    },
});
</script>
<template>
    <Link :href="href">
        <v-btn flat color="error" class="rounded-xl"><slot /></v-btn>
    </Link>
</template>
