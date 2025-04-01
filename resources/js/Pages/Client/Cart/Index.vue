<script setup>
import ShopLayout from "@/Layouts/ShopLayout.vue";
import CartProductCard from "@/Components/ProductCardCart.vue";
import { useCartStore } from "@/Store/useCartStore";
import { router, Head } from "@inertiajs/vue3";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

const cartStore = useCartStore();

const props = defineProps({
    products: Object,
    total: Number,
});

// cartStore.products = props.products;
function order() {
    router.post(route("cart.order"));
}
</script>
<template>
    <Head title="Cart" />
    <ShopLayout>
        <template #header>
            {{ $t("Cart") }}
        </template>

        <div
            class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
        >
            <div class="md:w-2/3">
                <CartProductCard
                    v-for="product in props.products"
                    :key="product.id"
                    :product="product"
                ></CartProductCard>
            </div>
            <!-- Sub total -->
            <div
                class="h-full rounded-lg bg-surface-50 dark:bg-surface-600 p-6 shadow-md md:mt-0 md:w-1/3"
            >
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="">
                        <p class="ml-1 text-lg font-bold">${{ props.total }}</p>
                    </div>
                </div>
                <ButtonPrimary
                    class="mt-6 w-full"
                    @click="order()"
                >
                    {{ $t("Order") }}
                </ButtonPrimary>
            </div>
        </div>
    </ShopLayout>
</template>

<style scoped></style>
