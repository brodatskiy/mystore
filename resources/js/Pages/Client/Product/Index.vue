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
        <div class="pa-2" rounded="xl">
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <img
                        class="w-full h-auto object-cover"
                        :src="product.image"
                    >
                        <div class="absolute top-2 right-2">
                            {{
                                product.sticker.title.toUpperCase()
                            }}
                        </div>
                    </img>
                </div>

                <div class="flex flex-col">
                    <div class="mb-2">{{ product.title }}</div>
                    <div class="mb-2">{{ product.price }} $</div>
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
                    <div class="flex mb-2 overflow-hidden">
                        <div v-for="size in product.sizes">
                            <div v-if="size.count > 0" class="mr-1">
                                <PrimaryBtn>
                                    {{ size.title }}
                                </PrimaryBtn>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        {{ product.description }}
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
    </ShopLayout>
</template>
<style scoped></style>
