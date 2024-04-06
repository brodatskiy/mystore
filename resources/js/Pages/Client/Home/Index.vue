<script setup>
import { computed } from "vue";
import ShopLayout from "@/Layouts/ShopLayout.vue";

import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps(["products"]);
</script>
<template>
    <Head title="Home" />

    <ShopLayout>
        <div
            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4"
        >
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
    </ShopLayout>
</template>
