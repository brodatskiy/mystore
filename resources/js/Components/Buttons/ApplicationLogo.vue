<script setup>
import {Link} from "@inertiajs/vue3";
</script>
<template>
    <Button asChild>
        <Link
            v-bind="$attrs"
            :href="route('/')" class="flex items-center text-lg space-x-1 hover:text-primary-600 dark:hover:text-primary-300 transition-all"
        >
            <i class="pi pi-shop" style="font-size: 1.25rem"></i>
            <span>MyStore</span>
        </Link>
    </Button>
</template>
