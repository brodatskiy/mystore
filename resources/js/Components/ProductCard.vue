<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <div class="d-flex flex-column w-25 border rounded-xl pa-3">
    <div class="mb-3">
      <img
        :src="product.image"
        alt="Card Image"
        class="object-contain h-32 w-100"
      />
    </div>
    <div>
      <p class="text-lg">
        {{ product.title }}
      </p>

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
      <p class="text-2xl mb-5">{{ product.price }}</p>
      <!-- <ButtonStd class="w-full" @click.stop="cartStore.add(product)">
                Add to cart
            </ButtonStd> -->
    </div>
  </div>
</template>
<style>
.vue-star-rating-rating-text {
  margin-top: 5px;
}
</style>
