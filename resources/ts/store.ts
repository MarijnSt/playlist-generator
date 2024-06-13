import { defineStore } from 'pinia';
import { ref } from 'vue';
import {PlaylistData, SongData} from "@/types/generated";

export const usePlaylistsStore = defineStore( 'playlists', () => {
    const playlists = ref<PlaylistData[]>([]);
    const selectedPlaylists = ref<PlaylistData[]>([]);
    const playlistLength = ref(0);
    const generatedPlaylist = ref<SongData[]>([]);
    const playlistName = ref('');

    return {
        playlists,
        selectedPlaylists,
        playlistLength,
        generatedPlaylist,
        playlistName
    };
});
