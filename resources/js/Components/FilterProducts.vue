
<script setup>
import { useProductStore } from "@/Store/useProductStore";

const productStore = useProductStore();
</script>
<template>
    <div class="filter mb-3 flex">
        <select
            v-model="productStore.categoryFilter"
            class="border-2 rounded-xl p-1 mr-2"
        >
            <option disabled value="">Please select one</option>
            <option>All</option>
            <option>men's clothing</option>
            <option>women's clothing</option>
            <option>jewelery</option>
            <option>electronics</option>
        </select>

        <select
            v-model="productStore.sortFilter"
            class="border-2 rounded-xl p-1"
        >
            <option>Featured</option>
            <option>Price: High-Low</option>
            <option>Price: Low-High</option>
        </select>
    </div>
</template>
<style></style>
