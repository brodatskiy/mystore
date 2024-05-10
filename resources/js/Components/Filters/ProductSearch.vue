<script setup>
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    search: String,
});

const emits = defineEmits(["setSearch"]);

const search = ref(props.search);

watch(
    () => search.value,
    debounce(function (value) {
        emits("setSearch", search.value);
    }, 300)
);
</script>

<template>
    <div class="pt-[34px] px-6 pb-0">
        <div class="relative">
            <input
                type="text"
                v-model="search"
                id="search"
                placeholder="Search among products"
                class="border border-zinc-300 p-2 px-3 text-xs w-full placeholder-zinc-400 rounded focus:border-transparent focus:ring focus:ring-zinc-300 focus:ring-opacity-80"
            />
        </div>
    </div>
</template>
