<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const flashMessage = ref({ message: usePage().props.flash.message });

onMounted(() => {
  setTimeout(() => {
    usePage().props.flash.message = "";
  }, 3000);
});
</script>

<template>
  <div
    class="fixed top-20 left-12 bg-white shadow shadow-zinc-200 drop-shadow-md text-[13px] p-4 rounded-xl flex items-center space-x-4 z-20"
  >
    <div
      class="p-1 rounded-full bg-green-200 text-green-500 bg-opacity-50"
    ></div>
    <div>
      <span class="text-zinc-500">{{ flashMessage.message }}</span>
    </div>
  </div>
</template>
