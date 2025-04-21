import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import pickBy from "lodash/pickBy";

export const useFilterStore = defineStore("Filter", () => {
    const price = ref([]);
    const sort = ref();
    const search = ref();

    const filters = computed(() => {
        return { price: price.value, sort: sort.value, search: search.value };
    });

    function setStore(props) {
        price.value = props.price;
        sort.value = props.sort;
        search.value = props.search;
    }

    function applyFilters(currentLocation) {
        router.get(currentLocation, pickBy(filters.value), {
            preserveScroll: true,
            async: true,
        });
    }

    return { sort, price, search, filters, applyFilters, setStore };
});
