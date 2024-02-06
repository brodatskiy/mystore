<script setup>
import { ref, onMounted } from "vue";
import { useGoTo } from "vuetify";
import { useForm, Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";

const props = defineProps({ messages: Object });

let parents = ref([
  {
    id: 1,
    title: "john doe",
    active: true,
  },
  {
    id: 3,
    title: "scarlett",
    active: false,
  },
  {
    id: 4,
    title: "scarlett",
    active: false,
  },
]);

const goTo = useGoTo();
const messageForm = useForm({
  content: "",
  me: true,
  created_at: "11:11am",
});

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Chat", disabled: true, href: "chat.index" },
]);

function sendMessage() {
  props.messages.push(messageForm);
  messageForm.content = "";
  goTo(600, { container: "#goto-container" });
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

    <v-sheet class="pa-4" rounded="xl" elevation="3">
      <v-container class="pa-0">
        <v-row>
          <v-col cols="12" sm="3">
            <v-list>
              <template v-for="(item, index) in parents" :key="index">
                <v-list-item>
                  <template v-slot:prepend>
                    <v-avatar>
                      <v-img cover :src="item.avatar">
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
                  <v-list-item-title v-text="item.title" />
                  <v-list-item-subtitle v-text="'hi'" />
                </v-list-item>
                <v-divider />
              </template>
            </v-list>
          </v-col>
          <v-divider vertical></v-divider>
          <v-col cols="auto" class="flex-grow-1 flex-shrink-0">
            <v-card flat class="d-flex flex-column" height="500">
              <v-card-title> John Doe </v-card-title>

              <v-card-text
                class="flex-grow-1 overflow-y-auto"
                id="goto-container"
              >
                <template v-for="(msg, i) in messages">
                  <div :class="{ 'd-flex flex-row-reverse': msg.me }">
                    <v-chip
                      :color="msg.me ? 'primary' : ''"
                      dark
                      style="height: auto; white-space: normal"
                      class="pa-4 mb-2"
                    >
                      {{ msg.content }}
                      <sub class="ml-2" style="font-size: 0.5rem">
                        {{ msg.created_at }}
                      </sub>
                    </v-chip>
                  </div>
                </template>
              </v-card-text>

              <v-card-text class="flex-grow-0 flex-shrink-1">
                <v-text-field
                  v-model="messageForm.content"
                  label="type a message"
                  variant="outlined"
                  type="text"
                  no-details
                  append-inner-icon="mdi-send"
                  @keyup.enter="sendMessage"
                  @click:appendInner="sendMessage"
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
