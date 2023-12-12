<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

// const classes = computed(() =>
//     props.active
//         ? "transition duration-150 ease-in-out"
//         : "border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition duration-150 ease-in-out"
// );
</script>

<template>
    <Link :href="href" preserve-state as="button">
        <v-list-item :active="active">
            <template v-slot:icon>
                <v-icon :icon="icon"></v-icon>
            </template>

            <v-list-item-title
                ><template v-slot:title></template
            ></v-list-item-title>
        </v-list-item>
    </Link>
</template>
