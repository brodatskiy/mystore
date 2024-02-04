<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm, Head, Link } from "@inertiajs/vue3";

import PrimaryButton from "@/Components/PrimaryButton.vue";
import axios from "axios";

const props = defineProps({ messages: Object });

window.Echo.channel("store_message").listen(".store_message", (res) => {
  props.messages.unshift(res.message);
});

const form = useForm({
  content: "",
});

function store() {
  axios.get("/cart");
}
</script>
<template>
  <Head title="Chat" />
  <MainLayout>
    <div class="p-4 mx-auto">
      <h3 class="">Chat</h3>
      <div v-for="message in messages" key="message.id" class="mt-4">
        <p class="text-body-1">{{ message.content }}</p>
        <p class="text-subtitle-2">{{ message.time }}</p>
      </div>
      <div>
        <v-text-field v-model="form.content" placeholder="Your message" />

        <PrimaryButton @click="store">Send</PrimaryButton>
      </div>
    </div>
  </MainLayout>
</template>

<style scoped></style>
