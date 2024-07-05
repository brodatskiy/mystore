<script setup>
import { ref, watch, computed } from "vue";

import Select from 'primevue/select';

import { useFilterStore } from "@/Store/useFilterStore";

const filterStore = useFilterStore();

const emits = defineEmits(["change"]);

const sortOptions = ref([
    { title: "Price ascending", value: "price" },
    { title: "Price descending", value: "-price" },
]);

const sort = computed(() => {
    return sortOptions.value.filter((option) => option.value === props.sort)[0];
});
</script>

<template>
    <div>
        <Select
            v-model="filterStore.sort"
            :options="sortOptions"
            optionValue="value"
            optionLabel="title"
            placeholder="Sort by"
            @update:modelValue="emits('change')"
        />
    </div>
</template>
