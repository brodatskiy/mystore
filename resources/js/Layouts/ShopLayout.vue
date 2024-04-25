<script setup>
import { ref, watchEffect } from "vue";

import LinkBtn from "@/Components/Buttons/LinkBtn.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { usePage } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
const { locale } = useI18n({ useScope: "global" });

// import { useCartStore } from "@/Store/useCartStore";

// const cartStore = useCartStore();

// const locale = ref(usePage().props.locale);
const showingNavigationDropdown = ref(false);
let sidebarExpand = ref(false);

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
    <div class="min-h-screen bg-gray-100">
        <header
            class="w-full sticky top-0 z-20 px-6 py-3 bg-white border-b border-black"
        >
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="font-bold">
                    <ApplicationLogo />
                </div>
                <div class="flex items-center">
                    <!-- Icon Buttons  -->
                    <Dropdown align="left" width="48">
                        <template #trigger>
                            <button
                                class="px-4 py-2 font-sans text-xs font-bold text-center bg-gray-100 text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/20 active:bg-gray-900/30"
                            >
                                <Icon
                                    icon="mdi:language"
                                    width="1.5rem"
                                    height="1.5rem"
                                />
                            </button>
                        </template>

                        <template #content>
                            <button
                                v-for="locale in $i18n.availableLocales"
                                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                @click="setLocale(locale)"
                            >
                                {{ locale }}
                            </button>
                        </template>
                    </Dropdown>

                    <div class="flex items-center space-x-4 ml-4">
                        <LinkBtn :href="route('cart')">
                            <Icon
                                icon="mdi:cart-outline"
                                width="1.5rem"
                                height="1.5rem"
                            />
                        </LinkBtn>
                        <LinkBtn :href="route('cart')">
                            <Icon
                                icon="mdi:heart-outline"
                                width="1.5rem"
                                height="1.5rem"
                            />
                        </LinkBtn>
                    </div>
                    <!-- Auth -->
                    <div class="ml-3">
                        <div
                            v-if="!$page.props.auth.user"
                            class="flex items-center gap-x-2"
                        >
                            <LinkBtn
                                :href="route('login')"
                                class="py-3"
                                type="button"
                            >
                                <span>Log In</span>
                            </LinkBtn>
                            <LinkBtn
                                :href="route('register')"
                                class="py-3 bg-gray-200"
                                type="button"
                            >
                                <span>Sign in</span>
                            </LinkBtn>
                        </div>
                        <div v-else>
                            <div class="sm:ml-1">
                                <!-- Settings Dropdown -->
                                <div class="relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button
                                                class="px-4 py-2 font-sans text-xs font-bold text-center bg-gray-100 text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/20 active:bg-gray-900/30"
                                            >
                                                <Icon
                                                    icon="mdi:person"
                                                    width="1.5rem"
                                                    height="1.5rem"
                                                />
                                            </button>
                                        </template>

                                        <template #content>
                                            <DropdownLink
                                                :href="route('profile.edit')"
                                            >
                                                {{ $t("Profile") }}
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('logout')"
                                                method="post"
                                                as="button"
                                            >
                                                {{ $t("Log Out") }}
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <Transition name="slide-fade">
            <FlashMessage v-if="$page.props.flash.message"></FlashMessage>
        </Transition>

        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <main>
            <div class="mx-auto mt-2 p-2 sm:p-4 lg:p-6 min-w-[500px]">
                <slot />
            </div>
        </main>

        <footer class="w-full sticky top-[100vh] px-6 py-3 bg-white">
            <div class="flex justify-end items-center">
                {{ new Date().getFullYear() }} — <strong>MyStore</strong>
            </div>
        </footer>
    </div>
</template>

<style></style>
