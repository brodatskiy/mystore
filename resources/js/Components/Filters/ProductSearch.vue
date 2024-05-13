<script setup>
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";

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
    <section>
        <InputText v-model="search" type="text" placeholder="Search" />
    </section>
</template>
