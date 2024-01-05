<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <v-card width="300">
    <img
      :src="product.image"
      alt="Card Image"
      class="object-contain h-32 w-100"
    />
    <p class="text-lg">
      {{ product.title }}
    </p>
    <p class="text-2xl mb-5">{{ product.price }} $</p>
  </v-card>

  <!-- <star-rating
                :increment="0.5"
                :read-only="true"
                :padding="0"
                :rating="product?.rating?.rate"
                :star-size="15"
                inactive-color="#64748B"
                active-color="#FCC347"
                class="mb-2"
            /> -->

  <!-- <p class="text-2xl mb-5">{{ toCurrency(product.price) }}</p> -->

  <!-- <ButtonStd class="w-full" @click.stop="cartStore.add(product)">
                Add to cart
            </ButtonStd> -->
</template>
<style>
.vue-star-rating-rating-text {
  margin-top: 5px;
}
</style>
