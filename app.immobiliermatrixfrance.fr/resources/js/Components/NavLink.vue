<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'group inline-flex h-[60px] justify-between w-full items-center gap-x-2 text-lg rounded-full bg-black px-5 py-2.5 font-medium text-white hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
        : 'group inline-flex h-[60px] justify-between w-full items-center gap-x-2 text-lg rounded-full bg-transparent px-5 py-2.5 font-medium hover:text-white hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600';
});

const iconClasses = computed(() => {
    return props.active
        ? 'bg-white p-3 font-bold rounded-full'
        : 'bg-transparent p-3 font-bold rounded-full group-hover:bg-white'
})
</script>

<template>
    <Link :href="href" :class="classes">
        <slot/>
        <div :class="iconClasses">
            <slot name="icon"/>
        </div>

    </Link>
</template>


