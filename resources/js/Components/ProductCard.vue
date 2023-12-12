<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
    <div class="flex flex-col w-full border rounded-xl p-3 justify-between">
        <div class="mb-3">
            <img
                :src="product.image"
                alt="Card Image"
                class="object-contain w-full h-64 mb-5"
            />
        </div>
        <div>
            <p class="transition hover:text-red-600 text-lg">
                {{ product.title }}
            </p>

            <!-- <star-rating
                :increment="0.5"
                :read-only="true"
                :padding="0"
                :rating="product?.rating?.rate"
                :star-size="15"
                inactive-color="#64748B"
                active-color="#FCC347"
                class="mb-2"
            /> -->

            <!-- <p class="text-2xl mb-5">{{ toCurrency(product.price) }}</p> -->
            <p class="text-2xl mb-5">{{ product.price }}</p>
            <!-- <ButtonStd class="w-full" @click.stop="cartStore.add(product)">
                Add to cart
            </ButtonStd> -->
        </div>
    </div>
</template>
<style>
.vue-star-rating-rating-text {
    margin-top: 5px;
}
</style>
