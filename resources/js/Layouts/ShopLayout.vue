<script setup>
import {ref, onMounted} from "vue";

import LinkBtn from "@/Components/Buttons/LinkBtn.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import LocaleSwitcher from "@/Components/LocaleSwitcher.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const sectionsExpand = ref(false);
const parentCategoriesExpand = ref(false);
const subCategoriesExpand = ref(false);

const sectionsWithCategories = ref([]);
const parentCategories = ref([]);
const subCategories = ref([]);

function getSectionsWithCategories() {
    axios.get(`/sections`).then((res) => {
        sectionsWithCategories.value = res.data;
    });
}

function parentCategoriesExpander(categories) {
    parentCategoriesExpand.value = true;
    parentCategories.value = categories;
}

function subCategoriesExpander(categories) {
    subCategoriesExpand.value = true;
    subCategories.value = categories;
}

onMounted(() => {
    getSectionsWithCategories();
});
</script>
<template>
    <div class="min-h-screen bg-gray-100">
        <header class="w-full sticky top-0 z-20 px-6 py-3 bg-white shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <button
                        @click="sectionsExpand = !sectionsExpand"
                        class="font-bold hover:text-primary-600"
                    >
                        Categories
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex-1 flex justify-center">
                    <ApplicationLogo/>
                </div>
                <div class="flex-1 flex items-center justify-end">
                    <!-- Icon Buttons  -->
                    <LocaleSwitcher/>
                    <div class="flex items-center space-x-4 ml-4">
                        <LinkBtn :href="route('cart.index')">
                            <Icon
                                icon="mdi:cart-outline"
                                width="1.5rem"
                                height="1.5rem"
                            />
                        </LinkBtn>
                        <LinkBtn :href="route('wishlist')">
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
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <main>
            <div class="mx-auto mt-2 p-2 sm:p-4 lg:p-6 min-w-[500px]">
                <slot/>
            </div>
        </main>

        <footer class="w-full sticky top-[100vh] px-6 py-3 bg-white">
            <div class="flex justify-end items-center">
                {{ new Date().getFullYear() }} — <strong>MyStore</strong>
            </div>
        </footer>
        <Sidebar
            v-model:visible="sectionsExpand"
            header="Categories"
            position="left"
            :modal="false"
            :showCloseIcon="false"
            @mouseleave="sectionsExpand = false"
            class="w-96"
        >
            <div class="overflow-y-auto flex">
                <div class="flex flex-col w-1/3">
                    <Link
                        v-for="section in sectionsWithCategories"
                        :href="route('section', section.slug)"
                        :key="section.id"
                        @mouseenter="parentCategoriesExpander(section.parentCategories)"
                        class="py-2 hover:text-primary-600"
                    >
                        {{ section.title }}
                    </Link>
                </div>
                <div @mouseleave="subCategoriesExpand = false" class="flex w-2/3">
                    <div v-show="parentCategoriesExpand" class="flex flex-col w-1/2">
                        <Link
                            v-for="category in parentCategories"
                            :href="route('category', category.slug)"
                            :key="category.id"
                            @mouseenter="subCategoriesExpander(category.children)"
                            class="py-2 hover:text-primary-600"
                        >
                            {{ category.title }}
                        </Link>
                    </div>
                    <div v-show="subCategoriesExpand" class="flex flex-col w-1/2">
                        <Link
                            v-for="category in subCategories"
                            :href="route('category', category.slug)"
                            :key="category.id"
                            class=" py-2 hover:text-primary-600"
                        >
                            {{ category.title }}
                        </Link>
                    </div>
                </div>
            </div>
        </Sidebar>
    </div>


</template>

<style></style>
