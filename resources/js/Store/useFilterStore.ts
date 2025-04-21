import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {router} from "@inertiajs/vue3";
import pickBy from "lodash/pickBy";

export const useFilterStore = defineStore("Filter", () => {
    const minPrice = ref();
    const maxPrice = ref();
    const sort = ref();
    const search = ref();

    const filters = computed(() => {
        return {minPrice: minPrice.value, maxPrice: maxPrice.value, sort: sort.value, search: search.value};
    });

    function setStore(props) {
        minPrice.value = props.minPrice;
        maxPrice.value = props.maxPrice;
        sort.value = props.sort;
        search.value = props.search;
    }

    function applyFilters(currentLocation) {
        router.get(currentLocation, pickBy(filters.value), {
            preserveScroll: true,
            async: true,
        });
    }

    return {
        sort, minPrice,
        maxPrice, search, filters, applyFilters, setStore
    };
});
