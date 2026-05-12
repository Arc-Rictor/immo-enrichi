<template>
    <AppLayout :title="__('List a property')">

        <div class="py-12">
            <div class="max-w-7xl mx-auto">
                <div class="overflow-hidden">
                    <FlashMessage class="mb-6"
                                  v-if="$page.props.user.type ==='agent' && $page.props.listing.data.status !== 'published'">
                        This property is not published. Click 'Publish listing' to allow it to appear in search results.
                    </FlashMessage>
                    <form @submit.prevent="form.patch(route('listing.update', props.listing.data.reference))"
                          method="POST">
                        <FormSectionTwoColumns>
                            <template #title>
                                {{ __('Property location details') }}
                            </template>
                            <template #action>
                                <template
                                    v-if="usePage().props.user.type === 'admin' || usePage().props.user.type === 'agent'">
                                    <button v-if="!props.listing.data.published_at"
                                            @click.prevent="router.post(route('listing.publish', props.listing.data.reference))"
                                            class="h-[55px] w-[285px] text-lg items-center font-medium px-4 py-2 bg-orange-500 border border-transparent rounded-full text-white hover:bg-orange-400 focus:outline-none focus:ring-2 transition ease-in-out duration-150">
                                        {{ __('Publish listing') }}
                                    </button>
                                    <button v-if="props.listing.data.published_at"
                                            @click.prevent="router.post(route('listing.unpublish', props.listing.data.reference))"
                                            class="h-[55px] w-[285px] text-lg items-center font-medium px-4 py-2 bg-transparent border border-orange-500 rounded-full text-orange-500 hover:text-white hover:bg-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition ease-in-out duration-150">
                                        {{ __('Unpublish listing') }}
                                    </button>
                                </template>
                                <template>
                                    <button v-if="!props.listing.data.published_at"
                                            @click.prevent="router.post(route('listing.agent-interest', props.listing.data.reference))"
                                            class="h-[55px] w-[285px] text-lg items-center font-medium px-4 py-2 bg-orange-500 border border-transparent rounded-full text-white hover:bg-orange-400 focus:outline-none focus:ring-2 transition ease-in-out duration-150">
                                        {{ __('View interested agents') }}
                                    </button>
                                </template>
                            </template>


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
                            <FormSectionInputGroup class="md:pl-2">
                                <InputLabel for="address_line_two"
                                            class="block sm:col-span-4 font-medium leading-6 text-gray-900 self-center">
                                    {{ __('Address line 2') }}
                                </InputLabel>
                                <div class="mt-2 col-span-2 sm:col-span-8 sm:mt-0">
                                    <TextInput
                                        id="address_line_two"
                                        height="h-[50px] w-full"
                                        type="text"
                                        name="address_line_two"
                                        v-model="form.address_line_two"
                                    />
                                    <InputError :message="form.errors.address_line_two"/>

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
                                    <SelectInput
                                        id="country"
                                        height="h-[50px] w-full"
                                        name="country"
                                        v-model="form.country"
                                    >
                                        <option value="France">France</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                    </SelectInput>
                                    <InputError :message="form.errors.country"/>

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
                                    {{ __('Property size') }}
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
                                        <option :selected="n === form.bedrooms" v-for="n in 20" :value="n">{{
                                                n
                                            }}
                                        </option>
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
                                        <option :selected="n === form.bathrooms" v-for="n in 20" :value="n">{{
                                                n
                                            }}
                                        </option>
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
                                        type="text"
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
                                    class="w-[330px]"
                                    v-model="newFeature"
                                />
                                <button @click.prevent="addFeature(newFeature); newFeature = ''"
                                        class="bg-black text-white px-6 py-2 rounded-xl h-[50px]">{{ __('Add') }}
                                </button>
                            </div>
                        </div>

                        <FormSectionDivider/>

                        <FormSectionTwoColumns>
                            <template #title>
                                {{ __('Property description') }}
                            </template>
                            <div class="mt-6 col-span-2 sm:col-span-8 sm:mt-0">

                                <TextAreaInput
                                    class="w-full min-h-[300px] -mt-4 p-4 text-lg"
                                    v-model="form.description"
                                    placeholder="Enter your property description here"
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

                        <FormSectionDivider/>

                        <FormSectionTwoColumns>
                            <template #title>
                                {{ __('Photo upload') }}
                            </template>
                            <div class="col-span-2  sm:col-span-8 sm:mt-0">
                                <MediaLibraryCollection
                                    name="images"
                                    :initial-value="form.media"
                                    @change="onChange"
                                    :translations="{
                                        selectOrDrag: __('Select or drag files'),
                                        download: __('Download'),
                                        remove: __('Remove')
                                    }"
                                />
                            </div>
                        </FormSectionTwoColumns>

                        <div class="px-10 my-8 flex justify-between">
                            <PrimaryButton>{{ __('Save') }}</PrimaryButton>
                        </div>

                    </form>

                </div>
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
import {MediaLibraryCollection} from "spatie-media-lib-pro/media-library-pro-vue3-collection";
import {reactive, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import FlashMessage from "@/Components/FlashMessage.vue";

const {__} = useTranslate()
const props = defineProps({
    listing: Object
})
const form = useForm({
    address_line_one: props.listing.data.address_line_one ?? '',
    address_line_two: props.listing.data.address_line_two ?? '',
    city: props.listing.data.city ?? '',
    province: props.listing.data.province ?? '',
    postcode: props.listing.data.postcode ?? '',
    country: props.listing.data.country ?? 'France',
    property_type: props.listing.data.property_type ?? '',
    property_size: props.listing.data.property_size ?? '',
    land_size: props.listing.data.land_size ?? '',
    bedrooms: props.listing.data.bedrooms ?? '',
    bathrooms: props.listing.data.bathrooms ?? '',
    asking_price: props.listing.data.asking_price ?? '',
    description: props.listing.data.description ?? '',
    specification: props.listing.data.specification ?? '',
    features: props.listing.data.features.map((item) => item.name) ?? [],
    media: props.listing.data.media ?? []
})
let features = reactive(usePage().props.features.data.map((item) => {
    return item.name;
}));
let newFeature = ref()
let selectedFeatures = ref(form.features.length);

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
    form.media = media;
}
</script>
