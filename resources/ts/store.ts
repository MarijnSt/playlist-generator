import { defineStore } from 'pinia';
import { ref } from 'vue';
import {PlaylistData, SongData} from "@/types/generated";

export const usePlaylistsStore = defineStore( 'playlists', () => {
    // state
    const playlists = ref<PlaylistData[]>([]);
    const selectedPlaylists = ref<PlaylistData[]>([]);
    const playlistLength = ref(0);
    const generatedPlaylist = ref<SongData[]>([]);
    const playlistName = ref('');
    const playlistLink = ref('');

    // actions
    function removeFromSelectedPlaylists(nameToRemove: string) {
        selectedPlaylists.value = selectedPlaylists.value.filter(playlist => playlist.name !== nameToRemove);
    };

    return {
        playlists,
        selectedPlaylists,
        playlistLength,
        generatedPlaylist,
        playlistName,
        playlistLink,
        removeFromSelectedPlaylists
    };
});
