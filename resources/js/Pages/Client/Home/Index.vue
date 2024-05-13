<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";

import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";
import ProductPriceFilter from "@/Components/Filters/ProductPriceFilter.vue";
import ProductSearch from "@/Components/Filters/ProductSearch.vue";
// import AppliedFilters from "@/Components/Filters/AppliedFilters.vue";
import SortProducts from "@/Components/Filters/SortProducts.vue";
import pickBy from "lodash/pickBy";

import { usePage } from "@inertiajs/vue3";

const currentLocation = usePage().props.ziggy.location;

const props = defineProps({
    products: Object,
    categories: Array,
    tags: Array,
    search: String,
    price: Object,
    sort: String,
});

const filters = ref({
    search: props.search,
    category: props.category,
    price: props.price,
    sort: props.sort,
});

const setSearch = (value) => {
    filters.value.search = value;
};

const setSort = (value) => {
    filters.value.sort = value;
};

const setPrice = (value) => {
    filters.value.price = value;
};

watch(filters.value, (value) => {
    router.get(currentLocation, pickBy(value), {
        preserveState: true,
        replace: true,
    });
});

const visible = ref(false);
</script>
<template>
    <Head title="Home" />

    <ShopLayout>
        <div class="relative flex">
            <div class="mx-auto">
                <ul class="flex">
                    <li
                        v-for="category in categories"
                        :key="category.id"
                        class="text-zinc-500 cursor-pointer px-2 py-1"
                    >
                        <Link :href="route('catalog', category.slug)">{{
                            category.title
                        }}</Link>
                    </li>
                </ul>
            </div>
            <div class="absolute right-0 flex space-x-8">
                <button @click="visible = true">Filters</button>
                <SortProducts
                    :sort="props.sort"
                    @setSort="setSort"
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

        <div class="card flex justify-content-center">
            <Sidebar
                v-model:visible="visible"
                header="Filters"
                position="right"
            >
                <div class="space-y-2 p-4">
                    <ProductSearch
                        :search="props.search"
                        @setSearch="setSearch"
                    ></ProductSearch>

                    <ProductPriceFilter
                        :price="props.price"
                        @setPrice="setPrice"
                    ></ProductPriceFilter>
                </div>
            </Sidebar>
        </div>
    </ShopLayout>
</template>
