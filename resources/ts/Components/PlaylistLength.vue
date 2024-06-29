<script setup lang="ts">
import { ref, computed } from 'vue';
import { usePlaylistsStore } from "@/store";
import axios from "axios";

const store = usePlaylistsStore();
const duration = computed({
    get: () => store.playlistLength,
    set: (value) => store.playlistLength = value
});

const loading = ref(false);

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
        loading.value = false;
    })
}
</script>

<template>
    <div class="component-container">
        <div class="component-header">
            <h3 class="title">How long do you want your playlist to be?</h3>
        </div>
        <form @submit.prevent="generatePlaylist">
            <div class="length-input">
                <InputNumber v-model="duration" inputId="playlist-length" />
                <span>minutes</span>
            </div>
            <Button
                type="button" label="Generate"
                class="generate-button"
                :loading="loading"
            />
        </form>
    </div>
</template>

<style scoped lang="scss">
.component-container {
    .length-input {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .generate-button {
        margin-top: 1.5rem;
    }
}
</style>
