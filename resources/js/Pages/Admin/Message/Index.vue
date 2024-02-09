<script setup>
import { ref } from "vue";
import { useForm, Head, Link, usePage } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";

const props = defineProps({ messages: Object });
const page = usePage();

window.Echo.channel("store_message").listen(".store_message", (res) => {
  props.messages.push(res.message);
});

let chats = ref([
  {
    id: 1,
    name: "john doe",
    active: true,
  },
  {
    id: 3,
    name: "scarlett",
    active: false,
  },
  {
    id: 4,
    name: "scarlett",
    active: false,
  },
]);

let messagesRefs = ref([]);

const form = useForm({
  content: "",
});

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Chat", disabled: true, href: "chat.index" },
]);

function store() {
  axios.post("/admin/chat", { content: form.content }).then((res) => {
    props.messages.push(res.data);
    form.content = "";
  });
}
</script>

<template>
  <Head title="Chat" />

  <AdminLayout>
    <v-breadcrumbs :items="breadcrumbs">
      <template v-slot:title="{ item }">
        <Link :href="route(item.href)">
          {{ item.title }}
        </Link>
      </template>
      <template v-slot:divider>
        <v-icon icon="mdi-chevron-right"></v-icon>
      </template>
    </v-breadcrumbs>

    <v-sheet class="pa-4" rounded="xl" elevation="3" min-height="500">
      <v-container class="pa-0">
        <v-row>
          <v-col cols="12" sm="3">
            <v-list>
              <template v-for="chat in chats">
                <v-list-item>
                  <template v-slot:prepend>
                    <v-avatar>
                      <v-img cover :src="chat.avatar">
                        <template v-slot:error>
                          <v-img
                            class="mx-auto"
                            height="300"
                            max-width="300"
                            :src="AvatarPlaceholder"
                          ></v-img>
                        </template>
                      </v-img>
                    </v-avatar>
                  </template>
                  <v-list-item-title v-text="chat.name" />
                </v-list-item>
                <v-divider />
              </template>
            </v-list>
          </v-col>
          <v-divider vertical></v-divider>
          <v-col cols="auto" class="flex-grow-1 flex-shrink-0">
            <v-card flat class="d-flex flex-column" height="500">
              <v-card-title> Chat </v-card-title>

              <v-card-text class="overflow-y-auto" id="goto-container">
                <div
                  v-for="message in messages"
                  ref="messagesRefs"
                  :class="{
                    'd-flex flex-row-reverse':
                      message.author == $page.props.auth.user.id,
                  }"
                >
                  <v-chip
                    :color="
                      message.author == $page.props.auth.user.id
                        ? 'secondary rounded-be-0'
                        : 'primary rounded-bs-0'
                    "
                    class="h-auto px-5 py-3 mt-5 rounded-xl"
                  >
                    <div class="d-flex flex-column">
                      <div class="text-body-1 ml-auto">
                        {{ message.content }}
                      </div>
                      <div class="text-subtitle-2">
                        {{ message.time }}
                      </div>
                    </div>
                  </v-chip>
                </div>
              </v-card-text>

              <v-card-text class="flex-grow-0 flex-shrink-1">
                <v-text-field
                  v-model="form.content"
                  label="type a message"
                  variant="outlined"
                  type="text"
                  no-details
                  append-inner-icon="mdi-send"
                  @keyup.enter="store"
                  @click:appendInner="store"
                  hide-details
                />
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
