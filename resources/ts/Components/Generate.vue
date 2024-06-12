<script setup lang="ts">
import { ref } from 'vue';
import { usePlaylistsStore } from "@/store";
import axios from "axios";

const loading = ref(false);
const store = usePlaylistsStore();

const generatePlaylist = () => {
    loading.value = true;
    axios.post('/spotify/generate', {
        length: store.playlistLength,
        playlists: store.selectedPlaylists
    }).then(res => {
        console.log('res', res)
        store.generatedPlaylist = res.data
    }).catch(error => {
        console.error('generate error', error)
    }).finally(() => {
        setTimeout(() => {
            loading.value = false;
        }, 2000);
    })
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
