<script setup lang="ts">
import { usePlaylistsStore } from "@/store";
const store = usePlaylistsStore();
console.log(store.generatedPlaylist)
</script>

<template>
<div class="component-container">
    <h2>Generated Playlist</h2>
    <DataTable
        :value="store.generatedPlaylist"
        dataKey="id"
        class="playlist-table"
    >
        <Column headerStyle="width: 5rem">
            <template #body="slotProps">
                <img :src="slotProps.data.image" :alt="slotProps.data.name" class="rounded-image" />
            </template>
        </Column>
        <Column field="name"></Column>
        <Column field="artist"></Column>
        <Column field="duration_formatted"></Column>
    </DataTable>
</div>
</template>

<style scoped lang="scss">

</style>
