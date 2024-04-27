<script setup>
defineProps({
    user: Object
})
</script>

<template>
    <h1>Playlist Generator</h1>
    <p>This tool will look at your spotify profile and generate a playlist for you based on your saved playlists and songs.</p>
    <div v-if="!user">
        <p>To generate a playlist, you'll need to connect your Spotify profile</p>
        <a :href="route('auth.spotify')">Login with Spotify</a>
    </div>
    <div v-else>
        <h3>Ready {{ user.name }}? Let's go!</h3>
        <!--<a :href="route('auth.spotify.logout')">Logout</a>-->
    </div>
</template>

<style scoped>

</style>
