<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm, Head, Link } from "@inertiajs/vue3";
import { useGoTo } from "vuetify";

import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({ messages: Object });

window.Echo.channel("store_message").listen(".store_message", (res) => {
  props.messages.push(res.message);
});

const form = useForm({
  content: "",
});

function store() {
  axios.post("/messages", { content: form.content }).then((res) => {
    props.messages.push(res.data);
    form.content = "";
  });
}
</script>
<template>
  <Head title="Chat" />
  <MainLayout>
    <v-sheet class="pa-4" rounded="xl" elevation="3">
      <v-container class="pa-0">
        <v-row>
          <v-col cols="auto" class="flex-grow-1 flex-shrink-0">
            <v-card flat class="d-flex flex-column" height="500">
              <v-card-title> Chat </v-card-title>

              <v-card-text
                class="flex-grow-1 overflow-y-auto"
                id="goto-container"
              >
                <template v-for="(message, i) in messages">
                  <div
                    :class="{
                      'd-flex flex-row-reverse':
                        message.author == $page.props.auth.user.id,
                    }"
                  >
                    <div>
                      <v-chip
                        :color="
                          message.author == $page.props.auth.user.id
                            ? 'secondary rounded-be-0'
                            : 'primary rounded-bs-0'
                        "
                        class="h-auto px-5 py-1 mb-3 rounded-xl"
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
                  </div>
                </template>
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
  </MainLayout>
</template>

<style scoped></style>
