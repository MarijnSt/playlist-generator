<script setup lang="ts">

import { ref } from 'vue';

const duration = ref(0);

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
.duration-input {
    display: flex;
    align-items: center;
    gap: 1rem;
}
</style>
