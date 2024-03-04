<script setup>
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <Link :href="route('product.show', product)">
    <v-card class="mx-auto" max-width="400" variant="flat">
      <v-img height="200" :src="product.image" cover>
        <p class="text-info text-body-2 pa-2">
          {{ product.sticker.title.toUpperCase() }}
        </p>
      </v-img>
      <div class="d-flex items-center justify-space-between pa-2">
        <div>{{ product.price }} $</div>
        <div>{{ product.title }}</div>
        <div class="">
          <v-icon icon="mdi-heart" />
        </div>
      </div>
    </v-card>
  </Link>
</template>
<style scoped></style>
