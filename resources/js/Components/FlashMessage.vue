<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const flashMessage = ref(usePage().props.flash.message);

onMounted(() => {
    setTimeout(() => {
        usePage().props.flash.message = "";
    }, 3000);
});
</script>

<template>
    <Message severity="contrast" class="fixed">{{ flashMessage }}</Message>
</template>

<style></style>
