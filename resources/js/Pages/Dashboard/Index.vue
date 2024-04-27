<script setup>
import { Head } from '@inertiajs/vue3';
import Greeting from "../../Components/Greeting.vue";
const props = defineProps({
    user: Object
})
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <Greeting :user="user" />
</template>

<style scoped>

</style>
