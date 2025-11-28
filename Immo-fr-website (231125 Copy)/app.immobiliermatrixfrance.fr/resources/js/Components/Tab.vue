<template>
    <div v-show="activeTab === label" class="space-y-6">
        <slot />
    </div>
</template>
<script setup>
defineProps({
    activeTab: String,
    label: String
})
</script>
