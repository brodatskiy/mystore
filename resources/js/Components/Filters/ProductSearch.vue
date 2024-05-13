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
        <IconField iconPosition="left">
            <InputIcon>
                <Icon
                    icon="mdi:search"
                    width="1.5rem"
                    height="1.5rem"
                    class="-mt-1"
                ></Icon>
            </InputIcon>
            <InputText v-model="search" type="text" placeholder="Search" />
        </IconField>
    </section>
</template>
