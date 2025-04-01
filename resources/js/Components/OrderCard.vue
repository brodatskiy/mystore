<script setup>
defineProps(["order"]);
</script>
<template>
    <div class="mb-4 rounded-lg bg-surface-300 dark:bg-surface-600 p-4 shadow-md flex">
        <div class="flex justify-between align-items-center w-full px-4">
            <div class="flex">
                <p class="font-bold">ID:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ order.id }}
                </span>
            </div>
            <div class="flex">
                <p class="font-bold">Status:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ order.status }}
                </span>
            </div>
            <div class="flex">
                <p class="font-bold">Total:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ order.total }}
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
