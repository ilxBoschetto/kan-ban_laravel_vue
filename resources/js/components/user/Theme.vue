<template>
    <button @click="toggleTheme">
        Cambia tema
    </button>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const theme = ref('light')

const applyTheme = () => {
    document.documentElement.setAttribute('data-theme', theme.value)
    localStorage.setItem('theme', theme.value)
}

const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light'
    applyTheme()
}

onMounted(() => {
    // Recupera il tema salvato o imposta "light"
    theme.value = localStorage.getItem('theme') || 'light'
    applyTheme()
})
</script>

<style>
/* Stili base per esempio */
#app {
    background-color: var(--custom-primary);
    color: var(--custom-text);
    min-height: 100vh;
    padding: 2rem;
    transition: background-color 0.3s ease, color 0.3s ease;
}

button {
    background-color: var(--custom-primary);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    margin-bottom: 2rem;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.2s ease;
}
</style>