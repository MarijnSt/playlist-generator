<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from 'axios';
import LoadingSpinner from "./LoadingSpinner.vue";

let loading = ref(true);

let playlists = ref([]);

onMounted(async () => {
    // get playlists from /spotify/playlists endpoint
    try {
        const response = await axios.get('/spotify/playlists');
        console.log(response.data)
        playlists.value = response.data.playlists;
        loading.value = false;
    } catch (error) {
        console.error(error)
    }
})
</script>

<template>
    <LoadingSpinner v-if="loading"/>
    <div v-else class="playlist-table">
        <ul>
            <li v-for="playlist in playlists" :key="playlist.id">{{ playlist.name }}</li>
        </ul>
    </div>
</template>

<style scoped>

</style>
