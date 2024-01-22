<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <v-hover v-slot="{ isHovering, props }">
    <v-card class="product" variant="text" v-bind="props">
      <div>
        <v-img
          :src="product.image"
          alt="Card Image"
          width="300"
          cover
          aspect-ratio="1.4"
        />
      </div>
      <div class="d-flex justify-space-between">
        <div>{{ product.price }}</div>
        <div>{{ product.title }}</div>
        <div>
          <v-icon icon="mdi-heart-outline" size="small" />
          <!-- <v-icon icon="mdi-heart" size="small" /> -->
        </div>
      </div>
      <div class="product__bottom">Размеры и цвета</div>
    </v-card>
  </v-hover>
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
<style scoped>
.product:hover .product__bottom {
  opacity: 1;
}
.product__bottom {
  position: relative;
  opacity: 0;
}
.text-none {
}

.vue-star-rating-rating-text {
  margin-top: 5px;
}
</style>
