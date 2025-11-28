<template>
    <AppLayout :title="__('Dashboard')">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <SearchSection class="w-full"/>
                    <PropertyStats :stats="usePage().props.property_stats" class="w-full mt-8"/>

                    <FlashMessage
                        class="mt-8"
                        v-if="$page.props.user.type === 'agent' && $page.props.unpublished_listings_count > 0">{{__("You have")}}
                        {{ $page.props.unpublished_listings_count }} <span
                            v-if="$page.props.unpublished_listings_count > 1">{{ __("properties currently unpublished. Please visit 'My Properties' to make changes")}}.</span><span
                            v-else>property currently unpublished. Please visit My Properties to make changes.</span>
                    </FlashMessage>

                    <!-- Available properties for agents to submit interest -->
                    <FlashMessage
                        v-if="$page.props.user.type === 'agent' && $page.props.available_count > 0"
                    class="mt-8">
                        {{__("There are") }} {{ $page.props.available_count}} {{ __("properties available that require an agent.")}}
                        <a :href="route('listing.index', {filter: 'available'})" class="font-semibold">{{__("Click here to view")}}</a>
                    </FlashMessage>
                    <template v-if="usePage().props.recently_viewed.data.length > 0">
                        <!-- recently viewed -->
                        <span class="text-2xl mt-8 inline-flex"><SearchIcon
                            class="w-5 h-8 mr-4"/> {{ __('My previously viewed properties') }}</span>

                        <div class="mx-auto mt-4 grid gap-5 md:grid-cols-2 xl:grid-cols-3">

                            <ListingSmall v-for="listing in usePage().props.recently_viewed.data" :listing="listing"/>
                        </div>
                    </template>

                    <template v-if="usePage().props.favourite_properties.data.length > 0">
                        <span class="text-2xl mt-8 inline-flex"><SavedHeartIcon
                            class="w-5 h-8 mr-4"/> {{ __('My saved properties') }}</span>

                        <div class="mx-auto mt-4 grid gap-5 md:grid-cols-2 xl:grid-cols-3">

                            <ListingSmall v-for="listing in usePage().props.favourite_properties.data"
                                          :listing="listing"/>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import SearchSection from "@/Pages/Dashboard/Partials/SearchSection.vue";
import PropertyStats from "@/Pages/Dashboard/Partials/PropertyStats.vue";
import {usePage} from "@inertiajs/vue3";
import ListingSmall from "@/Pages/Listing/partials/ListingSmall.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import SearchIcon from "@/Components/Icons/SearchIcon.vue";
import HeartIcon from "@/Components/Icons/HeartIcon.vue";
import SavedHeartIcon from "@/Components/Icons/SavedHeartIcon.vue";
import FlashMessage from "@/Components/FlashMessage.vue";

const {__} = useTranslate()
</script>

