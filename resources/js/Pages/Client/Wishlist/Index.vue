<script setup>
import ShopLayout from "@/Layouts/ShopLayout.vue";
import { useCartStore } from "@/Store/useCartStore";
import ProductCard from "@/Components/ProductCard.vue";

const cartStore = useCartStore();

const props = defineProps({
    wishlist: Array,
});

// cartStore.products = props.products;
</script>
<template>
    <Head title="Wishlist" />
    <ShopLayout>
        <h1 class="mb-6 text-center text-2xl font-bold">Wishlist</h1>
        <div
            class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
        >
            <div class="w-full">
                <ProductCard
                    v-for="product in props.wishlist"
                    :key="product.id"
                    :product="product"
                ></ProductCard>
            </div>
        </div>
    </ShopLayout>
</template>

<style scoped></style>
