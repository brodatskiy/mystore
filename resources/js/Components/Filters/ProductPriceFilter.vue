<script setup>
import {ref, watch} from "vue";
import {useFilterStore} from "@/Store/useFilterStore";

import InputNumber from 'primevue/inputnumber';

const filterStore = useFilterStore();

const props = defineProps({
    minPrice: Number,
    maxPrice: Number,
});

const minPrice = ref(props.minPrice);
const maxPrice = ref(props.maxPrice);

watch([minPrice, maxPrice], (minPrice, maxPrice) => {
    filterStore.minPrice = minPrice;
    filterStore.maxPrice = maxPrice;
});
</script>

<template>
    <div>
        <p class="font-medium text-xl mb-4">{{ $t("Price")}}</p>
        <div class="space-y-6">
            <div class="flex items-center justify-around space-x-4">
                <div class="space-x-2 flex">
                    <InputNumber
                        v-model="filterStore.minPrice"
                        inputClass="w-1/2"
                    />
                </div>
                <div class="space-x-2 flex">
                    <InputNumber
                        v-model="filterStore.maxPrice"
                        inputClass="w-1/2"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
