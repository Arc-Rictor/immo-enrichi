<template>
    <div ref="mapContainer" class="map-container"></div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { defineProps } from 'vue';

// Define props to accept location and radius in kilometers
const props = defineProps({
    location: Object,
    radius: Number,
});

const mapContainer = ref(null);
let map;
let circle;

onMounted(() => {
    const center = props.location || { lat: -34.397, lng: 150.644 }; // Default location
    const radiusInMeters = (props.radius || 1) * 1000; // Default radius in kilometers, converted to meters

    // Creating a map object
    map = new google.maps.Map(mapContainer.value, {
        zoom: 10,
        center,
        disableDefaultUI: true
    });

    // Creating a circle object to represent the radius
    circle = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map,
        center,
        radius: radiusInMeters,
    });
});

// Watch for changes in the location and radius prop and update the map and circle accordingly
watch(() => [props.location, props.radius], ([newLocation, newRadius]) => {
    if (newLocation && map && circle) {
        const newCenter = new google.maps.LatLng(newLocation.lat, newLocation.lng);
        map.setCenter(newCenter);
        circle.setCenter(newCenter);
        if (newRadius) {
            circle.setRadius(newRadius * 1000); // Convert from kilometers to meters
        }
    }
});
</script>

<style scoped>
.map-container {
    width: 100%;
    height: 300px; /* You can adjust the height and width as needed */
}
</style>
