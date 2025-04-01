<script setup>
import {ref} from "vue";
import InputText from 'primevue/inputtext';

import {useFilterStore} from "@/Store/useFilterStore";
import {usePage} from "@inertiajs/vue3";

const filterStore = useFilterStore();
const currentLocation = usePage().props.ziggy.location;

const search = ref(filterStore.search);
function applyFilters() {
    filterStore.applyFilters(currentLocation);
    console.log(123);
}
</script>

<template>
        <InputText
            v-bind="$attrs"
            v-model="filterStore.search"
            type="text"
            placeholder="Search"
            v-on:keyup.enter="applyFilters"
        />
</template>
