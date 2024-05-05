<script setup>
defineProps(["product"]);
</script>
<template>
  <Link :href="route('product.show', product)">
    <div class="flex items-center justify-center bg-gray-100">
        <div class="mx-auto">
          <div class="max-w-xs cursor-pointer rounded-lg bg-white p-2 shadow duration-150 hover:scale-105 hover:shadow-md">
            <div class="relative">
            <img class="w-full rounded-lg object-cover object-center" :src="product.image" :alt="product.title" >
            <div class="absolute top-2 right-2">
                {{ product.sticker.title.toUpperCase() }}
              </div>
            </img>
            </div>
            <div class="flex items-center justify-between py-2">
                <p class=" text-l font-semibold text-gray-800">${{ product.price }}</p>
                <p class="font-bold text-gray-500">{{ product.title }}</p>
                <p ><Icon icon="mdi-heart-outline" /></p>
            </div>
          </div>
        </div>
      </div>
  </Link>
</template>
<style scoped></style>
