<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <v-hover v-slot="{ isHovering, props }">
    <v-card min-width="200" class="product" variant="text" v-bind="props">
      <div>
        <v-img :src="product.image" alt="Card Image" cover aspect-ratio="1.4" />
      </div>
      <div class="d-flex justify-space-between">
        <div>{{ product.price }} $</div>
        <div>{{ product.title }}</div>
        <div>
          <v-icon icon="mdi-heart-outline" size="small" />
          <!-- <v-icon icon="mdi-heart" size="small" /> -->
        </div>
      </div>
    </v-card>
  </v-hover>
</template>
<style scoped>
.product:hover .product__bottom {
  opacity: 1;
}
.product__bottom {
  position: relative;
  opacity: 0;
}
</style>
