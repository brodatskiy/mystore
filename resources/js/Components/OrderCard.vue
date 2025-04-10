<script setup>
import {ref} from "vue";
import {Link, router} from "@inertiajs/vue3";

import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

defineProps(["order"]);

const processing = ref(false);

function destroy(order) {
    router.delete(route("order.destroy", {order: order}), {
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
    router.post(route('order.pay', {order: order}), {}, {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });

    router.reload({only: ['order']})
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
        <div v-show="order.status === 'Unpaid'" class="flex justify-end w-1/4">
            <ButtonPrimary
                :class="{ 'opacity-50': processing }"
                :disabled="processing"
                @click="pay(order) ">Pay
            </ButtonPrimary>
            <Button
                :class="{ 'opacity-50': processing }"
                :disabled="processing"
                @click="destroy(order)" severity="danger" class="ml-4">Delete
            </Button>
        </div>
    </div>

    <div class="mb-4 rounded-lg bg-surface-300 dark:bg-surface-600 p-4 shadow-md flex">
        <Link v-for="product in order.products" :key="product.id" :href="route('product.show', product.id)"
              class="p-2 rounded-lg hover:bg-surface-500/20">
            <div class="flex">
                <p class="font-bold">ID:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ product.id }}
                </span>
            </div>
            <div class="flex">
                <p class="font-bold">Title:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ product.title }}
                </span>
            </div>
            <div class="flex">
                <p class="font-bold">Price:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ product.price }}
                </span>
            </div>
            <div class="flex">
                <p class="font-bold">Quantity:</p>
                <span class="ml-2 text-gray-600 dark:text-gray-300">
                    {{ product.quantity }}
                </span>
            </div>
        </Link>

    </div>
</template>

<style scoped></style>
