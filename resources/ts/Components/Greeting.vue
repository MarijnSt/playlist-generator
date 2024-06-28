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
        <p>Create a new playlist with random songs from all your saved Spotify playlists</p>
        <div v-if="!user">
            <p>To generate a playlist, you'll need to connect your Spotify profile</p>
            <a :href="route('auth.spotify')">
                <Button label="Login with Spotify" />
            </a>
        </div>
        <div v-else>
            <h3>Ready {{ user.name }}? Let's go!</h3>
            <Button @click="logout" label="Logout" />
        </div>
    </div>
</template>

<style scoped>

</style>
