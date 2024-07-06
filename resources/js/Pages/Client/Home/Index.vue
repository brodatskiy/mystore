<script setup>
import { ref } from "vue";
import { Head } from '@inertiajs/vue3'
import { usePage } from "@inertiajs/vue3";

import ShopLayout from "@/Layouts/ShopLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";
import ProductPriceFilter from "@/Components/Filters/ProductPriceFilter.vue";
import ProductSearch from "@/Components/Filters/ProductSearch.vue";
import SortProducts from "@/Components/Filters/SortProducts.vue";

import Drawer from 'primevue/drawer';

import { useFilterStore } from "@/Store/useFilterStore";

const filterStore = useFilterStore();

const currentLocation = usePage().props.ziggy.location;

const props = defineProps({
    products: Object,
    categories: Array,
    tags: Array,
    search: String,
    price: Object,
    sort: String,
});

filterStore.setStore(props);

const filters = ref({
    search: filterStore.search,
    price: filterStore.price,
    sort: filterStore.sort,
});

function applyFilters() {
    filterStore.applyFilters(currentLocation);
}

const filterExpand = ref(false);
</script>
<template>
    <Head title="Home" />

    <ShopLayout>
        <div class="flex justify-end">
            <div class="flex space-x-8">
                <button
                    @click="filterExpand = true"
                    class="flex items-center hover:text-primary-600"
                >
                    <Icon
                        icon="mdi:filter-variant"
                        width="1.5rem"
                        height="1.5rem"
                    />
                    <span>Filters</span>
                </button>
                <SortProducts
                    :sort="props.sort"
                    @change="applyFilters"
                ></SortProducts>
            </div>
        </div>

        <div class="flex flex-col">
            <div
                class="mx-auto grid max-w-6xl grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4"
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
        </div>

        <div>
            <Drawer
                v-model:visible="filterExpand"
                header="Filters"
                position="right"
                :modal="false"
                class="!w-[20rem]"
            >
                <div class="space-y-8 py-4">
                    <div>
                        <ProductSearch></ProductSearch>
                    </div>

                    <div>
                        <ProductPriceFilter></ProductPriceFilter>
                    </div>

                    <div class="flex justify-center">
                        <Button @click="applyFilters" class="w-full">
                            Apply</Button
                        >
                    </div>
                </div>
            </Drawer>
        </div>
    </ShopLayout>
</template>
applyFilters
