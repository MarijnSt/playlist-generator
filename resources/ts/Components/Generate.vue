<script setup lang="ts">
import { ref } from 'vue';

const loading = ref(false);

const generatePlaylist = () => {
    loading.value = true;
    //TODO: add call to generate playlist
    setTimeout(() => {
        loading.value = false;
    }, 2000);
}

</script>

<template>
<div class="component-container">
    <Button
        type="button" label="Search" icon="pi pi-search"
        class="generate-button"
        :loading="loading"
        @click="generatePlaylist"
    />
</div>
</template>

<style scoped lang="scss">
.generate-button {
    width: 10rem;
}
</style>
