<script setup lang="ts">
import { ref, onMounted } from "vue";
import {PlaylistData, PlaylistsData} from "@/types/generated";
import axios from 'axios';
import LoadingSpinner from "./LoadingSpinner.vue";

const loading = ref(true);

const playlists = ref<PlaylistData[]>([]);
const selectedPlaylists = ref<PlaylistData[]>();

onMounted(async () => {
    // get playlists
    try {
        const response = await axios.get('/spotify/playlists');
        console.log(response.data)
        playlists.value = response.data.playlists;
        loading.value = false;
    } catch (error) {
        console.error(error)
    }
})
</script>

<template>
    <LoadingSpinner v-if="loading"/>
    <div v-else class="playlists-container">
        <!-- Unselected playlists -->
        <DataTable
            :value="playlists"
            v-model:selection="selectedPlaylists"
            selectionMode="multiple"
            :metaKeySelection="false"
            dataKey="id"
            paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
            class="playlist-table"
            tableStyle="min-width: 50rem">

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
            class="playlist-table"
            scrollable scrollHeight="400px" :virtualScrollerOptions="{ itemSize: 46 }"
            tableStyle="min-width: 50rem">

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
