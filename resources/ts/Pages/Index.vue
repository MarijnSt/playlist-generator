<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Greeting from "../Components/Greeting.vue";
import Playlists from "../Components/Playlists.vue";
import Duration from "@/Components/Duration.vue";

const props = defineProps({
    user: Object
})
</script>

<template>
    <div class="app-container">
        <Head>
            <title>Home</title>
        </Head>
        <Greeting :user="user" />
        <Playlists v-if="user"/>
        <Duration />
    </div>
</template>

<style scoped>

</style>
