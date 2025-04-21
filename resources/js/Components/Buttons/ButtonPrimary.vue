<template>
    <button
        v-bind="$attrs"
        class="px-3 py-2 rounded-md bg-primary-500 hover:bg-primary-400 cursor-pointer text-white transition-all"
    >
        <slot/>
    </button>
</template>
