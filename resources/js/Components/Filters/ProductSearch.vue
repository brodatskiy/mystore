<script setup>
import { ref} from "vue";
import InputText from 'primevue/inputtext';

import { useFilterStore } from "@/Store/useFilterStore";

const filterStore = useFilterStore();

const search = ref(filterStore.search);

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
