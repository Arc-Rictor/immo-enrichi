<template>
    <div class="map" :id="id"></div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { watch } from 'vue';

const props = defineProps({
    locations: {
        type: Array,
        required: true
    },
    id: {
        default: 'map'
    }
});

const mapRef = ref(null);

onMounted(() => {
    // Initialize the map
    mapRef.value = new google.maps.Map(document.getElementById(props.id), {
        center: props.locations[0],
        zoom: 10,
        zoomControl: false // This disables the zoom controls
    });

    // Add pins with info windows (tooltips)
    props.locations.forEach((location) => {
        const marker = new google.maps.Marker({
            position: location,
            map: mapRef.value
        });

        const infoWindow = new google.maps.InfoWindow({
            content: location.description // Set the content here
        });

        marker.addListener('click', () => {
            infoWindow.open({
                anchor: marker,
                map: mapRef.value,
                shouldFocus: false
            });
        });
    });
});


// Watch for changes in locations and update pins accordingly
watch(props.locations, (newLocations, oldLocations) => {
    if (newLocations !== oldLocations) {
        mapRef.value.setCenter(newLocations[0]);
        newLocations.forEach((location) => {
            new google.maps.Marker({
                position: location,
                map: mapRef.value,
            });
        });
    }
});
</script>

<style>
.map {
    width: 100%;
    height: 400px; /* You can set this to whatever height you like */
}
</style>
