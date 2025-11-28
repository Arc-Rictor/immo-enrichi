<template>
    <AppLayout title="My Properties">
        <h1 class="text-xl font-medium">{{ __('Property Listings') }}</h1>
        <div class="mt-4">
            <FlashMessage v-if="$page.props.flash.message"> {{ $page.props.flash.message }}</FlashMessage>
        </div>
        <div class="my-8">
            <Tabs :tabs="tabs" :active-tab="activeTab" @update="(e) => {activeTab = e}">
                <Tab :active-tab="activeTab" :label="__('My Listings')">
                    <div class="mx-auto mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <ListingSmallEdit v-for="listing in props.listings.data" :listing="listing"/>
                    </div>
                </Tab>

                <Tab :active-tab="activeTab" :label="__('Available Properties')">
                    <div class="mx-auto mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <ListingSmall v-for="listing in props.availableListings.data" :listing="listing"/>
                    </div>
                </Tab>

                <Tab :active-tab="activeTab" label="Agent Interest">
                    <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
                        <p class="col-span-3">
                            {{ __('Please review the list of pending interest from agents. Only one agent may be approved per property and will automatically decline all others') }}</p>
                        <table class="w-full col-span-3 divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Listing') }}
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                    {{ __('Agent') }}
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Message') }}
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                    <span class="sr-only">Approve</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr v-if="props.listingInterest.length > 0" v-for="interest in props.listingInterest" :key="interest.id" class="even:bg-gray-50">
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><span
                                    class="font-semibold">{{ interest.listing.reference }}</span>
                                    <br>
                                    {{ interest.listing.address_line_one }}, {{ interest.listing.city }}, <br>
                                    {{ interest.listing.postcode }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                        interest.agent.name
                                    }}
                                </td>
                                <td class=" py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                    {{ interest.message }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium sm:pr-6 ">
                                    <a @click.prevent="approveListingInterest(interest.id)" href="#"
                                       class="text-indigo-600 hover:text-indigo-900 mr-2"
                                    >Approve<span class="sr-only">{{ interest.listing.reference }}</span></a
                                    >
                                    <!--                                    <a href="#" class="text-red-600 hover:text-red-900"-->
                                    <!--                                    >Decline<span class="sr-only">{{ interest.listing.reference}}</span></a-->
                                    <!--                                    >-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </Tab>
            </Tabs>
        </div>

    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {onMounted, reactive, ref} from "vue";
import Tabs from "@/Components/Tabs.vue";
import Tab from "@/Components/Tab.vue";
import ListingSmall from "@/Pages/Listing/partials/ListingSmall.vue";
import ListingSmallEdit from "@/Pages/Listing/partials/ListingSmallEdit.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import {router, usePage} from "@inertiajs/vue3";
import {Link} from '@inertiajs/vue3'
import FlashMessage from "@/Components/FlashMessage.vue";

const {__} = useTranslate()
const props = defineProps({
    listings: Object,
    availableListings: Object,
    listingInterest: Object
})

let tabs = reactive([
    {name: __('My Listings'), href: ''},
    {name: __('Available Properties'), href: ''}
])

if (usePage().props.user.type === 'seller') {
    tabs = [
        {name: __('My Listings'), href: ''},
        {name: __('Agent Interest'), href: ''}
    ]
}

let activeTab = ref(__('My Listings'))

const params = new URLSearchParams(window.location.search)
    console.log(params.get('filter'))
    if (params.has('filter') && params.get('filter')  === 'available') {
        console.log(true)
        activeTab.value = __('Available Properties')
    } else {
        activeTab.value = __('My Listings')
    }


const approveListingInterest = (listing) => {
    router.post(route('listing-interest.approve', {interest: listing}))
}

</script>
