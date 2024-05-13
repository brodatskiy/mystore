<script setup>
import { ref, watch } from "vue";

const props = defineProps({
    price: Object,
});

const emits = defineEmits(["setPrice"]);

const price = ref(props.price);

watch(price, (price) => {
    emits("setPrice", price.value);
});
</script>

<template>
    <section class="">
        <h3 class="font-medium text-xs uppercase mb-4">Price</h3>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="space-x-2">
                    <span>from</span>
                    <InputNumber
                        v-model="price[0]"
                        :useGrouping="false"
                        pt:input:root:class="w-20"
                        :ptOptions="{ mergeProps: true }"
                    />
                </div>

                <div class="space-x-2">
                    <span>to</span>
                    <InputNumber
                        v-model="price[1]"
                        :useGrouping="false"
                        pt:input:root:class="w-20"
                        :ptOptions="{ mergeProps: true }"
                    />
                </div>
            </div>
            <div>
                <Slider
                    v-model="price"
                    :min="props.price[0]"
                    :max="props.price[1]"
                    range
                />
            </div>
        </div>
    </section>
</template>
