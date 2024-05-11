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
    <section class="p-6 pb-0">
        <span class="block font-medium text-xs uppercase mb-4">Price</span>

        <div>
            <div class="flex items-center justify-between space-x-2">
                <input
                    type="number"
                    step="5"
                    min="0"
                    v-model="price.min"
                    placeholder="Min"
                    class="w-full bg-zinc-200 text-zinc-600 placeholder-zinc-400 rounded border-none focus:ring focus:ring-zinc-300 focus:ring-opacity-80 text-xs"
                />
                <input
                    type="number"
                    step="5"
                    min="0"
                    v-model="price.max"
                    placeholder="Max"
                    class="w-full bg-zinc-200 text-zinc-600 placeholder-zinc-400 rounded border-none focus:ring focus:ring-zinc-300 focus:ring-opacity-80 text-xs"
                />
            </div>
        </div>
    </section>
</template>
