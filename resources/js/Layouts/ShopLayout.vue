<script setup>
import { ref } from "vue";

import LinkBtn from "@/Components/LinkBtn.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

// import { useCartStore } from "@/Store/useCartStore";

// const cartStore = useCartStore();
const showingNavigationDropdown = ref(false);
let sidebarExpand = ref(false);
</script>
<template>
    <div class="min-h-screen bg-gray-100">
        <header
            class="w-full sticky top-0 z-10 px-6 py-3 bg-white border-b border-black"
        >
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="font-bold">
                    <ApplicationLogo />
                </div>
                <div class="flex items-center">
                    <!-- Icon Buttons  -->
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
                                                v-if="
                                                    $page.props.auth.user
                                                        .role === 1
                                                "
                                                :href="route('dashboard.index')"
                                            >
                                                Admin panel
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('profile.edit')"
                                            >
                                                Profile
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('logout')"
                                                method="post"
                                                as="button"
                                            >
                                                Log Out
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

        <main>
            <div class="mx-auto mt-2 p-4 sm:p-6 lg:p-8 min-w-[500px]">
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

<style>
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
