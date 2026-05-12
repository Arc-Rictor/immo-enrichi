<template>
    <AppLayout title="List a property">

        <div class="py-12">
            <div class="max-w-7xl mx-auto">
                <Tabs :tabs="tabs" :active-tab="activeTab" @update="(e) => {activeTab = e}">

                    <div class="py-8">
                        <Tab :active-tab="activeTab" :label="__('List a property')">
                            <div class="overflow-hidden">
                                <form @submit.prevent="form.post(route('listing.store'), {
    forceFormData: true
})" method="POST" enctype="multipart/form-data">
                                    <FormSectionTwoColumns>
                                        <template #title>{{ __('Property location details') }}</template>
                                        <FormSectionInputGroup class="md:pr-2">
                                            <InputLabel for="address_line_one"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('Address line 1') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="address_line_one"
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="address_line_one"
                                                    v-model="form.address_line_one"
                                                />
                                                <InputError :message="form.errors.address_line_one"/>
                                            </div>
                                        </FormSectionInputGroup>

                                        <FormSectionInputGroup class="md:pr-2">
                                            <InputLabel for="city"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('City/Town') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="city"
                                                    v-model="form.city"
                                                />
                                                <InputError :message="form.errors.city"/>

                                            </div>
                                        </FormSectionInputGroup>
                                        <FormSectionInputGroup class="md:pl-2">
                                            <InputLabel for="province"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('County') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="province"
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="province"
                                                    v-model="form.province"
                                                />
                                                <InputError :message="form.errors.province"/>

                                            </div>
                                        </FormSectionInputGroup>
                                        <FormSectionInputGroup class="md:pr-2">
                                            <InputLabel for="postcode"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('Postcode') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="postcode"
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="postcode"
                                                    v-model="form.postcode"
                                                />
                                                <InputError :message="form.errors.postcode"/>

                                            </div>
                                        </FormSectionInputGroup>

                                        <FormSectionInputGroup class="md:pl-2">
                                            <InputLabel for="country"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('Country') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                
<p>France</p>

                                            </div>
                                        </FormSectionInputGroup>

                                    </FormSectionTwoColumns>

                                    <FormSectionDivider/>

                                    <FormSectionTwoColumns>
                                        <template #title>
                                            {{ __('Property details and specification') }}
                                        </template>

                                        <FormSectionInputGroup class="md:pr-2">
                                            <InputLabel for="property_type"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('Property type') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="property_type"
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="property_type"
                                                    :placeholder="__('Enter property type')"
                                                    v-model="form.property_type"
                                                />
                                                <InputError :message="form.errors.property_type"/>

                                            </div>
                                        </FormSectionInputGroup>

                                        <FormSectionInputGroup class="md:pl-2">
                                            <InputLabel for="property_size"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ ('Property size') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="property_size"
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="property_size"
                                                    :placeholder="__('Enter property size')"
                                                    v-model="form.property_size"
                                                />
                                                <InputError :message="form.errors.property_size"/>

                                            </div>
                                        </FormSectionInputGroup>

                                        <FormSectionInputGroup class="md:pr-2">
                                            <InputLabel for="land_size"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('Land size') }}
                                            </InputLabel>
                                            <div class="mt-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="land_size"
                                                    height="h-[50px] w-full"
                                                    type="text"
                                                    name="land_size"
                                                    :placeholder="__('Enter land size')"
                                                    v-model="form.land_size"
                                                />
                                                <InputError :message="form.errors.land_size"/>

                                            </div>
                                        </FormSectionInputGroup>
                                        <FormSectionInputGroup class="md:pl-2">
                                            <InputLabel for="bedrooms"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('No. of bedrooms') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <SelectInput
                                                    id="bedrooms"
                                                    height="h-[50px] w-full"
                                                    v-model="form.bedrooms"
                                                >
                                                    <option>{{ __('Select bedrooms') }}</option>
                                                    <option v-for="n in 20" :value="n">{{ n }}</option>
                                                </SelectInput>
                                                <InputError :message="form.errors.bedrooms"/>

                                            </div>
                                        </FormSectionInputGroup>

                                        <FormSectionInputGroup class="md:pr-2">
                                            <InputLabel for="bathrooms"
                                                        class="block sm:col-span-4 col-span-2 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('No. of bathrooms') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <SelectInput
                                                    id="bathrooms"
                                                    height="h-[50px] w-full"
                                                    v-model="form.bathrooms"
                                                >
                                                    <option>{{ __('Select bathrooms') }}</option>
                                                    <option v-for="n in 20" :value="n">{{ n }}</option>
                                                </SelectInput>
                                                <InputError :message="form.errors.bathrooms"/>

                                            </div>
                                        </FormSectionInputGroup>

                                        <FormSectionInputGroup class="md:pl-2">
                                            <InputLabel for="asking_price"
                                                        class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                                {{ __('Asking price') }}
                                            </InputLabel>
                                            <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                                <TextInput
                                                    id="asking_price"
                                                    height="h-[50px] w-full"
                                                    type="number"
                                                    placeholder=""
                                                    name="asking_price"
                                                    v-model="form.asking_price"
                                                />
                                                <InputError :message="form.errors.asking_price"/>

                                            </div>
                                        </FormSectionInputGroup>
                                    </FormSectionTwoColumns>

                                    <FormSectionDivider/>

                                    <FormSectionTwoColumns>
                                        <template #title>
                                            {{ __('Features') }}
                                        </template>
                                        <template #action>
                                            ({{ selectedFeatures }}) {{ __('features selected') }}
                                        </template>
                                        <div
                                            class="mt-2 col-span-2 sm:col-span-8 sm:mt-0 grid grid-cols-2 xl:grid-cols-5">
                                            <button
                                                class="px-4 py-2 border rounded-lg m-1 text-sm md:text-base"
                                                :class="[form.features.includes(feature) ? 'bg-black text-white' : 'bg-white']"
                                                v-for="feature in features"
                                                @click.prevent="addFeature(feature)"
                                            >
                                                {{ __(feature) }}
                                            </button>
                                        </div>
                                    </FormSectionTwoColumns>

                                    <div class="block md:inline-flex w-full md:w-2/3 px-2 md:px-10 md:space-x-4 mt-6">
                                        <InputLabel for="asking_price"
                                                    class="font-medium w-full leading-6 text-gray-900 self-center">
                                            {{ __('Add new feature') }}
                                        </InputLabel>
                                        <div class="space-x-2 inline-flex">
                                            <TextInput
                                                id="add_feature"
                                                height="h-[50px] ml-0"
                                                type="text"
                                                placeholder=""
                                                class=" md:w-[330px]"
                                                v-model="newFeature"
                                            />
                                            <button @click.prevent="addFeature(newFeature); newFeature = ''"
                                                    class="bg-black text-white px-6 py-2 rounded-xl h-[50px]">
                                                {{ __('Add') }}

                                            </button>
                                        </div>
                                    </div>
                                    <template
                                        v-if="usePage().props.user.type === 'agent' || usePage().props.user.type === 'admin'">

                                        <FormSectionDivider/>

                                        <FormSectionTwoColumns>
                                            <template #title>
                                                {{ __('Property description') }}

                                            </template>
                                            <div class="mt-6 col-span-2 sm:col-span-8 sm:mt-0">

                                                <TextAreaInput
                                                    class="w-full min-h-[300px] -mt-4 p-4 text-lg"
                                                    v-model="form.description"
                                                    :placeholder="__('Enter your property description here')"
                                                />
                                                <InputError :message="form.errors.description"/>

                                            </div>
                                        </FormSectionTwoColumns>

                                        <FormSectionDivider/>

                                        <FormSectionTwoColumns>
                                            <template #title>
                                                {{ __('Specification') }}
                                            </template>
                                            <div class="mt-6 col-span-2 sm:col-span-8 sm:mt-0">

                                                <TextAreaInput
                                                    class="w-full min-h-[300px] -mt-4 p-4 text-lg"
                                                    v-model="form.specification"
                                                    :placeholder="__('Enter your property specification here')"
                                                />
                                                <InputError :message="form.errors.specification"/>

                                            </div>
                                        </FormSectionTwoColumns>
                                    </template>

                                    <FormSectionDivider/>

                                    <!--                                    <FormSectionTwoColumns>-->
                                    <!--                                        <template #title>-->
                                    <!--                                            {{ __('Photo upload') }}-->
                                    <!--                                        </template>-->
                                    <!--                                        <div class="col-span-2  sm:col-span-8 sm:mt-0">-->
                                    <!--                                            <MediaLibraryCollection/>-->
                                    <!--                                        </div>-->
                                    <!--                                    </FormSectionTwoColumns>-->
<FormSectionDivider/>
<!--
<FormSectionTwoColumns class="photo-upload-section">
    <template #title>
        {{ __('Photo upload') }}
    </template>
    <div class="col-span-2 sm:col-span-8 sm:mt-0">
        <h2 style="color: red; font-size: 24px;">PHOTO UPLOAD SECTION</h2>
        <input
            type="file"
            id="photos"
            multiple
            @input="form.photos = $event.target.files"
            accept="image/*"
        />
        <p>{{ __('You can upload up to 10 photos.') }}</p>
        <InputError :message="form.errors.photos" />
    </div>
</FormSectionTwoColumns>
-->
                                        <h2>{{ __('Save property details by pressing the button below. You can then add photos by editing your property from the my properties page') }}</h2>
                                    <div class="px-10 my-8">
                                        <PrimaryButton>{{ __('Submit property') }}</PrimaryButton>
                                    </div>

                                </form>

                            </div>
                        </Tab>
                        <Tab v-if="$page.props.user.type === 'agent'" :active-tab="activeTab"
                             :label="__('List multiple properties')">
                            <div>
                                <p class="my-4">
                                    {{ __('To upload multiple property listings simply follow the steps below') }}. </p>

                                <div class="mt-6 p-8 bg-[#FFF0EA] rounded-xl flex">
                                    <div>
                                       <span
                                           class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-700">
                                           <span class="font-semibold leading-none">1</span>
                                       </span>
                                    </div>
                                    <div class="p-1 ml-4">
                                        <p class="font-extrabold text-xl">{{
                                                __('Download Property Listing Template')
                                            }}</p>
                                        <p class="text-sm mt-4 mb-8">
                                            {{
                                                __("To upload multiple property listings, download our listings template below and fill out for each property you wish to list, then save the file")
                                            }}.</p>
                                        <a href="/download-template"
                                           class="inline-flex w-[285px] h-[55px] text-lg items-center font-medium px-4 py-2 bg-black border border-transparent rounded-full text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <ArrowDownTrayIcon class="w-5 h-5 mr-3"/>
                                            {{ __('Download template') }}
                                        </a>
                                    </div>
                                </div>

                                <div class="mt-6 p-8 rounded-xl flex w-full">
                                    <div>
                                       <span
                                           class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-700">
                                           <span class="font-semibold leading-none">2</span>
                                       </span>
                                    </div>
                                    <div class="p-1 ml-4 w-full">
                                        <p class="font-extrabold text-xl">{{
                                                __('Upload your file')
                                            }}</p>
                                        <p class="text-sm mt-4 mb-8">
                                            {{
                                                __("Once you have inputted the details for each listing into the template, save your changes and upload here")
                                            }}.</p>
                                        <p class="pb-2">{{ __('File upload') }}</p>
                                        <MediaLibraryAttachment @change="onChange" :translations="{
                                            selectOrDragMax: __('Select or drag a maximum of 1 file'),
                                        }"/>

                                        <PrimaryButton class="w-[230px] my-8" @click="upload">
                                            {{ __('Submit properties') }}
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </div>
                        </Tab>
                    </div>
                </Tabs>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import FormSectionTwoColumns from "@/Components/Forms/FormSectionTwoColumns.vue";
import FormSectionDivider from "@/Components/Forms/FormSectionDivider.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FormSectionInputGroup from "@/Components/Forms/FormSectionInputGroup.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import {MediaLibraryAttachment} from "spatie-media-lib-pro/media-library-pro-vue3-attachment"
import {reactive, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import Tabs from "@/Components/Tabs.vue";
import Tab from "@/Components/Tab.vue";
import {ArrowDownTrayIcon} from "@heroicons/vue/20/solid/index.js";

const {__} = useTranslate()
const form = useForm({
    address_line_one: '',
    address_line_two: '',
    city: '',
    province: '',
    postcode: '',
    country: 'France',
    property_type: '',
    property_size: '',
    land_size: '',
    bedrooms: '',
    bathrooms: '',
    asking_price: 0,
    description: '',
    specification: '',
    features: [],
photos: []
})
let features = reactive(usePage().props.features.data.map((item) => {
    return item.name;
}));
let uploadForm = useForm({
    file: null
})
let newFeature = ref()
let selectedFeatures = ref(form.features.length);

let activeTab = ref(__('List a property'))

let tabs = reactive([
    {name: __('List a property'), href: '#'},
])

// If user is an agent push the multiple properties tab
if (usePage().props.user.type === 'agent') {
    tabs.push({name: __('List multiple properties'), href: '#'})
}

function addFeature(feature) {
    if (form.features.includes(feature)) {
        removeFeature(feature)
        selectedFeatures.value = form.features.length

    } else {
        form.features.push(feature)
        selectedFeatures.value = form.features.length
    }

    if (!features.valueOf().includes(feature)) {
        features.valueOf().push(feature)
    }
}

function removeFeature(feature) {
    form.features = form.features.filter((item) => item !== feature);
}

const onChange = (media) => {
    uploadForm.file = media;
}

const upload = () => {
    uploadForm.post(route('listing.upload'))
}
</script>
