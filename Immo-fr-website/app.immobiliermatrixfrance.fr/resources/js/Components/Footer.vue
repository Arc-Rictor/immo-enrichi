<template>
        <div class="flex justify-between  mx-auto container sm:max-w-7xl text-xs text-black px-10 py-8">
            <p class="text-black font-medium">© {{ new Date().getFullYear() }} Immobilier Matrix France. {{ __('All rights reserved') }}.</p>
            <div class="space-x-4">
                <a href="https://www.immobiliermatrixfrance.fr/">{{ __('Privacy Policy') }}</a>
                <a href="https://www.immobiliermatrixfrance.fr/">{{ __('Mission statement') }}</a>
                <a href="mailto:info-imf@mail.com?subject=Demande depuis le site web">{{ __('Contact us') }}</a>

            </div>
        </div>
</template>
<script setup>
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
</script>
