<template>
    <Link
        v-bind="$attrs"
        class="px-4 py-2 font-sans text-s font-bold whitespace-nowrap text-center bg-gray-100 text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/15 active:bg-gray-900/30"
    >
        <slot />
    </Link>
</template>
