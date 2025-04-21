<script setup>
import {ref} from "vue";
import {router} from "@inertiajs/vue3";

import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

defineProps(["order"]);

const processing = ref(false);

function destroy(order) {
    router.delete(route("orders.destroy", {order: order}), {
        preserveScroll: true,
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });

    router.reload({only: ['order']})
}

function pay(order) {
    router.post(route('orders.pay', {order: order}), {}, {
        preserveScroll: true,
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });

    router.reload({only: ['order']})
}

function show(order) {
    router.get(route('orders.show', {order: order}), {}, {
        preserveScroll: true,
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });
}
</script>
<template>
    <div class="mb-4 rounded-lg bg-surface-300 dark:bg-surface-600 p-4 shadow-md flex items-center">
        <div class="flex justify-between w-3/4 px-4">
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

        <div class="flex justify-end w-1/4 space-x-4">
            <div>
                <ButtonPrimary
                    :class="{ 'opacity-50': processing }"
                    :disabled="processing"
                    @click="show(order) ">Show
                </ButtonPrimary>
            </div>
            <div v-show="order.status === 'Unpaid'" class="flex space-x-4">
                <ButtonPrimary
                    :class="{ 'opacity-50': processing }"
                    :disabled="processing"
                    @click="pay(order) ">Pay
                </ButtonPrimary>
                <Button
                    :class="{ 'opacity-50': processing }"
                    :disabled="processing"
                    @click="destroy(order)" severity="danger">Delete
                </Button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
