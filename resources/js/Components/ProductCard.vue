<script setup>
import { router } from "@inertiajs/vue3";
import PrimaryBtn from './Buttons/PrimaryBtn.vue';

defineProps(["product"]);

function add(product) {
    router.post(route('cart.add', { product: product }) )
}

function addToWishlist(product) {
    router.post(route('wish.add', { product: product }) )
}
</script>
<template>
    <div class="">
        <Link :href="route('product.show', product)">
            <div class="max-w-72 cursor-pointer rounded-lg bg-white p-2 shadow duration-150 hover:scale-105 hover:shadow-md">
                <div class="relative">
                    <div v-if="!product.image" class="w-full h-72 bg-gray-300 rounded" ></div>
                    <img v-else class="w-full h-72 rounded-lg object-cover object-center"  :src="product.image" :alt="product.title" >
                    <div class="absolute top-2 right-2">
                        {{ product.sticker.title.toUpperCase() }}
                    </div>
                    </img>
                </div>
                <div class="flex items-center justify-between py-2">
                    <p class=" text-l font-semibold text-gray-800">${{ product.price }}</p>
                    <p class="font-bold text-gray-500">{{ product.title }}</p>
                    <button v-if="$page.props.auth.user" @click.prevent="addToWishlist(product)">
                        <Icon v-if="product.wished" icon="mdi-heart" />
                        <Icon v-else icon="mdi-heart-outline" />
                    </button>
                </div>
                <PrimaryBtn
                    class="w-full"
                    @click.prevent="add(product)"
                >
                    Add to cart
                </PrimaryBtn>
            </div>
        </Link>
    </div>
</template>
<style scoped></style>
