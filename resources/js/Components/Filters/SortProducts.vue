<script setup>
import {computed, ref} from "vue";

import Select from 'primevue/select';

import {useFilterStore} from "@/Store/useFilterStore";
import {useI18n} from "vue-i18n";

const {t} = useI18n()
const filterStore = useFilterStore();

const emits = defineEmits(["change"]);

const sortOptions = ref([
    {title: computed(() => t('Popularity')), value: "popularity"},
    {title: computed(() => t('Rating')), value: "rating"},
    {title: computed(() => t('Price ascending')), value: "price"},
    {title: computed(() => t('Price descending')), value: "-price"},
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
            @update:modelValue="emits('change')"
        />
    </div>
</template>
