import { defineStore } from "pinia";
import { CART_STORE } from "@/Utils/usePersistCart";

import type { Product } from "@/Store/useProductStore";

export interface CartProduct {
    product: Product;
    quantity: number;
}

interface CartState {
    contents: Record<string, CartProduct>;
}

export const useCartStore = defineStore("CartStore", {
    state: (): CartState => {
        return {
            contents:
                JSON.parse(localStorage.getItem(CART_STORE) as string) ?? {},
        };
    },

    getters: {
        count(): number {
            return Object.keys(this.contents).reduce((acc, id) => {
                return acc + this.contents[id].quantity;
            }, 0);
        },

        total(): number {
            return Object.keys(this.contents).reduce((acc, id) => {
                return (
                    acc +
                    this.contents[id].product.price * this.contents[id].quantity
                );
            }, 0);
        },
    },
    actions: {
        add(product: Product) {
            if (this.contents[product.id]) {
                this.contents[product.id].quantity += 1;
            } else {
                this.contents[product.id] = {
                    product,
                    quantity: 1,
                };
            }
        },
        remove(product: Product) {
            if (!this.contents[product.id]) {
                return;
            }

            this.contents[product.id].quantity -= 1;

            if (this.contents[product.id].quantity === 0) {
                delete this.contents[product.id];
            }
        },
    },
});
