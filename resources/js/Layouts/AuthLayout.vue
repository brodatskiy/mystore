<script setup>
import ApplicationLogo from "@/Components/Buttons/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-surface-50 dark:bg-surface-700"
    >
        <div>
            <Link href="/">
                <ApplicationLogo/>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-surface-200 dark:bg-surface-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot/>
        </div>
    </div>
</template>

<style></style>
