<script setup>
import {ref, watch} from "vue";
import {useFilterStore} from "@/Store/useFilterStore";

import InputNumber from 'primevue/inputnumber';

const filterStore = useFilterStore();

const props = defineProps({
    price: Object,
});

const price = ref(props.price);

watch(price, (price) => {
    filterStore.price = price;
});
</script>

<template>
    <div>
        <p class="font-medium text-xl mb-4">{{ $t("Price")}}</p>
        <div class="space-y-6">
            <div class="flex items-center justify-around">
                <div class="space-x-2 flex">
                    <InputNumber
                        v-model="filterStore.price[0]"
                        :useGrouping="false"
                        inputClass="w-20"
                    />
                </div>
                <div class="space-x-2 flex">
                    <InputNumber
                        v-model="filterStore.price[1]"
                        :useGrouping="false"
                        inputClass="w-20"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
