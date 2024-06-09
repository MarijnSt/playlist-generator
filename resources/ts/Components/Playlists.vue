<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import { usePlaylistsStore } from "@/store";
import {PlaylistData, PlaylistsData} from "@/types/generated";
import axios from 'axios';
import LoadingSpinner from "./LoadingSpinner.vue";

const store = usePlaylistsStore();
const loading = ref(true);
const playlists = computed<PlaylistData[]>(() => store.playlists);
//const selectedPlaylists = computed<PlaylistData[]>(() => store.selectedPlaylists);
const selectedPlaylists = computed<PlaylistData[]>({
    get: () => store.selectedPlaylists,
    set: (value) => store.selectedPlaylists = value,
});

onMounted(async () => {
    // get playlists
    try {
        const response = await axios.get('/spotify/playlists');
        console.log(response.data)
        console.log(store.selectedPlaylists)
        store.playlists = response.data.playlists;
        loading.value = false;
        console.log(store)
    } catch (error) {
        console.error(error)
    }
})
</script>

<template>
    <LoadingSpinner v-if="loading"/>
    <div v-else class="component-container">
        <!-- Unselected playlists -->
        <DataTable
            :value="playlists"
            v-model:selection="selectedPlaylists"
            selectionMode="multiple"
            :metaKeySelection="false"
            dataKey="id"
            paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
            class="playlist-table">

            <template #header>
                <div class="table-header">
                    <span class="title">Your playlists</span>
                </div>
            </template>
            <Column header="" headerStyle="width: 5rem">
                <template #body="slotProps">
                    <img :src="slotProps.data.image" :alt="slotProps.data.name" class="w-6rem playlist-image" />
                </template>
            </Column>
            <Column field="name" header="Name"></Column>
        </DataTable>

        <!-- Selected playlists -->
        <DataTable
            v-if="selectedPlaylists && selectedPlaylists.length > 0"
            :value="selectedPlaylists"
            v-model:selection="selectedPlaylists"
            selectionMode="multiple"
            :metaKeySelection="false"
            dataKey="id"
            scrollable scrollHeight="400px" :virtualScrollerOptions="{ itemSize: 46 }"
            class="playlist-table selection">
            <Column headerStyle="width: 5rem">
                <template #body="slotProps">
                    <img :src="slotProps.data.image" :alt="slotProps.data.name" class="w-6rem playlist-image" />
                </template>
            </Column>
            <Column field="name"></Column>
        </DataTable>
    </div>
</template>

<style scoped lang="scss">
.playlist-table {
    margin-top: 1rem;
    width: 100%;

    &.selection {
        background: #eaeaea;
    }

    .table-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;

        .title {
            font-size: 1.25rem;
            color: #212121;
            font-weight: bold;
        }
    }

    .playlist-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }
}
</style>
