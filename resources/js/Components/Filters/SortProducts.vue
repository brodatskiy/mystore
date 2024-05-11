<script setup>
import { ref, watch } from "vue";
import Dropdown from "primevue/dropdown";

const props = defineProps({
    sort: String,
});

const sortOptions = ref([
    { title: "Price ascending", value: "price" },
    { title: "Price descending", value: "-price" },
]);

const emits = defineEmits(["setSort"]);

const sortField = ref(props.sort);

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
