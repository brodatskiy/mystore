<template>
  <Transition name="modal">
    <div v-if="show" class="modal" @click="$emit('close')">
      <div @click.stop class="content"><slot> </slot></div>
    </div>
  </Transition>
</template>

<script setup lang="ts">
defineProps<{
  show: boolean
}>()
</script>

<style scoped>
.modal {
  position: fixed;
  display: flex;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  transition: all 0.3s ease;
}
.content {
  margin: auto;
  background: rgb(255, 255, 255);
  border-radius: 12px;
  min-height: 100px;
  min-width: 300px;
  width: 600px;
  padding: 20px 40px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
}

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
