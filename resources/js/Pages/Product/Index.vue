<template>
    <template v-if="product">
        <div class="flex w-full border rounded-xl p-4 mx-auto max-w-5xl">
            <div class="img-container mr-10">
                <img
                    :src="product.image"
                    alt="Product Image"
                    class="object-contain img"
                />
            </div>
            <div class="flex flex-col">
                <h1 class="font-bold mb-3">{{ product.title }}</h1>
                <p class="text-md mb-3">{{ product.description }}</p>
                <star-rating
                    :increment="0.5"
                    :read-only="true"
                    :padding="0"
                    :rating="product.rating?.rate"
                    :star-size="15"
                    inactive-color="#64748B"
                    active-color="#FCC347"
                    class="mb-2"
                />

                <!-- <p class="text-2xl mb-3">{{ toCurrency(product.price) }}</p> -->
                <!-- <ButtonStd
                    class="mt-auto w-full"
                    @click.stop="cartStore.add(product)"
                >
                    Add to cart
                </ButtonStd> -->
            </div>
        </div>
    </template>
</template>
<script setup>
import { computed } from "vue";
// import { useProductStore } from "@/Store/useProductStore";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// import ButtonStd from "@/Components/UI/ButtonStd.vue";

// const productStore = useProductStore();
// const cartStore = useCartStore();

// const product = computed(() =>
//     productStore.products.find((Product) => {
//         if (product.id === +route.params.productId) {
//             return product;
//         }
//     })
// );
</script>
<style scoped>
.img-container {
    min-width: 300px;
    width: 300px;
    height: 300px;
    background: rgb(255, 255, 255);
}

.img {
    width: 300px;
    height: 300px;
}
</style>
