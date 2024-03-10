<script setup>
import { computed } from "vue";
import { useDisplay } from "vuetify";

import ShopLayout from "@/Layouts/ShopLayout.vue";

import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps(["products"]);
const { name } = useDisplay();

const cols = computed(() => {
  switch (name.value) {
    case "md":
      return 4;
    case "lg":
      return 3;
    default:
      return 6;
  }

  return undefined;
});
</script>
<template>
  <Head title="Home" />

  <ShopLayout>
    <div>
      {{ console.log(products) }}
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <ProductCard
          v-for="product in products.data"
          :key="product.id"
          :product="product"
        ></ProductCard>
      </div>

      <Pagination
        v-if="products.links.next || products.links.prev"
        :links="products.meta.links"
        :meta="products.links"
      ></Pagination>
    </div>
  </ShopLayout>
</template>
