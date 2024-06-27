<script setup lang="ts">
import { usePlaylistsStore } from "@/store";

const store = usePlaylistsStore();
</script>

<template>
<div class="component-container">
    <p>Done!</p>
    <a :href="store.playlistLink" target="_blank">
        <Button label="Check out your playlist here!" outlined/>
    </a>
</div>
</template>

<style scoped lang="scss">

</style>
