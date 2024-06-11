<script setup lang="ts">
import { computed } from 'vue';
import { usePlaylistsStore } from "@/store";

const store = usePlaylistsStore();
const duration = computed({
    get: () => store.playlistLength,
    set: (value) => store.playlistLength = value
});
</script>

<template>
    <div class="component-container">
        <label for="integeronly" class="font-bold block mb-2">How long do you want your playlist to be?</label>
        <div class="duration-input">
            <InputNumber v-model="duration" inputId="integeronly" />
            <span>minutes</span>
        </div>
    </div>
</template>

<style scoped lang="scss">
label {
    font-weight: bold;
    margin-bottom: 1rem;
}

.duration-input {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;

}
</style>
