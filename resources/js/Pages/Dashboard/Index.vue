<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <a :href="route('auth.spotify')">Logins with Spotify</a>
</template>

<style scoped>

</style>
