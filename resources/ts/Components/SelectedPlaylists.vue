<script setup lang="ts">
import { computed} from "vue";
import { usePlaylistsStore } from "@/store";
import {PlaylistData} from "@/types/generated";
const store = usePlaylistsStore();
const selectedPlaylists = computed<PlaylistData[]>(() => store.selectedPlaylists);
function removePlaylist(e: Event) {
    const name = (e.target as HTMLInputElement).innerText;
    console.log('e', e);
    console.log('name', name);
    store.removeFromSelectedPlaylists(name);
}
</script>

<template>
<div class="component-container">
<!--    <span class="pi pi-times"></span>-->
    <Button
        class="chip"
        v-for="(playlist, index) in selectedPlaylists"
        :key="index"
        :label="playlist.name"
        @click="removePlaylist"
        text raised
    />
</div>
</template>

<style scoped lang="scss">
.component-container {
    flex-direction: row !important;
    flex-wrap: wrap;
    gap: 1rem;

    /*.chip {
        opacity: .5;
        transition: ease opacity 1s;

        &:hover {
            opacity: 1;
        }
    }*/
}
</style>
