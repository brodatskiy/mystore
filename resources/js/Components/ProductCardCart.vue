<script setup>
import {ref} from "vue";
import {Link, router} from "@inertiajs/vue3";
import Button from "primevue/button";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

defineProps(["product"]);

const processing = ref(false);

function increase(product) {
    router.patch(route("cart.increase", {product: product}), {}, {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });

    router.reload({only: ['product']})
}

function decrease(product) {
    router.patch(route("cart.decrease", {product: product}), {}, {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });

    router.reload({only: ['product']})
}

function destroy(product) {
    router.delete(route("cart.destroy", {product: product}), {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });

    router.reload({only: ['product']})
}
</script>
<template>
    <div class="flex mb-6 rounded-lg bg-surface-50 dark:bg-surface-600 p-4 shadow-md text-black dark:text-white">
        <Link :href="route('product.show', product)">
            <img
                :src="product.image"
                alt="Card Image"
                class="w-full rounded-lg sm:w-40"
            />
        </Link>
        <div class="flex justify-between w-full px-4">
            <div class="flex flex-col space-y-2">
                <div class="flex-1">
                    <Link :href="route('product.show', product)">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ product.title }}
                        </h2>
                    </Link>
                    <p class="mt-1 text-xs text-gray-700 dark:text-gray-200">
                        {{ product.description }}
                    </p>
                </div>
                <div class="space-x-2">
                    <Button @click="destroy(product)" :class="{ 'opacity-50': processing }" severity="danger">
                        <i class="pi pi-trash"></i>
                    </Button>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="">
                    <p class="text-center">
                        ${{ product.price * product.count }}
                    </p>
                </div>
                <div class="flex">
                    <ButtonPrimary
                        class="rounded-l-md"
                        :class="{ 'opacity-50': processing }"
                        @click="decrease(product)"
                    >
                        -
                    </ButtonPrimary>
                    <button class="px-3 py-2">
                        {{ product.count }}
                    </button>
                    <ButtonPrimary
                        class="rounded-r-md"
                        :class="{ 'opacity-50': processing }"
                        @click="increase(product)"
                    >
                        +
                    </ButtonPrimary>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
