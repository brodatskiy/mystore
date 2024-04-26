<script setup>
import { useI18n } from "vue-i18n";
import Dropdown from "@/Components/Dropdown.vue";
const { locale } = useI18n({ useScope: "global" });

const setLocale = async (lang) => {
    await axios
        .post(route("locale"), { locale: lang })
        .then((locale.value = lang))
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <Dropdown align="left" width="48">
        <template #trigger>
            <button
                class="px-4 py-2 font-sans text-xs font-bold text-center bg-gray-100 text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/20 active:bg-gray-900/30"
            >
                <Icon icon="mdi:language" width="1.5rem" height="1.5rem" />
            </button>
        </template>

        <template #content>
            <button
                v-for="lang in $i18n.availableLocales"
                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                @click="setLocale(lang)"
                :class="{
                    'bg-primary-400': locale == lang,
                }"
            >
                {{ lang }}
            </button>
        </template>
    </Dropdown>
</template>

<style></style>
