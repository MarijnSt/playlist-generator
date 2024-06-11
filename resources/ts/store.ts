import { defineStore } from 'pinia';
import { ref } from 'vue';
import { PlaylistData } from "@/types/generated";

export const usePlaylistsStore = defineStore( 'playlists', () => {
    const playlists = ref<PlaylistData[]>([]);
    const selectedPlaylists = ref<PlaylistData[]>([]);
    const playlistLength = ref(0);

    return {
        playlists,
        selectedPlaylists,
        playlistLength
    };
});
