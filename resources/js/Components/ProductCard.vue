<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <v-card class="pa-3" hover rounded="xl" max-width="300">
    <div>
      <v-img
        :src="product.image"
        alt="Card Image"
        width="250"
        cover
        aspect-ratio="1.4"
      />
    </div>
    <v-card-item>
      <v-card-title> {{ product.title }} </v-card-title>
      <v-card-subtitle>{{ product.price }} $</v-card-subtitle>
    </v-card-item>
    <v-card-actions>
      <v-spacer></v-spacer>

      <v-btn
        size="small"
        color="surface-variant"
        variant="text"
        icon="mdi-heart"
      ></v-btn>

      <v-btn
        size="small"
        color="surface-variant"
        variant="text"
        icon="mdi-bookmark"
      ></v-btn>

      <v-btn
        size="small"
        color="surface-variant"
        variant="text"
        icon="mdi-share-variant"
      ></v-btn>
    </v-card-actions>
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
