<script setup>
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <Link :href="route('product.show', product)">
    <div class="mx-auto" max-width="400" variant="flat">
      <img height="200" :src="product.image" cover>
        <p class="text-info text-body-2 pa-2">
          {{ product.sticker.title.toUpperCase() }}
        </p>
      </img>
      <div class="d-flex items-center justify-space-between pa-2">
        <div>{{ product.price }} $</div>
        <div>{{ product.title }}</div>
        <div class="">
          <Icon icon="mdi-heart" />
        </div>
      </div>
    </div>
  </Link>
</template>
<style scoped></style>
