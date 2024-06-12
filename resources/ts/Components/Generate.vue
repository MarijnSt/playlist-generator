<script setup lang="ts">
import { ref } from 'vue';
import { usePlaylistsStore } from "@/store";
import axios from "axios";

const loading = ref(false);
const store = usePlaylistsStore();

const generatePlaylist = () => {
    loading.value = true;
    console.log('lists', store.selectedPlaylists)
    console.log('length', store.playlistLength)
    axios.post('/spotify/generate', {
        length: store.playlistLength,
        playlists: store.selectedPlaylists
    }).then(res => {
        console.log('res', res)
    }).catch(error => {
        console.error('generate error', error)
    })
    //TODO: add call to generate playlist
    setTimeout(() => {
        loading.value = false;
    }, 2000);
}

</script>

<template>
<div class="component-container">
    <Button
        type="button" label="Generate" icon="pi pi-cog"
        class="generate-button"
        :loading="loading"
        @click="generatePlaylist"
    />
</div>
</template>

<style scoped lang="scss">
.generate-button {
    width: 10rem;
}
</style>
