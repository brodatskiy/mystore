<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";
import NavMenu from "@/Components/NavMenu.vue";

let sidebarExpand = ref(true);
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
    <v-navigation-drawer v-model="sidebarExpand" floating elevation="3">
      <!-- Logo -->
      <v-list class="d-flex">
        <v-list-item>
          <Link :href="route('/')" class="d-flex align-middle">
            <v-icon icon="mdi-store" size="large"></v-icon>
            <h3 class="font-weight-bold">MyStore</h3>
          </Link>
        </v-list-item>

        <div
          class="ml-auto px-2 my-auto cursor-pointer"
          @click.stop="sidebarExpand = !sidebarExpand"
        >
          <v-icon v-if="sidebarExpand" icon="mdi-chevron-left" size="large" />
        </div>
      </v-list>

      <!-- User -->
      <v-list>
        <v-list-item>
          <div class="d-flex align-center">
            <div>
              <v-avatar>
                <v-img cover :src="AvatarPlaceholder"></v-img>
              </v-avatar>
            </div>
            <div class="ml-5">
              <v-list-item-title>
                {{ $page.props.auth.user.name }}
              </v-list-item-title>
            </div>
            <div class="ml-auto">
              <Link :href="route('logout')" method="post" as="button">
                <v-icon icon="mdi-logout" />
              </Link>
            </div>
          </div>
        </v-list-item>
      </v-list>

      <!-- Links -->
      <NavMenu :navLinks="navLinks" />
    </v-navigation-drawer>

    <v-toolbar color="transparent" flat class="px-1">
      <div
        class="px-2 cursor-pointer"
        @click.stop="sidebarExpand = !sidebarExpand"
      >
        <v-icon v-if="!sidebarExpand" icon="mdi-menu" size="large" />
      </div>
      <v-spacer></v-spacer>
      <div class="w-25 px-2">
        <v-text-field
          density="compact"
          variant="solo"
          label="Search"
          append-inner-icon="mdi-magnify"
          hide-details
          rounded="xl"
        ></v-text-field>
      </div>
    </v-toolbar>

    <!-- Page Content -->
    <v-main>
      <v-container fluid class="mt-5 h-100">
        <slot />
      </v-container>
      <v-footer height="32" class="rounded-t-xl">
        <div class="px-4 py-2 text-end w-100">
          {{ new Date().getFullYear() }} — <strong>MyStore</strong>
        </div>
      </v-footer>
    </v-main>
  </v-app>
</template>
<style></style>
