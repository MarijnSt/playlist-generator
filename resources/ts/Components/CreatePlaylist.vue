<script setup lang="ts">
import { ref, computed } from "vue";
import { usePlaylistsStore } from "@/store";
import axios from 'axios';

const store = usePlaylistsStore();
const playlistName = computed<string>({
    get: () => store.playlistName,
    set: (value) => store.playlistName = value
})

const loading = ref(false);

const submit = () => {
    loading.value = true;
    axios.post('/spotify/create', {
        name: store.playlistName,
        uris: store.generatedPlaylist.map(song => song.uri)
    }).then(res => {
        store.playlistLink = res.data.playlist_link;
    }).catch(error => {
        console.error('create error', error)
    }).finally(() => {
        loading.value = false;
    })
}
</script>

<template>
    <div class="component-container">
        <div class="component-header">
            <h3 class="title">Looking good?</h3>
            <p class="subtitle">Give your playlist a name and save it in your Spotify</p>
        </div>
        <form @submit.prevent="submit">
            <InputText type="text" v-model="playlistName" />
            <Button
                type="submit" label="Create playlist"
                class="generate-button"
                :loading="loading"
            />
        </form>
    </div>
</template>

<style scoped lang="scss">
.component-container {
    form {
        /*display: flex;
        flex-direction: column;*/

        .generate-button {
            display: block;
            margin: 1.5rem auto 0;
        }
    }
}
</style>
