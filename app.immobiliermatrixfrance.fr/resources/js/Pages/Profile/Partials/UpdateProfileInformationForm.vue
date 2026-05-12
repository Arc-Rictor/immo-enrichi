<script setup>
import {ref} from 'vue';
import {Link, router, useForm} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useTranslate} from "@/Composables/useTranslate.js";
import SelectInput from "@/Components/SelectInput.vue";

const {__} = useTranslate()
const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    telephone: props.user.telephone,
    address_line_one: props.user.address_line_one,
    address_line_two: props.user.address_line_two,
    postcode: props.user.postcode,
    city: props.user.city,
    country: props.user.country,
    province: props.user.province,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            {{ __('Profile Information') }}
        </template>

        <template #description>
            {{ __("Update your account's profile information and email address") }}.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" :value="__('Photo')"/>

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    {{ __('Select A New Photo') }}
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    {{ __('Remove Photo') }}
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2"/>
            </div>

            <!-- First name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="first_name" :value="__('First Name')"/>
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="first_name"
                />
                <InputError :message="form.errors.first_name" class="mt-2"/>
            </div>
            <!-- Last name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="last_name" :value="__('Last Name')"/>
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="last_name"
                />
                <InputError :message="form.errors.last_name" class="mt-2"/>
            </div>
            <!-- Telephone -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="telephone" :value="__('Telephone')"/>
                <TextInput
                    id="telephone"
                    v-model="form.telephone"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="telephone"
                />
                <InputError :message="form.errors.telephone" class="mt-2"/>
            </div>

            <!-- Address Line One -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="address_line_one" :value="__('Address Line 1')"/>
                <TextInput
                    id="address_line_one"
                    v-model="form.address_line_one"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="address_line_one"
                />
                <InputError :message="form.errors.address_line_one" class="mt-2"/>
            </div>
            <!-- Address Line Two -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="address_line_two" :value="__('Address Line 2')"/>
                <TextInput
                    id="address_line_two"
                    v-model="form.address_line_two"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="address_line_two"
                />
                <InputError :message="form.errors.address_line_two" class="mt-2"/>
            </div>

            <!-- Postcode -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="postcode" :value="__('Postcode')"/>
                <TextInput
                    id="postcode"
                    v-model="form.postcode"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="postcode"
                />
                <InputError :message="form.errors.postcode" class="mt-2"/>
            </div>

            <!-- City -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="city" :value="__('City')"/>
                <TextInput
                    id="city"
                    v-model="form.city"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="city"
                />
                <InputError :message="form.errors.city" class="mt-2"/>
            </div>

            <!-- Province -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="province" :value="__('Province')"/>
                <TextInput
                    id="province"
                    v-model="form.province"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="province"
                />
                <InputError :message="form.errors.province" class="mt-2"/>
            </div>

            <!-- Country -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="country"
                            class="mt-2">
                    {{ __('Country') }}
                </InputLabel>
                <div class="mt-1 h-[65px] block w-full">
                    <SelectInput
                        id="country"
                        height="h-[65px] w-full"
                        name="country"
                        v-model="form.country"
                    >
                        <option value="france">France</option>
                    </SelectInput>
                    <InputError :message="form.errors.country" class="mt-2"/>
                </div>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" :value="__('Email address')"/>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2"/>

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified') }}.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            @click.prevent="sendEmailVerification"
                        >
                            {{ __('Click here to re-send the verification email') }}.
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address') }}.
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                {{ __('Saved') }}.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ __('Save') }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
