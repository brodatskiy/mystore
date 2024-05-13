<script setup>
import { ref, watch, computed } from "vue";
import Dropdown from "primevue/dropdown";

const props = defineProps({
    sort: String,
});

const sortOptions = ref([
    { title: "Price ascending", value: "price" },
    { title: "Price descending", value: "-price" },
]);

const sort = computed(() => {
    return sortOptions.value.filter((option) => option.value === props.sort)[0];
});

const sortField = ref(sort.value);

const emits = defineEmits(["setSort"]);

watch(sortField, (option) => {
    emits("setSort", option.value);
});
</script>

<template>
    <div>
        <Dropdown
            v-model="sortField"
            :options="sortOptions"
            :optionValue="sortOptions.value"
            optionLabel="title"
            placeholder="Sort by"
            class=""
        />
    </div>
</template>
