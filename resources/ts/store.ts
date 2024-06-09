import { defineStore } from 'pinia';
import { ref } from 'vue';
import {PlaylistData} from "@/types/generated";

export const usePlaylistsStore = defineStore( 'playlists', () => {
    // state
    const playlists = ref<PlaylistData[]>([]);
    const selectedPlaylists = ref<PlaylistData[]>([]);

    // getters

    // actions


    return {
        playlists,
        selectedPlaylists,
    };
});
