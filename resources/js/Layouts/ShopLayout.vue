<script setup>
import {ref, onMounted} from "vue";

import ButtonLink from "@/Components/Buttons/ButtonLink.vue";
import DrawerButtonLink from "@/Components/Buttons/DrawerButtonLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import LocaleSwitcher from "@/Components/LocaleSwitcher.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import ApplicationLogo from "@/Components/Buttons/ApplicationLogo.vue";


import Drawer from 'primevue/drawer';
import Button from 'primevue/button';
import SignUpButtonLink from "@/Components/Buttons/SignUpButtonLink.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";



const navigation = ref([]);
const darkMode = ref(isDarkMode());
const currentSection = ref(null);

const navigationExpand = ref(false);
const CategoriesExpand = ref(false);


function getNavigation() {
    axios.get(`/catalog/navigation`).then((res) => {
        navigation.value = res.data;
    });
}

function CategoriesExpander(section) {
    currentSection.value = section
    CategoriesExpand.value = true;
}

onMounted(() => {
    getNavigation();
});

function toggleDarkMode() {
    document.documentElement.classList.toggle('dark');
    darkMode.value = !darkMode.value;
}

function isDarkMode() {
    return document.documentElement.classList.contains('dark');
}
</script>
<template>
    <div class="min-h-screen">
        <header class="w-full sticky top-0 z-20 px-6 py-3 shadow-md bg-surface-200 dark:bg-surface-700">
            <div class="flex items-center justify-between space-x-4">
                <!-- Start -->
                <div class="flex space-x-4">
                    <div class="flex">
                        <ButtonPrimary
                            @click="navigationExpand = !navigationExpand"
                            variant="text"
                        >
                            <i class="pi pi-bars" style="font-size: 1.25rem"></i>
                        </ButtonPrimary>

                    </div>
                    <div class="flex">
                        <ApplicationLogo/>
                    </div>
                </div>

                <!-- Search -->
                <div class="flex-1">
                    <InputText placeholder="Search" type="text" class="min-w-32 sm:w-full"/>
                </div>
                <!-- End -->
                <div class="flex items-center justify-end">
                    <!-- Icon Buttons  -->
                    <LocaleSwitcher/>
                    <div class="flex items-center space-x-4 ml-4">
                        <ButtonPrimary @click="toggleDarkMode()">
                            <i v-if=darkMode class="pi pi-moon" style="font-size: 1.25rem"></i>
                            <i v-else class="pi pi-sun" style="font-size: 1.25rem"></i>
                        </ButtonPrimary>
                        <ButtonLink :href="route('cart.index')">
                            <i class="pi pi-shopping-cart" style="font-size: 1.25rem"></i>
                        </ButtonLink>
                        <ButtonLink :href="route('wishlist')">
                            <i class="pi pi-heart" style="font-size: 1.25rem"></i>
                        </ButtonLink>
                    </div>
                    <!-- Auth -->
                    <div class="ml-3">
                        <div
                            v-if="!$page.props.auth.user"
                            class="flex items-center gap-x-2"
                        >
                            <SignUpButtonLink
                                :href="route('login')"
                            >
                            </SignUpButtonLink>
                        </div>
                        <div v-else>
                            <div class="sm:ml-1">
                                <!-- Settings Dropdown -->
                                <div class="relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <Button
                                                variant="text"
                                            >
                                                <i class="pi pi-user" style="font-size: 1.25rem"></i>
                                            </Button>
                                        </template>

                                        <template #content>
                                            <a
                                                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                :href="route('platform.index')"
                                            >
                                                {{ $t("Admin panel") }}
                                            </a>
                                            <DropdownLink
                                                :href="route('profile.edit')"
                                            >
                                                {{ $t("Profile") }}
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('orderlist')"
                                            >
                                                {{ $t("Orders") }}
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
        <header class="" v-if="$slots.header">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <main>
            <div class="mx-auto p-1 sm:p-2 lg:p-4 min-w-[500px]">
                <slot/>
            </div>
        </main>

        <footer class="w-full sticky top-[100vh] px-6 py-3 bg-white">
            <div class="flex justify-end items-center">
                {{ new Date().getFullYear() }} — <strong>MyStore</strong>
            </div>
        </footer>
        <Drawer
            v-model:visible="navigationExpand"
            header="Categories"
            position="left"
            :modal="false"
            :showCloseIcon="false"
            @mouseleave="navigationExpand = true"
            :pt="{
                content: {class: 'p-0!'},
            }"
        >
            <div class="flex">
                <div class="flex flex-col w-1/2 ">
                    <DrawerButtonLink v-for="section in navigation"
                                   :key="section.id"
                                   :href="route('catalog.section.index', section.slug)"
                                   @mouseenter="CategoriesExpander(section)"
                    >
                        {{ section.title }}
                    </DrawerButtonLink>
                </div>

                <div v-if="CategoriesExpand" class="flex flex-col w-1/2">
                    <DrawerButtonLink v-for="category in currentSection.parentCategories"
                                   :key="category.id"
                                   :href="route('catalog.section.category.index', [currentSection.slug, category.slug])"
                    >
                        {{ category.title }}
                    </DrawerButtonLink>
                </div>
            </div>
        </Drawer>
    </div>
</template>

<style></style>
