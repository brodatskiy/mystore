<template>
    <div
        class="flex flex-col md:flex-row w-full mx-auto border rounded-xl p-3 mb-2"
    >
        <div class="p-3 w-1/3">
            <Link :href="route('product.show', product)">
                <img
                    :src="product.image"
                    alt="Card Image"
                    class="object-contain w-32 mx-auto"
                />
            </Link>
        </div>
        <div class="flex items-center p-8 w-2/3 space-x-5">
            <div>
                <Link :href="route('product.show', product)">
                    <h2 class="text-xl font-bold mb-3">
                        {{ product.title }}
                    </h2>
                </Link>
                <p class="mb-5">
                    {{ product.description }}
                </p>
                <p class="text-xl mb-5">
                    {{ product.price }}
                </p>
            </div>
            <div class="">
                <div class="btn-group">
                    <button
                        class="rounded-l-md bg-primary-300 hover:bg-primary-400 active:bg-primary-500 px-3 py-2"
                        @click="cartStore.remove(product)"
                    >
                        -
                    </button>
                    <button class="hover:bg-gray-100 px-3 py-2">
                        {{ product.quantity }}
                    </button>
                    <button
                        class="rounded-r-md bg-primary-300 hover:bg-primary-400 active:bg-primary-500 px-3 py-2"
                        @click="cartStore.add(product)"
                    >
                        +
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useCartStore } from "@/Store/useCartStore";

const cartStore = useCartStore();

defineProps(["product"]);
</script>

<style scoped></style>
