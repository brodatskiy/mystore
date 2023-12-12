<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
    },
});
</script>
<template>
    <Link :href="href" as="button">
        <v-btn flat color="primary rounded-xl"><slot /></v-btn>
    </Link>
</template>
