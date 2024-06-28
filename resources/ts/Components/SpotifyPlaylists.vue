<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import { usePlaylistsStore } from "@/store";
import { PlaylistData } from "@/types/generated";
import axios from 'axios';
import LoadingSpinner from "./LoadingSpinner.vue";

const store = usePlaylistsStore();
const loading = ref(true);
const playlists = computed<PlaylistData[]>(() => store.playlists);
const selectedPlaylists = computed<PlaylistData[]>({
    get: () => store.selectedPlaylists,
    set: (value) => store.selectedPlaylists = value,
});

onMounted(async () => {
    // get playlists
    try {
        const response = await axios.get('/spotify/playlists');
        store.playlists = response.data.playlists;
        loading.value = false;
    } catch (error) {
        console.error(error)
    }
})
</script>

<template>
    <div class="component-container">
        <LoadingSpinner v-if="loading"/>
        <DataTable
            v-else
            :value="playlists"
            v-model:selection="selectedPlaylists"
            selectionMode="multiple"
            :metaKeySelection="false"
            dataKey="id"
            class="playlist-table">

            <template #header>
                <div class="table-header">
                    <span class="title">Your Spotify playlists</span>
                    <span class="subtitle">Select the ones you want to use or select them all</span>
                </div>
            </template>
            <Column header="" headerStyle="width: 5rem">
                <template #body="slotProps">
                    <img :src="slotProps.data.image" :alt="slotProps.data.name" class="rounded-image" />
                </template>
            </Column>
            <Column field="name" header="Name"></Column>
        </DataTable>
    </div>
</template>

<style scoped lang="scss">
.component-container {
    .table-header {
        flex-direction: column;
        margin-bottom: 2rem;

        .subtitle {
            font-weight: 200;
        }
    }
}
</style>
