<script setup>
import ShopLayout from "@/Layouts/ShopLayout.vue";
import CartCard from "@/Components/CartCard.vue";
import { useCartStore } from "@/Store/useCartStore";
import { router } from "@inertiajs/vue3";

const cartStore = useCartStore();

const props = defineProps({
    products: Object,
    total: String,
});

// cartStore.products = props.products;
function order() {
    router.post(route("cart.order"));
}
</script>
<template>
    <Head title="Cart" />
    <ShopLayout>
        <h1 class="mb-6 text-center text-2xl font-bold">Cart Items</h1>
        <div
            class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
        >
            <div class="md:w-2/3">
                <CartCard
                    v-for="product in props.products"
                    :key="product.id"
                    :product="product"
                ></CartCard>
            </div>
            <!-- Sub total -->
            <div
                class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3"
            >
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="">
                        <p class="ml-1 text-lg font-bold">${{ props.total }}</p>
                    </div>
                </div>
                <button
                    class="mt-6 w-full rounded-md bg-primary-500 py-1.5 font-medium text-primary-50 hover:bg-primary-600"
                    @click="order()"
                >
                    Order
                </button>
            </div>
        </div>
    </ShopLayout>
</template>

<style scoped></style>
