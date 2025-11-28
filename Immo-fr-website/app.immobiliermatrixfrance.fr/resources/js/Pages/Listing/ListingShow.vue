<template>
    <AppLayout :title="__('Viewing property') + ' ' + usePage().props.title">

        <div class="grid grid-cols-12 2xl:gap-12">
            <div class="col-span-12 2xl:col-span-8">
                <FlashMessage class="mb-4" v-if="$page.props.flash.message">{{ $page.props.flash.message }}</FlashMessage>
                <div class="flex w-full justify-between grid grid-cols-3 gap-4">

                    <h1 class="text-2xl font-medium col-span-2">
                        {{ props.listing.data.bedrooms }} {{ __('Bedroom') }}
                        {{ __(props.listing.data.property_type) }},
                        {{ props.listing.data.city }}, {{ props.listing.data.province }}, {{
                            props.listing.data.country
                        }}
                    </h1>
                    <span class="text-xl col-span-1 text-right">
                        € {{ props.listing.data.asking_price }}
                    </span>
                </div>

                <div class="flex w-full justify-between">
                    <div>
                        <div class="space-x-4 my-4">
                            <div class="inline-flex items-center gap-2">
                                <BedIcon colour="dark" class="w-4 h-3 text-gray-900 bg-gray-800"/>
                                {{ props.listing.data.bedrooms }} {{ __('Beds') }}
                            </div>
                            <div class="inline-flex items-center gap-2">
                                <BathIcon colour="dark" class="w-4 h-3"/>
                                {{ props.listing.data.bathrooms }} {{ __('Baths') }}
                            </div>
                            <div class="inline-flex items-center gap-2">
                                <LandIcon colour="#fffff" class="w-3 h-3"/>
                                {{ props.listing.data.property_size }} &#13217;
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" @click.prevent="router.post(route('favourite-listing'), {listing: props.listing.data.id})">
                            <HeartIcon v-if="!props.listing.data.user_favourited" class="h-12" />
                            <HeartFilledIcon v-else class="h-12" />
                        </button>
                    </div>

                </div>

                <div>
                    <div class="col-span-5">
                        <template v-if="selectedImage">
                        <img class="w-full" :srcset="selectedImage.original_url"/>
                        <div class="grid grid-cols-6 py-4 gap-2">
                            <img @click="selectedImage = img" v-for="img in images"
                                 class="w-full rounded-lg gap-4 hover:cursor-pointer"
                                 :srcset="img.original_url"/>
                        </div>
                        </template>

                        <div class="relative pt-4 pb-6 rounded-lg" v-if="!selectedImage">
                            <img v-if="!listing.featured_image" class=" w-full object-cover rounded-lg" src="/images/no-image.jpg">

                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white font-bold bg-black bg-opacity-50 p-2 rounded">
                                    Images coming soon
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm">{{ __('Property type') }}</p>
                        <p class="text-lg">{{ listing.data.property_type }}</p>
                    </div>
                    <div>
                        <p class="text-sm">{{ __('Property size') }}</p>
                        <p class="text-lg">{{ listing.data.property_size }}&#13217;</p>
                    </div>
                    <div>
                        <p class="text-sm">{{ __('Land size') }}</p>
                        <p class="text-lg">{{ listing.data.land_size }}&#13217;</p>
                    </div>
                    <div>
                        <p class="text-sm">{{ __('Property reference') }}: 1234567</p>
                    </div>
                </div>
                <div class="my-4">

                    <Tabs :tabs="tabs" :active-tab="activeTab" @update="(e) => {activeTab = e}">
                        <div class="py-8">
                            <Tab :active-tab="activeTab" :label="__('Description')">
                                <h2 class="text-xl font-medium mb-4">{{ __('Key Information') }}</h2>
                                <div>{{ __('Type') }}: Residential (Château, Country House, Maison de Maître, Manoir /
                                    Manor
                                    House),
                                    Maison Ancienne, Maison Bourgeoise, Detached
                                </div>
                                <div class="space-x-4">
                                    <span>
                                        {{ __('Bedrooms') }}: {{ props.listing.data.bedrooms }}
                                    </span>
                                    <span>
                                        {{ __('Habitable size') }}: {{ props.listing.data.property_size }}&#13217;
                                    </span>
                                    <span>
                                        {{ __('Land size') }}: {{ props.listing.data.land_size }}&#13217;
                                    </span>
                                </div>

                                <hr class="text-gray-500 px-10">

                                <div>
                                    <h2 class="text-xl font-medium">{{ __('Features') }}</h2>
                                    <ul class="list-disc list-inside my-4">
                                        <li v-for="feature in props.listing.data.features">
                                            {{ __(feature.name) }}
                                        </li>
                                    </ul>
                                </div>

                                <hr class="text-gray-500 px-10">

                                <div>
                                    <h2 class="text-xl font-medium">{{ __('Property Description') }}</h2>
                                    <div class="my-4" v-html="props.listing.data.description"></div>
                                </div>
                            </Tab>

                            <Tab :active-tab="activeTab" :label="__('Specification')">
                                <div v-html="props.listing.data.specification"></div>

                            </Tab>
                            <Tab :active-tab="activeTab" label="Map">
                                <Map id="map2" class="rounded" :locations="[{
                                 lat: parseFloat(props.listing.data.latitude),
                                 lng: parseFloat(props.listing.data.longitude),
                                 description: props.listing.data.description // Need more info for this
                    }]"/>
                            </Tab>

                            <hr class="text-gray-500 px-10 my-8">

                        </div>
                    </Tabs>

                </div>
            </div>
            <!-- right aside -->
            <div class="col-span-12 2xl:col-span-4 space-y-6 pb-10">
                <div class="rounded-3xl shadow-main-container p-8 text-center space-y-1">
                    <template v-if="props.listing.data.agent">
                        <p class="font-semibold">{{ props.listing.data.agent.name }}</p>
                        <p class="text-xs text-gray-700">
                            {{ props.listing.data.agent.address_line_one }}
                        </p>
                        <p class="text-xs text-gray-700">
                            {{ props.listing.data.agent.address_line_two }}
                        </p>
                        <p class="text-xs text-gray-700">
                            {{ props.listing.data.agent.city }}
                        </p>
                        <p class="text-xs text-gray-700">
                            {{ props.listing.data.agent.postcode }}
                        </p>
                        <p class="text-xs text-gray-700">
                            {{ props.listing.data.agent.telephone }}
                        </p>
                    </template>
                    <template v-else>
                        <p class="font-semibold text-xl mb-2">{{ props.listing.data.user.first_name }}
                            {{ props.listing.data.user.last_name }}</p>
                        <p class="pb-4">Status: Agent required</p>
                        <PrimaryButton @click="showModal = true" class="btn btn-primary" v-if="props.listing.data.user.id !== usePage().props.user.id">
                            {{ __('Submit Interest') }}
                        </PrimaryButton>
                    </template>
                </div>
                <div class="rounded-3xl">
                    <Map class="rounded-lg" :locations="[{
                        lat: parseFloat(props.listing.data.latitude),
                        lng: parseFloat(props.listing.data.longitude),
                        description: props.listing.data.description ?? '' // Need more info for this
                    }]"/>
                </div>
            </div>

            <!--            <div class="col-span-12 mb-4">-->
            <!--                    <h3 class="text-xl mb-4">Similar properties you may be interested in</h3>-->
            <!--                    <div class="mx-auto grid max-w-lg gap-5 lg:max-w-none grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">-->
            <!--                        <ListingSmall v-for="listing in props.similar_listings.data" :listing="listing"/>-->
            <!--                    </div>-->
            <!--            </div>-->
        </div>

        <dialog-modal :show="showModal" @close="showModal = false">
            <template #title>
                {{ __('Confirm interest') }}
            </template>
            <template #content>
                <p class="my-4">
                    {{
                        __('Please confirm your interest in listing this property. You may provide a message to the seller below.')
                    }}</p>
                <div class="mb-4">
                    <form>
                        <label for="message" class="block text-sm font-medium text-gray-700">
                            Message
                        </label>
                        <textarea id="message" v-model="modalForm.message" class="rounded w-full h-[100px]"/>
                    </form>
                </div>
            </template>
            <template #footer>
                <button @click="confirmAndClose"
                        class="inline-flex items-center px-4 py-2 bg-black border border-gray-300 rounded-md font-semibold text-xs text-gray-100 uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Confirm
                </button>
                <SecondaryButton class="rounded-lg" @click="showModal = false">
                    Cancel
                </SecondaryButton>
            </template>
        </dialog-modal>

    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import BedIcon from "@/Components/Icons/BedIcon.vue";
import BathIcon from "@/Components/Icons/BathIcon.vue";
import LandIcon from "@/Components/Icons/LandIcon.vue";
import {reactive, ref, watch} from "vue";
import Tabs from "@/Components/Tabs.vue";
import Tab from "@/Components/Tab.vue";
import Map from "@/Components/Map.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import HeartIcon from "@/Components/Icons/HeartIcon.vue";
import HeartFilledIcon from "@/Components/Icons/HeartFilledIcon.vue";
import FlashMessage from "@/Components/FlashMessage.vue";

const {__} = useTranslate()

const props = defineProps({
    listing: Object,
    similar_listings: Object
})

const showModal = ref(false)
const modalForm = useForm({
    listing_id: props.listing.data.id,
    agent_id: usePage().props.user.agent_id,
    message: ''
})

const confirmAndClose = () => {
    showModal.value = false

    modalForm.post(route('listing.interest.store'))
}


let obj = props.listing.data.media;

let images = Object.keys(obj).map((key) => [obj[key]]).flat()

let selectedImage = ref(images[0])

let activeTab = ref('Description')

let tabs = reactive([
    {name: 'Description', href: '#'},
    {name: 'Specification', href: '#'},
    {name: 'Map', href: '#'},
])

</script>
