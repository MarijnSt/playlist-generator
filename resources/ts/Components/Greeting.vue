<script setup>
import { router } from '@inertiajs/vue3';

defineProps({
    user: Object
})

function logout() {
    router.post(route('auth.logout'));
}
</script>

<template>
    <div class="component-container">
        <h1>Playlist Generator</h1>
        <p>This tool will look at your spotify profile and generate a playlist for you based on your saved playlists and songs.</p>
        <div v-if="!user">
            <p>To generate a playlist, you'll need to connect your Spotify profile</p>
            <a :href="route('auth.spotify')"><button>Login with Spotify</button></a>
        </div>
        <div v-else>
            <h3>Ready {{ user.name }}? Let's go!</h3>
            <button @click="logout">Logout</button>
        </div>
    </div>
</template>

<style scoped>

</style>
