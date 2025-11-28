<template>
    <div class="md:px-10 md:space-y-6 ">
        <SectionTitle>
            <template #title>
                <div class="pt-1">

                <slot name="title" />
                </div>
            </template>
            <template #aside>
                <div class="pt-1">
                <slot name="action" />
                </div>
            </template>
        </SectionTitle>

        <div class="grid grid-cols-1 sm:grid-cols-4 sm:items-start sm:gap-4 sm:py-6 space-y-1">
            <slot />
        </div>
    </div>
</template>
<script setup>
import SectionTitle from "@/Components/SectionTitle.vue";
</script>
