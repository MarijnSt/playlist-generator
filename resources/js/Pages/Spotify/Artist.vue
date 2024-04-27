<script setup>
import {Head} from "@inertiajs/vue3";

defineProps({
    artist: Object
})
</script>

<template>
    <Head>
        <title>{{ artist.name }}</title>
    </Head>
    <h1>{{ artist.name }}</h1>
</template>

<style scoped>

</style>
