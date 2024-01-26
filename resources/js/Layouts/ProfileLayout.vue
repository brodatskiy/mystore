<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";

let navLinks = ref([
  {
    title: "Dashboard",
    icon: "mdi-view-dashboard-variant-outline",
    href: "dashboard.index",
  },
  {
    title: "Users",
    icon: "mdi-account-box",
    href: "users.index",
  },
  { title: "Products", icon: "mdi-tshirt-crew", href: "products.index" },
  { title: "Tags", icon: "mdi-tag-multiple", href: "tags.index" },
  { title: "Categories", icon: "mdi-list-box", href: "categories.index" },
]);
</script>
<template>
  <v-app>
    <v-toolbar color="surface" elevation="1" class="px-1">
      <!-- Logo -->
      <v-app-bar-title class="header__logo">
        <Link :href="route('/')">
          <p>MyStore</p>
        </Link>
      </v-app-bar-title>
      <v-spacer></v-spacer>
      <button class="px-2">
        <v-icon icon="mdi-account-check" size="large" />
        <v-menu activator="parent" open-on-hover>
          <v-list>
            <v-list-item>
              <Link :href="route('chat.index')" as="button">
                <v-list-item-title> Chat </v-list-item-title>
              </Link>
            </v-list-item>
            <v-list-item>
              <Link :href="route('profile.edit')" as="button">
                <v-list-item-title> Profile </v-list-item-title>
              </Link>
            </v-list-item>
            <v-list-item>
              <Link :href="route('dashboard.index')" as="button">
                <v-list-item-title> Admin </v-list-item-title>
              </Link>
            </v-list-item>
            <v-list-item>
              <Link :href="route('logout')" method="post" as="button">
                <v-list-item-title> Log out </v-list-item-title>
              </Link>
            </v-list-item>
          </v-list>
        </v-menu>
      </button>
    </v-toolbar>

    <!-- Page Content -->
    <v-main>
      <v-container class="mt-2">
        <slot />
      </v-container>
    </v-main>

    <v-footer elevation="1" class="ma-0">
      <div class="text-end w-100">
        {{ new Date().getFullYear() }} — <strong>MyStore</strong>
      </div>
    </v-footer>
  </v-app>
</template>
<style></style>
