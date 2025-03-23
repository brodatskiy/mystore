<script setup>
import {useI18n} from "vue-i18n";
import Dropdown from "@/Components/Dropdown.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

const {locale} = useI18n({useScope: "global"});

const setLocale = async (lang) => {
    await axios
        .post(route("locale"), {locale: lang})
        .then((locale.value = lang))
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <Dropdown align="left" width="48">
        <template #trigger>
            <ButtonPrimary
            >
                <i class="pi pi-language" style="font-size: 1.25rem"></i>
            </ButtonPrimary>
        </template>

        <template #content>
            <button
                v-for="lang in $i18n.availableLocales"
                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-primary-300 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                @click="setLocale(lang)"
                :class="{
                    'bg-primary-500': locale === lang,
                }"
            >
                {{ lang }}
            </button>
        </template>
    </Dropdown>
</template>

<style></style>
