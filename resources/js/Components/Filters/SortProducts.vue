<script setup>
import { ref, watch, computed } from "vue";
import Dropdown from "primevue/dropdown";

import { useFilterStore } from "@/Store/useFilterStore";

const filterStore = useFilterStore();

// const props = defineProps({
//     sort: String,
// });

const emits = defineEmits(["change"]);

const sortOptions = ref([
    { title: "Price ascending", value: "price" },
    { title: "Price descending", value: "-price" },
]);

const sort = computed(() => {
    return sortOptions.value.filter((option) => option.value === props.sort)[0];
});

// const sortField = ref(sort.value);

// watch(sortField, (option) => {
//     emits("change", option.value);
// });

// function applyFilters() {
//     console.log("test");
// }
</script>

<template>
    <div>
        <Dropdown
            v-model="filterStore.sort"
            :options="sortOptions"
            optionValue="value"
            optionLabel="title"
            placeholder="Sort by"
            @update:modelValue="emits('change')"
        />
    </div>
</template>
