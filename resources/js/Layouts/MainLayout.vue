<script setup>
import { ref, onMounted } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";

// import { useCartStore } from "@/Store/useCartStore";
// import { useProductStore } from "@/Store/useProductStore";

// const productStore = useProductStore();
// const cartStore = useCartStore();

// productStore.fetchProducts();

let sidebarExpand = ref(false);

onMounted(() => {});
</script>
<template>
  <v-app>
    <v-app-bar color="surface" scroll-behavior="elevate">
      <template v-slot:prepend>
        <div
          class="px-2 cursor-pointer"
          @click.stop="sidebarExpand = !sidebarExpand"
        >
          <v-icon icon="mdi-menu" size="large" />
        </div>

        <!-- <Link :href="route('chat.index')">
          <div class="ml-2">Chat</div>
        </Link> -->
      </template>

      <!-- Logo -->
      <v-app-bar-title class="header__logo">
        <ApplicationLogo />
      </v-app-bar-title>

      <template v-slot:append>
        <div class="hidden sm:block px-2 text-gray-800 hover:text-red-300">
          <Link :href="route('/')">
            <button>
              <v-icon icon="mdi-magnify" size="large" />
            </button>
          </Link>
        </div>

        <!-- Account Menu -->
        <div>
          <!-- Login/Register -->
          <div v-if="!$page.props.auth.user">
            <div>
              <Link :href="route('login')">
                <button class="px-2">
                  <v-icon icon="mdi-account" size="large" />
                </button>
              </Link>
            </div>
          </div>
          <div v-else>
            <button class="px-2">
              <v-icon icon="mdi-account-check" size="large" />
              <v-menu activator="parent" open-on-hover width="120" offset="10">
                <v-list>
                  <v-list-item v-if="$page.props.auth.user.role === 1">
                    <Link :href="route('dashboard.index')" as="button">
                      <v-list-item-title> Admin panel </v-list-item-title>
                    </Link>
                  </v-list-item>
                  <v-list-item>
                    <Link :href="route('profile.edit')" as="button">
                      <v-list-item-title> Profile </v-list-item-title>
                    </Link>
                  </v-list-item>
                  <v-list-item>
                    <Link :href="route('chat.index')" as="button">
                      <v-list-item-title> Chat </v-list-item-title>
                    </Link>
                  </v-list-item>

                  <v-divider></v-divider>

                  <v-list-item>
                    <Link :href="route('logout')" method="post" as="button">
                      <v-list-item-title> Log out </v-list-item-title>
                    </Link>
                  </v-list-item>
                </v-list>
              </v-menu>
            </button>
          </div>
        </div>

        <div class="px-2">
          <Link :href="route('cart')">
            <button>
              <v-icon icon="mdi-heart" />
            </button>
          </Link>
        </div>

        <div class="px-2">
          <Link :href="route('cart')">
            <v-badge :content="11">
              <button>
                <v-icon icon="mdi-shopping" />
              </button>
            </v-badge>
          </Link>
        </div>
      </template>
    </v-app-bar>

    <!-- NavDrawer -->
    <v-sheet
      v-if="sidebarExpand"
      class="navbar h-100 w-50"
      position="absolute"
      color="white"
      :width="200"
    >
      <div
        class="p-2 cursor-pointer"
        @click.stop="sidebarExpand = !sidebarExpand"
      >
        <v-icon v-if="sidebarExpand" icon="mdi-chevron-left" size="large" />
        <span>BACK</span>
      </div>
      <v-list class="flex justify-around">
        <v-list-item>
          <Link
            class="p-2 border-b-2"
            :href="route('/')"
            :active="route().current('/')"
          >
            Man
          </Link>
        </v-list-item>
        <v-list-item>
          <Link :href="route('/')" :active="route().current('/cart')">
            Woman
          </Link>
        </v-list-item>
      </v-list></v-sheet
    >

    <v-main>
      <v-container fluid class="mt-16 h-100">
        <slot />
      </v-container>
      <v-footer height="32" color="background">
        <v-btn class="mx-auto" variant="text" @click="print('footer')">
          Get data
        </v-btn>
      </v-footer>
    </v-main>
  </v-app>
</template>

<style scoped>
.navbar {
  z-index: 1006;
}
</style>
