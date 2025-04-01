<template>
        <button
            v-bind="$attrs"
            class="flex items-center px-2 py-2 hover:text-primary-600 dark:hover:text-primary-300 transition-all"
        >
            <slot/>
        </button>
</template>
