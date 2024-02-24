<script setup>
import { Link } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <Link :href="route('product.show', product)">
    <v-hover v-slot="{ isHovering, props }">
      <v-card class="product" variant="text" v-bind="props">
        <div class="product__image-block">
          <v-img
            :src="product.image"
            alt="Card Image"
            cover
            aspect-ratio="1.4"
          />
          <div class="product_sticker px-1">
            {{ product.sticker.title.toUpperCase() }}
          </div>
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
  </Link>
</template>
<style scoped>
.product:hover .product__bottom {
  opacity: 1;
}
.product__bottom {
  position: relative;
  opacity: 0;
}
.product__image-block {
  position: relative;
  width: 100%;
  height: auto;
}
.product_sticker {
  position: absolute;
  bottom: 0;
  font-size: 12px;
  color: rgb(236, 57, 57);
  background: #ffffffd7;
}
</style>
