import { onUnmounted } from "vue";
import { useCartStore } from "@/Store/useCartStore";

export const CART_STORE = "CART_STORE";

export const usePersistCart = () => {
    const cartStore = useCartStore();

    const unsub = cartStore.$subscribe(() => {
        localStorage.setItem(CART_STORE, JSON.stringify(cartStore.contents));
    });

    onUnmounted(() => {
        unsub();
    });
};
