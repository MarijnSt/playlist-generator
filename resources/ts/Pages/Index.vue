<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { usePrimeVue } from 'primevue/config';
import Header from "../Components/Header.vue";
import SpotifyPlaylists from "../Components/SpotifyPlaylists.vue";
import SelectedPlaylists from "../Components/SelectedPlaylists.vue";
import Duration from "@/Components/Duration.vue";
import Generate from "@/Components/Generate.vue";
import GeneratedPlaylist from "@/Components/GeneratedPlaylist.vue";
import CreatePlaylist from "@/Components/CreatePlaylist.vue";
import PlaylistLink from "@/Components/PlaylistLink.vue";
import Footer from "@/Components/Footer.vue";

const PrimeVue = usePrimeVue();
PrimeVue.config.ripple = true;

import { usePlaylistsStore } from "@/store";
const store = usePlaylistsStore();

const props = defineProps({
    user: Object
})
</script>

<template>
    <div class="app-container">
        <Head>
            <title>Playlist Generator</title>
        </Head>
        <Header :user="user" />
        <template v-if="user">
            <SpotifyPlaylists />
            <SelectedPlaylists />
            <template v-if="store.selectedPlaylists.length > 0">
                <Duration/>
                <Generate/>
            </template>
            <template v-if="store.generatedPlaylist.length > 0">
                <GeneratedPlaylist />
                <CreatePlaylist />
            </template>
            <PlaylistLink v-if="store.playlistLink"/>
        </template>
    </div>
    <Footer/>
</template>

<style scoped>

</style>
