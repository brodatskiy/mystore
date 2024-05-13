<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";

import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";
import ProductCategoryFilter from "@/Components/Filters/ProductCategoryFilter.vue";
import ProductPriceFilter from "@/Components/Filters/ProductPriceFilter.vue";
import ProductSearch from "@/Components/Filters/ProductSearch.vue";
// import AppliedFilters from "@/Components/Filters/AppliedFilters.vue";
import SortProducts from "@/Components/Filters/SortProducts.vue";
import debounce from "lodash/debounce";
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
</script>
<template>
    <Head title="Home" />

    <ShopLayout>
        <div class="pb-2 flex">
            <ul class="flex justify-center mx-auto max-w-2xl">
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
            <SortProducts
                :sort="filters.sort"
                @setSort="setSort"
            ></SortProducts>
        </div>
        <div class="flex">
            <div class="sm:w-64 sm:border-r">
                <ProductSearch
                    :search="filters.search"
                    @setSearch="setSearch"
                ></ProductSearch>

                <ProductPriceFilter
                    :price="filters.price"
                    @setPrice="setPrice"
                ></ProductPriceFilter>
            </div>
            <div class="flex-1">
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
        </div>
    </ShopLayout>
</template>
