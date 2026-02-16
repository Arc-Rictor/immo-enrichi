<template>
    <div>
        <dl class="mt-5 grid border rounded-lg grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-[#FAFAFA] shadow md:grid-cols-3 md:divide-x md:divide-y-0">
            <div v-for="item in props.stats" :key="item.name" class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">{{ __(item.name) }}</dt>
                <dd class="mt-3 flex items-baseline justify-between md:block lg:flex">
                    <div class="flex items-baseline text-4xl font-semibold">
                        {{ item.current }}
                    </div>

<!--                    <div :class="[item.changeType === 'increase' ? getColour(item.colour) : 'bg-red-100 text-red-800', 'inline-flex items-baseline rounded-lg px-2.5 py-0.5 text-xs md:mt-2 lg:mt-0']">-->
<!--                        <ArrowUpIcon v-if="item.changeType === 'increase'" class="-ml-1 mr-0.5 h-4 w-4 flex-shrink-0 self-center text-gray-700" aria-hidden="true" />-->
<!--                        <ArrowDownIcon v-else class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-red-500" aria-hidden="true" />-->
<!--&lt;!&ndash;                        <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>&ndash;&gt;-->
<!--&lt;!&ndash;                        {{ // item.change }}&ndash;&gt;-->
<!--                    </div>-->
                </dd>
            </div>
        </dl>
    </div>
</template>
<script setup>
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
const props = defineProps({
    stats: {
        type: Object
    }
})

const statColours = {
    'orange': 'bg-[#FFA163]',
    'blue': 'bg-[#98FFED]',
    'purple': 'bg-[#C2B1FF]'
}

const getColour = (colour) => {
return statColours[colour];
}

</script>
