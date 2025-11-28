<template>
    <div
        :key="listing.reference" class="flex overflow-hidden mb-6 rounded-lg shadow-lg">
        <div class="w-1/2 flex cursor-pointer relative"
             @click="$inertia.visit(route('listing.show', listing.reference))">
            <img class=" w-full object-cover " :src="listing.featured_image" alt=""/>

            <div class="absolute top-[20px] right-[20px] space-x-4">
                <!-- Featured listing badge -->
                <span v-if="listing.is_featured"
                      class="inline-flex items-center gap-x-1.5 rounded-lg bg-[#6236FF] px-2 py-1 text-xs font-medium text-white">
                    <svg class="h-2 w-2 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
                        <circle cx="3" cy="3" r="3"/>
                    </svg>
                    {{ __('Featured Listing') }}
                </span>
                <!-- New listing badge -->
                <span v-if="listing.is_new"
                      class="inline-flex items-center gap-x-1.5 rounded-lg bg-[#6236FF] px-2 py-1 text-xs font-medium text-white">
                    <svg class="h-2 w-2 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
                        <circle cx="3" cy="3" r="3"/>
                    </svg>
                   {{ __('New Listing') }}
                </span>
            </div>
            <div class="absolute bottom-[20px] left-[20px] space-x-4">
                                <span v-if="listing.is_new"
                                      class="inline-flex items-center gap-x-1.5 rounded-full bg-black px-2 py-1 text-xs font-medium text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-white p-0.5">
                                        {{ listing.views }}
                                    </span>
                                </span>

            </div>

            <div class="absolute top-[20px] left-[20px] space-x-4">
                                <span v-if="listing.is_new"
                                      class="inline-flex items-center gap-x-1.5 rounded-full bg-black px-2 py-1 text-xs font-medium text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/>
                                    </svg>

                                    <span class="text-white p-0.5">
                                        {{ listing.image_count }}
                                    </span>
                                </span>

            </div>

        </div>
        <div class="w-1/2 bg-black p-6">
            <div class="w-full">
                <div class="mt-2 block cursor-pointer"
                     @click="$inertia.visit(route('listing.show', listing.reference))">
                    <p class="text-xl font-medium text-white">{{ __(listing.property_type) }} {{ __('in').toLowerCase() }} {{ listing.city }}</p>
                    <p class="mt-3 text-sm text-gray-500">{{ listing.address_line_one }}, {{ listing.city }},
                        {{ listing.postcode }}, {{ listing.province }}</p>
                </div>
            </div>
            <div class="mt-2 flex items-center" @click="$inertia.visit(route('listing.show', listing.reference))">
                <div class="flex-shrink-0 w-3/4 xl:w-1/2">
                    <div class="flex">
                        <div class="mt-4 flex text-sm justify-between text-white w-full">
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

            <div class="flex items-center" @click="$inertia.visit(route('listing.show', listing.reference))">
                <div class="flex-shrink-0 w-full text-[14px] text-gray-200 line-clamp-4 py-6">
                   {{ listing.description }}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">
                        <!--                                            <a :href="post.author.href" class="hover:underline">{{ post.author.name }}</a>-->
                    </p>
                    <div class="flex space-x-1 text-sm text-gray-500">
                        <!--                                            <time :datetime="post.datetime">{{ post.date }}</time>-->
                        <span aria-hidden="true">&middot;</span>
                    </div>
                </div>
            </div>

            <div class="text-xl font-medium w-full flex justify-between mt-3 bottom-0">
                <div class="text-white text-sm relative w-1/2">
                    <span class="inline-block absolute bottom-0 left-0 w-full">{{ __('Distance') }}: {{ listing.distance.toFixed() }}km</span>
                </div>
                <div>
                    <div class="hover:underline text-[#FF7C39] cursor-pointer"
                         @click="$inertia.visit(route('listing.show', listing.reference))">€ {{ listing.asking_price }}
                    </div>
                    <div class="text-[#FF7C39] text-xs">{{ __('Guide price') }}</div>
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
