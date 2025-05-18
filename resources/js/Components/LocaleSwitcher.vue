<script setup>
import {ref} from "vue";
import {useI18n} from "vue-i18n";

import ButtonDD from "@/Components/Buttons/ButtonDD.vue";
import {router} from "@inertiajs/vue3";

const {locale} = useI18n({useScope: "global"});
const menu = ref(null);

const overlayMenuItems = ref([
    {
        label: 'Ru',
        command: () => {
            setLocale('ru')
        },
    },
    {
        label: 'En',
        command: () => {
            setLocale('en')
        },
    },
]);

function toggleMenu(event) {
    menu.value.toggle(event);
}

function setLocale (lang) {
    router.post(route('changeLocale'), {locale: lang}, {
        preserveScroll: true,
        async: true,
        onSuccess: () => {
            locale.value = lang
        }
    })
}
</script>

<template>
    <Menu ref="menu" :model="overlayMenuItems" :popup="true"/>
    <ButtonDD @click="toggleMenu">
        <i class="pi pi-language" style="font-size: 1.25rem"></i>
    </ButtonDD>
</template>

<style></style>
