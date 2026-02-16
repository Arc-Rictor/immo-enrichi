<template>
    <Head title="Complete agent registration"/>
    <div class="flex">
        <div
            class="w-[500px] min-h-screen fixed min-h-screen shrink-0 h-screen bg-[#FFA163] bg-[url('/images/agent-registration-bg.png')] bg-no-repeat bg-cover">
            <div class="mx-auto w-3/4 p-4">
                <ApplicationLogo/>
            </div>
            <div class="p-8 absolute bottom-0 left-0">
                <div class="p-10 rounded-xl bg-black text-white">
                    <p class="text-[18px] ">
                        “I was able to look for a new home and list my current property for sale, keeping track of it
                        all in one place!”.
                    </p>
                    <p class="font-bold text-sm mt-3">Richard Black</p>
                    <p class="text-sm">Paris, France</p>
                </div>
            </div>
        </div>
        <div class="py-6 px-8 w-full min-h-screen ml-[500px]">
            <!-- content -->
            <div class="w-full h-full text-center content-center">

                <!-- agent registration form -->
                <form @submit.prevent="submit">
                    <div class="w-[550px] mx-auto pt-[200px]">
                        <h1 class="leading-6 text-gray-900 text-3xl">{{ __('Complete agent account registration') }}</h1>
                        <div class="text-left mt-10 space-y-6">
                            <div>
                                <InputLabel for="agent_name" :value="__('Agency name')"/>
                                <TextInput
                                    id="agent_name"
                                    v-model="form.agent_name"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="agent_name"
                                />
                                <InputError class="text-right" :message="form.errors.agent_name"/>
                            </div>
                            <div>
                                <InputLabel for="siren" :value="__('Siret number') + '*'"/>
                                <TextInput
                                    id="siren"
                                    v-model="form.siren"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="siren"
                                />
                                <InputError class="text-right" :message="form.errors.siren"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="address_line_one" :value="__('Address Line 1')"/>
                                <TextInput
                                    id="address_line_one"
                                    v-model="form.address_line_one"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="address_line_one"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.address_line_one"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="email" :value="__('Address line 2')"/>
                                <TextInput
                                    id="address_line_two"
                                    v-model="form.address_line_two"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    autofocus
                                    autocomplete="address_line_two"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.address_line_two"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="city" :value="__('City/Town')"/>
                                <TextInput
                                    id="city"
                                    v-model="form.city"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="city"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.city"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="province" :value="__('State/Province')"/>
                                <TextInput
                                    id="province"
                                    v-model="form.province"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="province"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.province"/>
                            </div>
                            <div>
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
                                    <InputError :message="form.errors.country"/>
                                </div>

                            </div>
                            <div>
                                <InputLabel class="mt-2" for="postcode" :value="__('Postcode')"/>
                                <TextInput
                                    id="postcode"
                                    v-model="form.postcode"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="postcode"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.postcode"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="telephone" :value="__('Telephone')"/>
                                <TextInput
                                    id="telephone"
                                    v-model="form.telephone"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="telephone"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.telephone"/>
                            </div>
                            <div class="text-center pt-8">
                                <PrimaryButton>{{ __('Continue') }}</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</template>
<script setup>
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
const props = defineProps({
    user: Object
})

const form = useForm({
    agent_name: props.user.agent_name ?? '',
    address_line_one: props.user.address_line_one ?? '',
    address_line_two: props.user.address_line_two ?? '',
    postcode: props.user.postcode ?? '',
    city: props.user.city ?? '',
    province: props.user.province ?? '',
    country: props.user.country ?? '',
    telephone: props.user.telephone ?? '',
    siren: props.user.siren ?? ''
})

const submit = () => {
    axios.post(route('register.agent.store'), form).then(response => {
        window.location = response.data.redirect_to
    })
}
</script>
