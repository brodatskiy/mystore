<script setup>
import {Head, Link} from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";

const props = defineProps({
    order: Object,
});
</script>
<template>
    <Head title="Order"/>
    <ShopLayout>
        <template #header>
            {{ $t("Order") }} #{{order.id}}
        </template>

        <div
            class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
        >
            <div class="w-full">
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
            </div>
        </div>
    </ShopLayout>
</template>

<style scoped></style>
