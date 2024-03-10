<script setup>
import ShopLayout from "@/Layouts/ShopLayout.vue";
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
// import { useCartStore } from "@/Store/useCartStore";
// import CartCard from "@/Components/CartCard.vue";
// import { toCurrency } from "@/Utils/toCurrency";

// const cartStore = useCartStore();
</script>
<template>
  <Head title="Cart" />
  <ShopLayout>
    <div class="p-4 max-w-7xl mx-auto flex flex-col">
      <!-- <template v-for="item in cartStore.contents" :key="item.product.id">
            <CartCard :cartProduct="item" />
        </template> -->
      <div class="text-center text-lg">
        <span class="font-bold">Total:</span>
        <!-- {{ toCurrency(cartStore.total) }} -->
      </div>
    </div>
  </ShopLayout>
</template>

<style scoped></style>
