<script setup>
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

import { useFilterStore } from "@/Store/useFilterStore";

const filterStore = useFilterStore();

const search = ref(filterStore.search);

// watch(
//     () => search.value,
//     debounce(function (value) {
//         filterStore.search = value;
//     }, 300)
// );
</script>

<template>
    <section>
        <InputText
            v-model="filterStore.search"
            type="text"
            placeholder="Search"
        />
    </section>
</template>
