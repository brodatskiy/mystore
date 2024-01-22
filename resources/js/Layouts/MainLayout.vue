<script setup>
import { ref, onMounted } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";

// import { useCartStore } from "@/Store/useCartStore";
// import { useProductStore } from "@/Store/useProductStore";

// const productStore = useProductStore();
// const cartStore = useCartStore();

// productStore.fetchProducts();

let links = ref([
  {
    to: "cart",
    text: "Dashboard",
  },
  {
    to: "/",
    text: "Players",
  },
  {
    to: "/",
    text: "Tournaments",
  },
]);
let sidebarExpand = ref(false);

onMounted(() => {});
</script>
<template>
  <v-app>
    <v-app-bar color="surface" scroll-behavior="elevate">
      <div
        class="px-2 cursor-pointer"
        @click.stop="sidebarExpand = !sidebarExpand"
      >
        <v-icon icon="mdi-menu" size="large" />
      </div>
      <div class="hidden sm:block">Categories</div>
      <Link :href="route('chat.index')">
        <div class="hidden sm:block ml-2">Chat</div>
      </Link>

      <div class="sm:hidden px-2">
        <Link :href="route('/')">
          <button>
            <v-icon icon="mdi-magnify" size="large" />
          </button>
        </Link>
      </div>

      <v-spacer></v-spacer>

      <!-- Logo -->
      <div class="">
        <Link
          :href="route('/')"
          class="flex justify-center items-center text-gray-800 hover:text-red-300"
        >
          <p>MyStore</p>
        </Link>
      </div>

      <v-spacer></v-spacer>

      <div class="hidden sm:block px-2 text-gray-800 hover:text-red-300">
        <Link :href="route('/')">
          <button>
            <v-icon icon="mdi-magnify" size="large" />
          </button>
        </Link>
      </div>

      <div class="px-2 text-gray-800 hover:text-red-300">
        <Link :href="route('cart')">
          <button>
            <v-icon icon="mdi-heart" />
          </button>
        </Link>
      </div>

      <div class="px-2 text-gray-800 hover:text-red-300">
        <Link :href="route('cart')">
          <v-badge :content="11">
            <button>
              <v-icon icon="mdi-shopping" />
            </button>
          </v-badge>
        </Link>
      </div>

      <!-- Account Menu -->
      <div class="hidden sm:block text-gray-800 hover:text-red-300">
        <!-- Login/Register -->
        <div v-if="!$page.props.auth.user">
          <div>
            <Link :href="route('login')">
              <button>
                <v-icon icon="mdi-account" size="large" />
              </button>
            </Link>
          </div>
        </div>
        <div v-else class="flex">
          <button class="px-2 text-gray-800 hover:text-red-300">
            <v-icon icon="mdi-account-check" size="large" />
            <v-menu activator="parent">
              <v-list>
                <v-list-item>
                  <div>
                    <Link
                      :href="route('logout')"
                      method="post"
                      as="button"
                      class="p-1"
                    >
                      <v-list-item-title> Log out </v-list-item-title>
                    </Link>
                  </div>
                  <div>
                    <Link
                      :href="route('dashboard.index')"
                      as="button"
                      class="p-1"
                    >
                      <v-list-item-title> Admin </v-list-item-title>
                    </Link>
                  </div>
                </v-list-item>
              </v-list>
            </v-menu>
          </button>
        </div>
      </div>
    </v-app-bar>
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

    <main>
      <v-container fluid class="mt-16">
        <slot />
      </v-container>
    </main>

    <v-footer color="background">
      <v-btn class="mx-auto" variant="text" @click="print('footer')">
        Get data
      </v-btn>
    </v-footer>
  </v-app>
</template>

<style scoped>
.navbar {
  z-index: 1006;
}
</style>
