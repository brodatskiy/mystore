<script setup>
defineProps(["order"]);
</script>
<template>
    <div class="mb-6 rounded-lg bg-white p-4 shadow-md flex">
        <div class="flex justify-around w-full px-4">
            <div>
                <p class="font-bold">ID:</p>
                <p class="text-xs text-gray-700">
                    {{ order.id }}
                </p>
            </div>
            <div>
                <p class="font-bold">Status:</p>

                <p class="text-xs text-gray-700">
                    {{ order.status }}
                </p>
            </div>
            <div>
                <p class="font-bold">Total:</p>

                <p class="text-xs text-gray-700">
                    {{ order.total }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
