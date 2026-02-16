<template>
    <div
         :key="listing.reference" class="flex flex-col overflow-hidden rounded-lg shadow-lg">
        <div class="flex-shrink-0 cursor-pointer relative" @click="$inertia.visit(route('listing.show', listing.reference))">
            <img v-if="listing.featured_image" class="h-48 w-full object-cover " :src="listing.featured_image" alt=""/>
            <div class="relative" v-if="!listing.featured_image">
                <img class="h-48 w-full object-cover" src="/images/no-image.jpg">

                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-white font-bold bg-black bg-opacity-50 p-2 rounded">
                        Images coming soon
                    </span>
                </div>
            </div>
            <div class="absolute top-[25px] right-[25px]" style="z-index: 999">
                <span v-if="listing.status === 'published'" class="p-2 rounded-lg w-[20px] bg-green-500 text-white">Published</span>
                <span v-if="listing.status !== 'published'" class="p-2 rounded-lg w-[20px] bg-orange-500 text-white">Unpublished</span>

            </div>

        </div>
        <div class="flex flex-1 flex-col justify-between bg-black p-6">
            <div class="flex-1">
                <div class="text-xl font-medium flex justify-between">
                    <div class="text-[#FF7C39] cursor-pointer" @click="$inertia.visit(route('listing.show', listing.reference))">€ {{ listing.asking_price }}</div>
                    <div class="text-white text-sm underline"><Link class="inline-flex items-center" :href="route('listing.edit', listing.reference)"><PencilIcon class="w-3 h-3 mr-1.5 underline"/> {{ __('Edit') }}</Link></div>
                </div>
                <div class="mt-2 block cursor-pointer" @click="$inertia.visit(route('listing.show', listing.reference))">
                    <p class="text-xl font-medium text-white">{{ listing.property_type }} {{ __('in').toLowerCase() }} {{ listing.city }}</p>
                    <p class="mt-3 text-sm text-gray-500">{{ listing.address_line_one }}, {{ listing.city }},
                        {{ listing.postcode }}, {{ listing.province }}, {{ listing.country }}...</p>
                </div>
            </div>
            <div class="mt-6 flex items-center" @click="$inertia.visit(route('listing.show', listing.reference))">
                <div class="flex-shrink-0 w-full">
                    <div class="flex">
                        <div class="my-4 flex text-sm justify-between text-white w-full">
                            <div class="inline-flex items-center gap-2">
                                <BedIcon colour="light" class="w-4 h-3 text-white bg-white"/>
                                {{ listing.bedrooms }} {{ __('Beds') }}
                            </div>
                            <div class="inline-flex items-center gap-2">
                                <BathIcon colour="light" class="w-4 h-3"/>
                                {{ listing.bathrooms }} {{ __('Baths') }}
                            </div>
                            <div class="inline-flex items-center gap-2">
                                <LandIcon colour="light" class="w-3 h-3"/>
                                {{ listing.property_size }}&#13217;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import BedIcon from "@/Components/Icons/BedIcon.vue";
import BathIcon from "@/Components/Icons/BathIcon.vue";
import LandIcon from "@/Components/Icons/LandIcon.vue";
import {Link} from "@inertiajs/vue3"
import {PencilIcon} from "@heroicons/vue/20/solid/index.js";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
defineProps({
    listing: Object,
    editable: {
        type: Boolean,
        default: false
    }
})
</script>
