<script setup>
import ShopLayout from "@/Layouts/ShopLayout.vue";

import CartCard from "@/Components/CartCard.vue";
import ProductCard from "@/Components/ProductCard.vue";

// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

const props = defineProps({
    products: Object,
    total: String,
});
</script>
<template>
    <Head title="Cart" />
    <ShopLayout>
        <div class="p-4 max-w-7xl mx-auto flex flex-col">
            <template v-for="product in products" :key="product.id">
                <CartCard :product="product" />
            </template>
            <div class="text-center text-lg">
                <span class="font-bold">Total:</span>
                {{ total }}
            </div>
        </div>
    </ShopLayout>
</template>

<style scoped></style>
