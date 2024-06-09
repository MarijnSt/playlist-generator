<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Greeting from "../Components/Greeting.vue";
import Playlists from "../Components/Playlists.vue";

const props = defineProps({
    user: Object
})
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <Greeting :user="user" />
    <Playlists v-if="user"/>
</template>

<style scoped>

</style>
