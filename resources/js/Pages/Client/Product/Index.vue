<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";
import PrimaryBtn from "@/Components/Buttons/PrimaryBtn.vue";

import { useCartStore } from "@/Store/useCartStore";

const props = defineProps(["product"]);

function add(product) {
    router.post(route('cart.add', { product: product }) )
}
</script>
<template>
    <Head title="Product" />

    <ShopLayout>
        <div class="flex items-center justify-center bg-gray-100">
            <div class="mx-auto">
            <div class="grid grid-cols-2 gap-4 rounded-lg bg-white p-4">

                <div class="relative">
                    <img
                        class="w-full rounded-lg object-cover object-center"
                        :src="product.image"
                        :alt="product.title"
                    >
                        <div v-if="product.sticker" class="absolute top-2 right-2">{{product.sticker.title.toUpperCase()}}</div>
                    </img>
                </div>

                <div class="flex flex-col">
                    <div class="space-y-4">
                    <p class="text-2xl font-bold ">{{ product.title }}</p>
                    <p class=" text-xl font-semibold text-gray-800">${{ product.price }}</p>
                    <div class="mb-2">
                        {{ product.description }}
                    </div>
                </div>
                    <PrimaryBtn
                        class="mt-auto"
                        @click="add(product)"
                    >
                        Add to cart
                    </PrimaryBtn>
                </div>
            </div>
            <div class="mt-4">
                <Chip v-for="tag in product.tags" class="mr-2">{{
                    tag.title
                }}</Chip>
            </div>
        </div>
        </div>
    </ShopLayout>
</template>
<style scoped></style>
