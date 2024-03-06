<script setup></script>

<template>
  <Link
    v-bind="$attrs"
    class="v-btn v-btn--flat v-theme--myCustomLightTheme bg-primary v-btn--density-default v-btn--size-default v-btn--variant-elevated rounded-xl"
  >
    <slot />
  </Link>
</template>
