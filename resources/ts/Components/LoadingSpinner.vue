<script setup lang="ts">

</script>

<template>
<div class="loading-spinner"></div>
</template>

<style scoped lang="scss">
@keyframes loadingSpin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.loading-spinner {
    width: 2rem;
    height: 2rem;
    border: 3px solid black;
    border-top-color: transparent;
    border-radius: 50%;
    animation: loadingSpin 0.5s ease-in-out infinite;
}
</style>
