<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Greeting from "../Components/Greeting.vue";
import Playlists from "../Components/Playlists.vue";
import Duration from "@/Components/Duration.vue";
import Generate from "@/Components/Generate.vue";
import { usePlaylistsStore } from "@/store";
import GeneratedPlaylist from "@/Components/GeneratedPlaylist.vue";
import CreatePlaylist from "@/Components/CreatePlaylist.vue";

const store = usePlaylistsStore();

const props = defineProps({
    user: Object
})
</script>

<template>
    <div class="app-container">
        <Head>
            <title>Home</title>
        </Head>
        <Greeting :user="user" />
        <template v-if="user">
            <Playlists />
            <template v-if="store.selectedPlaylists.length > 0">
                <Duration/>
                <Generate/>
            </template>
            <template v-if="store.generatedPlaylist.length > 0">
                <GeneratedPlaylist />
                <CreatePlaylist />
            </template>
        </template>
    </div>
</template>

<style scoped>

</style>
