<script setup>
import { computed } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { Head, Link } from "@inertiajs/vue3";
// import { useProductStore } from "@/Store/useProductStore";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const productStore = useProductStore();
// const cartStore = useCartStore();

const props = defineProps(["product"]);
</script>
<template>
  <Head title="Product" />

  <MainLayout>
    <v-sheet color="transparent" class="pa-4">
      <div class="d-flex">
        <div class="product__image-block w-75">
          <v-img
            :src="product.image"
            alt="Product Image"
            cover
            min-width="300"
            aspect-ratio="1.4"
          />
          <div class="product_sticker px-1">
            {{ product.sticker.title.toUpperCase() }}
          </div>
        </div>
        <div class="ml-4 w-50">
          <p class="text-h2 mb-2">{{ product.title }}</p>
          <p class="text-h5 mb-2">{{ product.price }}</p>
          <!-- <p class="text-h5 mb-2">{{ product.product_group }}</p> -->
          <div class="mb-2">
            <v-slide-group show-arrows selected-class="border">
              <v-slide-group-item
                v-for="subProduct in product.product_group"
                :key="subProduct.id"
                v-slot="{ toggle, selectedClass }"
              >
                <div class="ma-2">
                  <v-card :class="[selectedClass]">
                    <v-img
                      :src="subProduct.image"
                      alt="Card Image"
                      width="70"
                      cover
                      aspect-ratio="1.4"
                      @click="toggle"
                    />
                  </v-card>
                </div>
              </v-slide-group-item>
            </v-slide-group>
          </div>
          <div class="d-flex mb-2">
            <div v-for="size in product.sizes">
              <div v-if="size.count > 0" class="mr-2">
                <v-btn>
                  {{ size.title }}
                </v-btn>
              </div>
            </div>
          </div>

          <p class="text-md mb-2">{{ product.description }}</p>

          <PrimaryButton class="w-100" @click.stop="cartStore.add(product)">
            Add to cart
          </PrimaryButton>
        </div>
      </div>
      <div class="mt-4">
        <v-chip v-for="tag in product.tags" class="mr-2">{{
          tag.title
        }}</v-chip>
      </div>
    </v-sheet>
  </MainLayout>
</template>
<style scoped>
.border {
  border: 1px solid black !important;
}
.product__image-block {
  position: relative;
  width: 100%;
  height: auto;
}

.product_sticker {
  position: absolute;
  top: 0;
  right: 0;
  font-size: 12px;
  color: rgb(236, 57, 57);
  background: #ffffffd7;
}
</style>
