<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Greeting from "../Components/Greeting.vue";
import Playlists from "../Components/Playlists.vue";
import Duration from "@/Components/Duration.vue";
import Generate from "@/Components/Generate.vue";

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
        <Generate />
    </div>
</template>

<style scoped>

</style>
