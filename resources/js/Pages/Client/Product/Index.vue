<script setup>
import ShopLayout from "@/Layouts/ShopLayout.vue";
import PrimaryBtn from "@/Components/Buttons/PrimaryBtn.vue";

// import { useCartStore } from "@/Store/useCartStore";

// const cartStore = useCartStore();

const props = defineProps(["product"]);
</script>
<template>
    <Head title="Product" />

    <ShopLayout>
        <div class="flex items-center justify-center bg-gray-100">
            <div class="mx-auto">
            <div class="grid grid-cols-2 gap-4 rounded-lg bg-white p-4">

                <div class="relative">
                    <img
                        class="w-full rounded-lg object-cover object-center"
                        :src="product.image"
                        :alt="product.title"
                    >
                        <div class="absolute top-2 right-2">{{product.sticker.title.toUpperCase()}}</div>
                    </img>
                </div>

                <div class="flex flex-col">
                    <div class="space-y-4">
                    <p class="text-2xl font-bold ">{{ product.title }}</p>
                    <p class=" text-xl font-semibold text-gray-800">${{ product.price }}</p>
                    <!-- <div class="mb-2">
                        <v-slide-group show-arrows>
                            <v-slide-group-item
                                v-for="subProduct in product.product_group"
                                :key="subProduct.id"
                                v-slot="{ toggle, selectedClass }"
                            >
                                <div class="mx-1">
                                    <v-card :class="[selectedClass]">
                                        <v-img
                                            :src="subProduct.image"
                                            alt="Card Image"
                                            width="70"
                                            cover
                                            @click="toggle"
                                        />
                                    </v-card>
                                </div>
                            </v-slide-group-item>
                        </v-slide-group>
                    </div> -->
                    <div class="flex overflow-hidden">
                        <div v-for="size in product.sizes">
                            <div v-if="size.count > 0" class="mr-1">
                                <PrimaryBtn class="w-12">
                                    {{ size.title }}
                                </PrimaryBtn>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        {{ product.description }}
                    </div>
                </div>
                    <PrimaryBtn
                        class="mt-auto"
                        @click.stop="cartStore.add(product)"
                    >
                        Add to cart
                    </PrimaryBtn>
                </div>
            </div>
            <div class="mt-4">
                <Chip v-for="tag in product.tags" class="mr-2">{{
                    tag.title
                }}</Chip>
            </div>
        </div>
        </div>
    </ShopLayout>
</template>
<style scoped></style>
