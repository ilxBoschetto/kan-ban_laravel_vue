<template>
    <div class="row gap-2">
        <div v-for="theme in themes" :key="theme.name" class="col-md-3" @click="setTheme(theme.name)">
            <div class="theme-name"
                :class="{ active: currentTheme === theme.name }">
                {{ theme.name.toUpperCase() }}
            </div>
            <div class="theme-option" :style="{ backgroundColor: theme.color }"
                :class="{ active: currentTheme === theme.name }">
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const currentTheme = ref('light');
const themes = [
    { name: 'light', color: '#ffffff' },
    { name: 'dark', color: '#2c3e50' },
    { name: 'lavanda', color: '#726a85' },
    { name: 'blue sky', color: '#aeb7c4' },
    { name: 'red desert', color: '#b96f57' },
    { name: 'green olive', color: '#7b8b6f' },
]

function setTheme(themeName) {
    currentTheme.value = themeName;
    document.documentElement.setAttribute('data-theme', currentTheme.value);
    localStorage.setItem('theme', currentTheme.value);
}

onMounted(() => {
    let theme = localStorage.getItem('theme');
    currentTheme.value = theme ?? 'light';
    setTheme(currentTheme.value);
});
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

.theme-switcher {
    display: flex;
    gap: 1rem;
}

.theme-option {
    border-radius: 0.5rem;
    cursor: pointer;
    height: 5rem;
    border: 0.1rem solid silver;
    transition: border-color 0.3s, transform 0.3s;
}

.theme-option:hover {
    transform: scale(1.01);
}

.theme-option.active {
    border: 0.2rem solid var(--custom-success, #e67e22);
}
.theme-name.active{
    font-weight: 800;
}
</style>