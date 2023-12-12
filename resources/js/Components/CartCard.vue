<template>
    <div
        class="flex flex-col md:flex-row w-full mx-auto border rounded-xl p-3 mb-2"
    >
        <div class="p-3 w-1/3">
            <Link :to="`/product/${cartProduct.product.id}`">
                <img
                    :src="cartProduct.product.image"
                    alt="Card Image"
                    class="object-contain w-32 mx-auto"
                />
            </Link>
        </div>
        <div class="p-8 w-2/3">
            <Link :to="`/product/${cartProduct.product.id}`">
                <h2 class="text-xl font-bold mb-3">
                    {{ cartProduct.product.title }}
                </h2>
            </Link>
            <p class="text-xl mb-5">
                {{ toCurrency(cartProduct.product.price) }}
            </p>
            <div class="">
                <div class="btn-group">
                    <ButtonCart
                        class="rounded-l-md bg-yellow-300 hover:bg-yellow-400 active:bg-yellow-500 px-3 py-2"
                        @click="cartStore.remove(cartProduct.product)"
                    >
                        -
                    </ButtonCart>
                    <ButtonCart class="hover:bg-gray-100 px-3 py-2">
                        {{ cartProduct.quantity }}
                    </ButtonCart>
                    <ButtonCart
                        class="rounded-r-md bg-yellow-300 hover:bg-yellow-400 active:bg-yellow-500 px-3 py-2"
                        @click="cartStore.add(cartProduct.product)"
                    >
                        +
                    </ButtonCart>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ButtonCart from "@/Components/UI/ButtonCart.vue";
import { Link } from "@inertiajs/vue3";
import { useCartStore } from "@/Store/useCartStore";
import { toCurrency } from "@/Utils/toCurrency";
const cartStore = useCartStore();

defineProps(["cartProduct"]);
</script>

<style scoped></style>
