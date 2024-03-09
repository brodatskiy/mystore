<script setup>
import { ref } from "vue";

import LinkButton from "@/Components/LinkButton.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

// import { useCartStore } from "@/Store/useCartStore";

// const cartStore = useCartStore();

let sidebarExpand = ref(false);
</script>
<template>
  <div class="min-h-screen bg-gray-100">
    <header>
      <nav
        class="block w-full fixed top-0 z-10 px-6 py-3 bg-white border-b border-black"
      >
        <div class="flex items-center justify-between">
          <!-- Logo -->
          <div class="font-bold text-xl">
            <Link :href="route('/')">MyStore</Link>
          </div>
          <div class="flex items-center space-x-4">
            <!-- Icon Buttons  -->
            <div>
              <ul class="flex items-center space-x-4">
                <li>
                  <Link :href="route('cart')">
                    <Icon
                      icon="mdi:cart-outline"
                      width="1.5rem"
                      height="1.5rem"
                    />
                  </Link>
                </li>
                <li>
                  <Link :href="route('cart')">
                    <Icon
                      icon="mdi:heart-outline"
                      width="1.5rem"
                      height="1.5rem"
                    />
                  </Link>
                </li>
              </ul>
            </div>
            <!-- Auth -->
            <div
              v-if="!$page.props.auth.user"
              class="flex items-center gap-x-1"
            >
              <LinkButton :href="route('login')" type="button">
                <span>Log In</span>
              </LinkButton>
              <LinkButton
                :href="route('register')"
                class="bg-gray-200"
                type="button"
              >
                Sign in
              </LinkButton>
            </div>
            <div v-else>
              <Icon icon="mdi:person" width="1.5rem" height="1.5rem" />
            </div>
          </div>
        </div>
      </nav>
    </header>

    <!-- SideBar -->

    <main>
      <div fluid class="h-100">
        <slot />
      </div>
      <footer height="32" class="">
        <div class="px-4 py-2 text-end w-100">
          {{ new Date().getFullYear() }} — <strong>MyStore</strong>
        </div>
      </footer>
    </main>
  </div>
</template>

<style scoped></style>
