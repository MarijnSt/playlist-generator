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
        name: store.playlistName
    }).then(res => {
        console.log('create res', res)
    }).catch(error => {
        console.error('create error', error)
    }).finally(() => {
        loading.value = false;
    })
}
</script>

<template>
    <div class="component-container">
        <h3>Add your playlist to your Spotify</h3>
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

</style>
