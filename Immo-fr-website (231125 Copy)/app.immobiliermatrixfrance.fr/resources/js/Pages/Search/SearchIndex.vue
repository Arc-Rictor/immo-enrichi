<template>
    <AppLayout :title="__('My Properties')">
        <div class="bg-gray-100 border border-gray-200 rounded-lg p-8 mb-8">
            <div class=" mx-auto space-y-4 lg:px-10 py-4">
                <h1 class="text-xl font-semibold">{{ __('Property Search') }}</h1>
                <FormSectionInputGroup class="pt-8 space-x-4">
                    <!-- Search location -->
                    <InputLabel for="location"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('Location') }}
                    </InputLabel>
                    <div class="mt-2 col-span-10 sm:mt-0">
                        <LocationSearchInput v-model="form.location"/>
                        <InputError :message="form.errors.location"/>
                    </div>
                </FormSectionInputGroup>
                <FormSectionInputGroup class="space-x-4">

                    <!-- Search Radius -->
                    <InputLabel for="radius"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('Radius') }}
                    </InputLabel>
                    <div class="mt-2 col-span-4 sm:mt-0">
                        <SelectInput
                            id="radius"
                            height="h-[50px] w-full"
                            name="radius"
                            v-model="form.radius"
                        >
                            <option :selected="form.radius === n" v-for="n in 100" :value="n">{{ __('Within')}} {{ n }} km</option>


                        </SelectInput>
                        <InputError :message="form.errors.radius"/>
                    </div>

                    <!-- Property Type -->
                    <InputLabel for="property_type"
                                class="block col-span-2  font-medium leading-6 text-gray-900 self-center">
                        {{ __('Property Type') }}
                    </InputLabel>
                    <div class="mt-2 col-span-4 sm:mt-0">
                        <SelectInput
                            id="property_type"
                            height="h-[50px] w-full"
                            name="property_type"
                            v-model="form.property_type"
                        >
                            <option :selected="form.property_type === 'all'" value="all">{{ __('All')}}</option>
                        </SelectInput>
                        <InputError :message="form.errors.property_type"/>
                    </div>
                </FormSectionInputGroup>
                <FormSectionInputGroup class="space-x-4">
                    <!-- Price range -->
                    <InputLabel for="price_range"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('Price range') }} (€)
                    </InputLabel>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="price_min"
                            height="h-[50px] w-full"
                            name="price_min"
                            v-model="form.price_min"
                        >
                            <option :selected="form.price_min === '0'" value="0" selected="selected">No min</option>
                            <option :selected="form.price_min === '50000'" value="50000">50,000</option>
                            <option :selected="form.price_min === '60000'" value="60000">60,000</option>
                            <option :selected="form.price_min === '70000'" value="70000">70,000</option>
                            <option :selected="form.price_min === '80000'" value="80000">80,000</option>
                            <option :selected="form.price_min === '90000'" value="90000">90,000</option>
                            <option :selected="form.price_min === '100000'" value="100000">100,000</option>
                            <option :selected="form.price_min === '110000'" value="110000">110,000</option>
                            <option :selected="form.price_min === '120000'" value="120000">120,000</option>
                            <option :selected="form.price_min === '125000'" value="125000">125,000</option>
                            <option :selected="form.price_min === '130000'" value="130000">130,000</option>
                            <option :selected="form.price_min === '140000'" value="140000">140,000</option>
                            <option :selected="form.price_min === '150000'" value="150000">150,000</option>
                            <option :selected="form.price_min === '160000'" value="160000">160,000</option>
                            <option :selected="form.price_min === '170000'" value="170000">170,000</option>
                            <option :selected="form.price_min === '175000'" value="175000">175,000</option>
                            <option :selected="form.price_min === '180000'" value="180000">180,000</option>
                            <option :selected="form.price_min === '190000'" value="190000">190,000</option>
                            <option :selected="form.price_min === '200000'" value="200000">200,000</option>
                            <option :selected="form.price_min === '210000'" value="210000">210,000</option>
                            <option :selected="form.price_min === '220000'" value="220000">220,000</option>
                            <option :selected="form.price_min === '230000'" value="230000">230,000</option>
                            <option :selected="form.price_min === '240000'" value="240000">240,000</option>
                            <option :selected="form.price_min === '250000'" value="250000">250,000</option>
                            <option :selected="form.price_min === '260000'" value="260000">260,000</option>
                            <option :selected="form.price_min === '270000'" value="270000">270,000</option>
                            <option :selected="form.price_min === '280000'" value="280000">280,000</option>
                            <option :selected="form.price_min === '290000'" value="290000">290,000</option>
                            <option :selected="form.price_min === '300000'" value="300000">300,000</option>
                            <option :selected="form.price_min === '325000'" value="325000">325,000</option>
                            <option :selected="form.price_min === '350000'" value="350000">350,000</option>
                            <option :selected="form.price_min === '375000'" value="375000">375,000</option>
                            <option :selected="form.price_min === '400000'" value="400000">400,000</option>
                            <option :selected="form.price_min === '425000'" value="425000">425,000</option>
                            <option :selected="form.price_min === '450000'" value="450000">450,000</option>
                            <option :selected="form.price_min === '475000'" value="475000">475,000</option>
                            <option :selected="form.price_min === '500000'" value="500000">500,000</option>
                            <option :selected="form.price_min === '550000'" value="550000">550,000</option>
                            <option :selected="form.price_min === '600000'" value="600000">600,000</option>
                            <option :selected="form.price_min === '650000'" value="650000">650,000</option>
                            <option :selected="form.price_min === '700000'" value="700000">700,000</option>
                            <option :selected="form.price_min === '800000'" value="800000">800,000</option>
                            <option :selected="form.price_min === '900000'" value="900000">900,000</option>
                            <option :selected="form.price_min === '1000000'" value="1000000">1,000,000</option>
                            <option :selected="form.price_min === '1250000'" value="1250000">1,250,000</option>
                            <option :selected="form.price_min === '1500000'" value="1500000">1,500,000</option>
                            <option :selected="form.price_min === '1750000'" value="1750000">1,750,000</option>
                            <option :selected="form.price_min === '2000000'" value="2000000">2,000,000</option>
                            <option :selected="form.price_min === '2500000'" value="2500000">2,500,000</option>
                            <option :selected="form.price_min === '3000000'" value="3000000">3,000,000</option>
                            <option :selected="form.price_min === '4000000'" value="4000000">4,000,000</option>
                            <option :selected="form.price_min === '5000000'" value="5000000">5,000,000</option>
                            <option :selected="form.price_min === '7500000'" value="7500000">7,500,000</option>
                            <option :selected="form.price_min === '10000000'" value="10000000">10,000,000</option>
                            <option :selected="form.price_min === '15000000'" value="15000000">15,000,000</option>
                            <option :selected="form.price_min === '20000000'" value="20000000">20,000,000</option>
                            <option value="0">No min</option>
                        </SelectInput>
                        <InputError :message="form.errors.price_min"/>
                    </div>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="price_max"
                            height="h-[50px] w-full"
                            name="price_max"
                            v-model="form.price_max">
                            <option :selected="form.price_max === '0'" value="0" selected="selected">No max</option>
                            <option :selected="form.price_max === '50000'" value="50000">50,000</option>
                            <option :selected="form.price_max === '60000'" value="60000">60,000</option>
                            <option :selected="form.price_max === '70000'" value="70000">70,000</option>
                            <option :selected="form.price_max === '80000'" value="80000">80,000</option>
                            <option :selected="form.price_max === '90000'" value="90000">90,000</option>
                            <option :selected="form.price_max === '100000'" value="100000">100,000</option>
                            <option :selected="form.price_max === '110000'" value="110000">110,000</option>
                            <option :selected="form.price_max === '120000'" value="120000">120,000</option>
                            <option :selected="form.price_max === '130000'" value="130000">130,000</option>
                            <option :selected="form.price_max === '140000'" value="140000">140,000</option>
                            <option :selected="form.price_max === '150000'" value="150000">150,000</option>
                            <option :selected="form.price_max === '160000'" value="160000">160,000</option>
                            <option :selected="form.price_max === '170000'" value="170000">170,000</option>
                            <option :selected="form.price_max === '175000'" value="175000">175,000</option>
                            <option :selected="form.price_max === '180000'" value="180000">180,000</option>
                            <option :selected="form.price_max === '190000'" value="190000">190,000</option>
                            <option :selected="form.price_max === '200000'" value="200000">200,000</option>
                            <option :selected="form.price_max === '210000'" value="210000">210,000</option>
                            <option :selected="form.price_max === '220000'" value="220000">220,000</option>
                            <option :selected="form.price_max === '230000'" value="230000">230,000</option>
                            <option :selected="form.price_max === '240000'" value="240000">240,000</option>
                            <option :selected="form.price_max === '250000'" value="250000">250,000</option>
                            <option :selected="form.price_max === '260000'" value="260000">260,000</option>
                            <option :selected="form.price_max === '270000'" value="270000">270,000</option>
                            <option :selected="form.price_max === '280000'" value="280000">280,000</option>
                            <option :selected="form.price_max === '290000'" value="290000">290,000</option>
                            <option :selected="form.price_max === '300000'" value="300000">300,000</option>
                            <option :selected="form.price_max === '325000'" value="325000">325,000</option>
                            <option :selected="form.price_max === '350000'" value="350000">350,000</option>
                            <option :selected="form.price_max === '375000'" value="375000">375,000</option>
                            <option :selected="form.price_max === '400000'" value="400000">400,000</option>
                            <option :selected="form.price_max === '425000'" value="425000">425,000</option>
                            <option :selected="form.price_max === '450000'" value="450000">450,000</option>
                            <option :selected="form.price_max === '475000'" value="475000">475,000</option>
                            <option :selected="form.price_max === '500000'" value="500000">500,000</option>
                            <option :selected="form.price_max === '550000'" value="550000">550,000</option>
                            <option :selected="form.price_max === '600000'" value="600000">600,000</option>
                            <option :selected="form.price_max === '650000'" value="650000">650,000</option>
                            <option :selected="form.price_max === '700000'" value="700000">700,000</option>
                            <option :selected="form.price_max === '800000'" value="800000">800,000</option>
                            <option :selected="form.price_max === '900000'" value="900000">900,000</option>
                            <option :selected="form.price_max === '1000000'" value="1000000">1,000,000</option>
                            <option :selected="form.price_max === '1250000'" value="1250000">1,250,000</option>
                            <option :selected="form.price_max === '1500000'" value="1500000">1,500,000</option>
                            <option :selected="form.price_max === '1750000'" value="1750000">1,750,000</option>
                            <option :selected="form.price_max === '2000000'" value="2000000">2,000,000</option>
                            <option :selected="form.price_max === '2500000'" value="2500000">2,500,000</option>
                            <option :selected="form.price_max === '3000000'" value="3000000">3,000,000</option>
                            <option :selected="form.price_max === '4000000'" value="4000000">4,000,000</option>
                            <option :selected="form.price_max === '5000000'" value="5000000">5,000,000</option>
                            <option :selected="form.price_max === '7500000'" value="7500000">7,500,000</option>
                            <option :selected="form.price_max === '10000000'" value="10000000">10,000,000</option>
                            <option :selected="form.price_max === '15000000'" value="15000000">15,000,000</option>
                            <option :selected="form.price_max === '20000000'" value="20000000">20,000,000</option>
                            <option value="0">No max</option>
                        </SelectInput>
                        <InputError :message="form.errors.price_max"/>
                    </div>

                </FormSectionInputGroup>


                <FormSectionInputGroup class="space-x-4">
                    <!-- Bedrooms -->
                    <!-- Bedrooms -->
                    <InputLabel for="bedrooms"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('No. of bedrooms') }}
                    </InputLabel>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="bedrooms_min"
                            height="h-[50px] w-full"
                            name="bedrooms_min"
                            v-model="form.bedrooms_min"
                        >
                            <option :selected="form.bedrooms_min === '0'" value="0" selected="selected">No min</option>
                            <option v-for="n in 20" :value="n">{{ n }}</option>
                            <option value="0">No min</option>
                        </SelectInput>
                        <InputError :message="form.errors.property_type"/>
                    </div>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="bedrooms_max"
                            height="h-[50px] w-full"
                            name="bedrooms_max"
                            v-model="form.bedrooms_max">
                            <option :selected="form.bedrooms_max === '0'" value="0" selected="selected">No max</option>
                            <option v-for="n in 20" :value="n">{{ n }}</option>

                            <option value="0">No max</option>
                        </SelectInput>
                        <InputError :message="form.errors.bedrooms_max"/>
                    </div>
                    <!-- Bathrooms -->
                    <InputLabel for="bathrooms"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('No. of bathrooms') }}
                    </InputLabel>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="bathrooms_min"
                            height="h-[50px] w-full"
                            name="bathrooms_min"
                            v-model="form.bathrooms_min"
                        >
                            <option :selected="form.bathrooms_min === '0'" value="0" selected="selected">No min</option>
                            <option v-for="n in 20" :value="n">{{ n }}</option>
                            <option value="0">No min</option>
                        </SelectInput>
                        <InputError :message="form.errors.bathrooms_min"/>
                    </div>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="bathrooms_max"
                            height="h-[50px] w-full"
                            name="bathrooms_max"
                            v-model="form.bathrooms_max">
                            <option :selected="form.bathrooms_max === '0'" value="0" selected="selected">No max</option>
                            <option v-for="n in 20" :value="n">{{ n }}</option>

                            <option value="0">No max</option>
                        </SelectInput>
                        <InputError :message="form.errors.bathrooms_max"/>
                    </div>
                </FormSectionInputGroup>

                <!-- Living space -->
                <FormSectionInputGroup class="space-x-4">
                    <InputLabel for="property_size"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('Living space') }}
                    </InputLabel>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="property_size_min"
                            height="h-[50px] w-full"
                            name="property_size_min"
                            v-model="form.property_size_min"
                        >
                            <option :selected="form.property_size_min === 0" value=0 selected="selected">No min</option>
                            <option v-for="n in 50" :value="n * 100">{{ n * 100 }} &#13217;</option>
                            <option value="0">No min</option>
                        </SelectInput>
                        <InputError :message="form.errors.property_size_min"/>
                    </div>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="property_size_max"
                            height="h-[50px] w-full"
                            name="property_size_max"
                            v-model="form.property_size_max">
                            <option :selected="form.property_size_max === 0" value=0 selected="selected">No max</option>
                            <option v-for="n in 50" :value="n * 100">{{ n * 100 }} &#13217;</option>
                            <option value="0">No max</option>
                        </SelectInput>
                        <InputError :message="form.errors.property_size_max"/>
                    </div>

                    <!-- Land space -->
                    <InputLabel for="land"
                                class="block col-span-2 font-medium leading-6 text-gray-900 self-center">
                        {{ __('Land') }}
                    </InputLabel>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="land_size_min"
                            height="h-[50px] w-full"
                            name="land_size_min"
                            v-model="form.land_size_min"
                        >
                            <option :selected="form.land_size_min === 0" value=0 selected="selected">No min</option>
                            <option v-for="n in 50" :value="n * 100">{{ n * 100 }} &#13217;</option>
                            <option value="0">No min</option>
                        </SelectInput>
                        <InputError :message="form.errors.land_size_min"/>
                    </div>
                    <div class="mt-2 col-span-2 sm:mt-0">
                        <SelectInput
                            id="land_size_max"
                            height="h-[50px] w-full"
                            name="land_size_max"
                            v-model="form.land_size_max">
                            <option :selected="form.land_size_max === 0" value=0 selected="selected">No max</option>
                            <option v-for="n in 50" :value="n * 100">{{ n * 100 }} &#13217;</option>
                            <option value="0">No max</option>
                        </SelectInput>
                        <InputError :message="form.errors.land_size_max"/>
                    </div>
                </FormSectionInputGroup>

                <FormSectionInputGroup class="space-x-0">
                    <a href="#" class="text-sm underline col-span-12" @click.prevent="showFilters = !showFilters">
                        <span v-show="showFilters">{{ __('Hide Advanced Filters') }}</span>
                        <span v-show="!showFilters">{{ __('Show Advanced Filters') }}</span>

                    </a>
                    <!-- filters/features -->
                    <div class="pt-4 col-span-12 sm:mt-0 grid grid-cols-2 lg:grid-cols-5 gap-2" v-show="showFilters">
                        <button
                            class="px-4 py-2 border rounded-lg text-sm"
                            :class="[form.features.includes(feature) ? 'bg-[#FFA163] text-white' : 'bg-white']"
                            v-for="feature in props.filters.features"
                            @click.prevent="addFeature(feature)"
                        >
                            {{ __(feature) }}
                        </button>
                    </div>
                </FormSectionInputGroup>

                <div class="w-full text-right">
                    <PrimaryButton @click="search">{{ __('Search properties') }}</PrimaryButton>
                </div>


            </div>
        </div>
        <div class="my-8" v-if="props.listings && props.listings.data.length < 1">
            <h2 class="font-semibold text-xl">{{ props.listings.data.length }} results</h2>
            <p class="text-center">
                {{ __('There are no properties matching your search') }}
            </p>

        </div>
        <div class="grid grid-cols-12 gap-6">
            <div class="mb-8 col-span-12 2xl:col-span-9" v-if="props.listings && props.listings.data.length > 0">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl">{{ props.listings.data.length }} results</h2>
                    <div class="inline-flex items-center text-sm">
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="inline-flex w-full justify-center gap-x-1.5 bg-white px-3 py-2 text-sm font-semibold text-gray-900  ring-inset ring-gray-300 hover:bg-gray-50">
                                    <span class="text-gray-500">Sort:</span> {{ __(sort) }}
                                    <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true"/>
                                </MenuButton>
                            </div>

                            <transition enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <MenuItem>
                                            <a href="#" @click.prevent="sortListings('price', 'desc')"
                                               :class="[sort === 'Highest Price' ? 'text-gray-900' : 'text-gray-700', 'inline-flex justify-between w-full px-4 py-2 text-sm']">
                                                {{ __('Highest Price') }}
                                                <CheckIcon v-if="sort === 'Highest Price'" class="w-3 ml-2"/>
                                            </a>
                                        </MenuItem>
                                        <MenuItem>
                                            <a href="#" @click.prevent="sortListings('price', 'asc')"
                                               :class="[sort === 'Lowest Price' ? 'text-gray-900' : 'text-gray-700', 'inline-flex justify-between w-full px-4 py-2 text-sm']">
                                                {{ __('Lowest Price') }}
                                                <CheckIcon v-if="sort === 'Lowest Price'" class="w-3 ml-2"/>
                                            </a>
                                        </MenuItem>
                                        <MenuItem>
                                            <a href="#" @click.prevent="sortListings('created_at', 'desc')"
                                               :class="[sort === 'Newest Listed' ? 'text-gray-900' : 'text-gray-700', 'inline-flex justify-between w-full px-4 py-2 text-sm']">
                                                {{ __('Newest Listed') }}
                                                <CheckIcon v-if="sort === 'Newest Listed'" class="w-3 ml-2"/>
                                            </a>
                                        </MenuItem>
                                        <MenuItem>
                                            <a href="#" @click.prevent="sortListings('created_at', 'asc')"
                                               :class="[sort === 'Oldest Listed' ? 'text-gray-900' : 'text-gray-700', 'inline-flex justify-between w-full px-4 py-2 text-sm']">
                                                {{ __('Oldest Listed') }}
                                                <CheckIcon v-if="sort === 'Oldest Listed'" class="w-3 ml-2"/>
                                            </a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                        <!--                    <span class="text-gray-500 mr-2">Sort:</span>  {{ form.sort }} <ChevronDownIcon class="w-3 h-3"/>-->
                    </div>
                </div>

                <div class="mx-auto mt-8 gap-5">
                    <Listing v-for="listing in sortedListings" :key="listing.id" :listing="listing"/>
                </div>
            </div>
            <div class="hidden 2xl:block col-span-3 mb-9" v-if="props.listings && props.listings.data.length > 0">
                <SearchRadiusMap
                    v-if="props.location"
                    :location="{ lat:props.location.lat, lng: props.location.lon }"
                    :radius="form.radius"
                    class="rounded"
                />
            </div>
        </div>

    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {computed, ref} from "vue";
import FormSectionInputGroup from "@/Components/Forms/FormSectionInputGroup.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import SelectInput from "@/Components/SelectInput.vue";
import {ChevronDownIcon, CheckIcon} from "@heroicons/vue/20/solid/index.js";
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import Listing from "@/Pages/Search/partials/Listing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Loader} from '@googlemaps/js-api-loader';
import LocationSearchInput from "@/Pages/Search/partials/LocationSearchInput.vue";
import SearchRadiusMap from "@/Components/SearchRadiusMap.vue";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()

const props = defineProps({
    listings: Array,
    filters: Array,
    searchData: Array,
    location: Object
})

let form = useForm({
    location: props.searchData.location ?? '',
    radius: props.searchData.radius ?? 10,
    property_type: props.searchData.property_type ?? 'all',
    price_min: props.searchData.price_min ?? '0',
    price_max: props.searchData.price_max ?? '0',
    bedrooms_min: props.searchData.bedrooms_min ?? 0,
    bedrooms_max: props.searchData.bedrooms_max ?? 0,
    bathrooms_min: props.searchData.bathrooms_min ?? 0,
    bathrooms_max: props.searchData.bathrooms_max ?? 0,
    property_size_min: props.searchData.property_size_min ?? 0,
    property_size_max: props.searchData.property_size_max ?? 0,
    land_size_min: props.searchData.land_size_min ?? 0,
    land_size_max: props.searchData.land_size_max ?? 0,
    features: props.searchData.features ?? []

})

let showFilters = ref(form.features.length > 0)
const sort = ref('Highest Price')
const sortBy = ref('price');
const sortOrder = ref('desc');

const sortedListings = computed(() => {

    return [...props.listings.data].sort((a, b) => {
        if (sortBy.value === 'created_at') {
            const dateA = new Date(a[sortBy.value]);
            const dateB = new Date(b[sortBy.value]);
            return sortOrder.value === 'asc' ? dateA - dateB : dateB - dateA;
        }
        return sortOrder.value === 'asc' ? a[sortBy.value] - b[sortBy.value] : b[sortBy.value] - a[sortBy.value];
    });
});

function sortListings(attribute, order) {
    sortBy.value = attribute;
    sortOrder.value = order;

    if (attribute === 'price') {
        sort.value = order === 'desc' ? 'Highest Price' : 'Lowest Price'
    }

    if (attribute === 'created_at') {
        sort.value = order === 'desc' ? 'Newest Listed' : 'Oldest Listed'
    }
}
function addFeature(feature) {
    if (form.features.includes(feature)) {
        removeFeature(feature)

    } else {
        form.features.push(feature)
    }
}

function removeFeature(feature) {
    form.features = form.features.filter((item) => item !== feature);
}

function search() {
    form.get(route('property-search'), {
        only: ['listings', 'searchData'],
        preserveScroll: true,
        preserveState: true
    });
}
</script>
