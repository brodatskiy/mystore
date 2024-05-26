import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { CART_STORE } from "@/Utils/usePersistCart";

export const useCartStore = defineStore("Cart", () => {
    const products = ref(JSON.parse(localStorage.getItem(CART_STORE)) ?? []);

    // const total = computed(() => {
    //     return products.value.reduce((acc, product) => {
    //         return acc + product.price * product.quantity;
    //     }, 0);
    // });

    return { products };
});
