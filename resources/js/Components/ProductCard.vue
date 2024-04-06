<script setup>
// import { useCartStore } from "@/Store/useCartStore";
// const cartStore = useCartStore();

defineProps(["product"]);
</script>
<template>
  <Link :href="route('product.show', product)">
    <div class="w-58"  >
        <div class="relative">
            <img class=" w-full h-auto object-cover" width="300" height="300" :src="product.image" >
            <div class="absolute top-2 right-2">
              {{ product.sticker.title.toUpperCase() }}
            </div>
          </img>
        </div>

      <div class="flex items-center justify-between pa-2">
        <div>{{ product.price }} $</div>
        <div>{{ product.title }}</div>
        <div class="">
          <Icon icon="mdi-heart-outline" />
        </div>
      </div>
    </div>
  </Link>
</template>
<style scoped></style>
