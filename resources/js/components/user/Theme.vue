<template>
    <div>
        <span class="theme-sub-title">GENERAL</span>
        
        <div class="row gap-2">
            <div v-for="theme in generalThemes" :key="theme.name" class="col-md-3" @click="setTheme(theme.name)">
                <div class="theme-name" :class="{ active: currentTheme === theme.name }">
                </div>
                <div class="theme-option" :class="{ active: currentTheme === theme.name }">
                    <div style="width: 50%; height:100%" :style="{ backgroundColor: theme.primary }">
                    </div>
                    <div style="width: 30%; height:100%" :style="{ backgroundColor: theme.secondary }">
                    </div>
                    <div style="width: 20%; height:100%" :style="{ backgroundColor: theme.accent }">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <span class="theme-sub-title">DARK</span>
        <div class="row gap-2">
            <div v-for="theme in darkThemes" :key="theme.name" class="col-md-3" @click="setTheme(theme.name)">
                <div class="theme-name" :class="{ active: currentTheme === theme.name }">
                </div>
                <div class="theme-option" :class="{ active: currentTheme === theme.name }">
                    <div style="width: 50%; height:100%" :style="{ backgroundColor: theme.primary }">
                    </div>
                    <div style="width: 30%; height:100%" :style="{ backgroundColor: theme.secondary }">
                    </div>
                    <div style="width: 20%; height:100%" :style="{ backgroundColor: theme.accent }">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <span class="theme-sub-title">LIGHT</span>
        <div class="row gap-2">
            <div v-for="theme in lightThemes" :key="theme.name" class="col-md-3" @click="setTheme(theme.name)">
                <div class="theme-name" :class="{ active: currentTheme === theme.name }">
                </div>
                <div class="theme-option" :class="{ active: currentTheme === theme.name }">
                    <div style="width: 50%; height:100%" :style="{ backgroundColor: theme.primary }">
                    </div>
                    <div style="width: 30%; height:100%" :style="{ backgroundColor: theme.secondary }">
                    </div>
                    <div style="width: 20%; height:100%" :style="{ backgroundColor: theme.accent }">
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref, onMounted } from 'vue'

const currentTheme = ref('light');
const generalThemes = [
    {
        name: 'light',
        primary: '#ffffff',
        secondary: '#c0c5ce',
        accent: '#9aa0a6'
    },
    {
        name: 'dark',
        primary: '#2c3e50',
        secondary: '#5e6472',
        accent: '#7c828a'
    },
];
const lightThemes = [
    {
        name: 'lavanda',
        primary: '#726a85',
        secondary: '#b4b0c3',
        accent: '#978ea8'
    },
    {
        name: 'blue sky',
        primary: '#7da5c0',
        secondary: '#5d7488',
        accent: '#9dbed6'
    },
    {
        name: 'red desert',
        primary: '#b96f57',
        secondary: '#8c5646',
        accent: '#d28b76'
    },
    {
        name: 'green olive',
        primary: '#7b8b6f',
        secondary: '#5c6453',
        accent: '#9ba88b'
    },
    {
        name: 'cream',
        primary: '#f5e1a4',
        secondary: '#e1cfa7',
        accent: '#d1b28a'
    },
    {
        name: 'rubin',
        primary: '#d5004c',
        secondary: '#9b1d3b',
        accent: '#e25574'
    },
    
];

const darkThemes = [
    {
        name: 'lavanda-dark',
        primary: '#b4b0c3',
        secondary: '#726a85',
        accent: '#978ea8'
    },
    {
        name: 'blue sky-dark',
        primary: '#9dbed6',
        secondary: '#7da5c0',
        accent: '#5d7488'
    },
    {
        name: 'red desert-dark',
        primary: '#d28b76',
        secondary: '#b96f57',
        accent: '#8c5646'
    },
    {
        name: 'green olive-dark',
        primary: '#9ba88b',
        secondary: '#7b8b6f',
        accent: '#5c6453'
    },
    {
        name: 'cream-dark',
        primary: '#e1cfa7',
        secondary: '#f5e1a4',
        accent: '#d1b28a'
    },
    {
        name: 'rubin-dark',
        primary: '#d5004c',
        secondary: '#9b1d3b',
        accent: '#e25574'
    },
];

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
    display: flex;
}

.theme-option>div:first-child {
    border-radius: 0.4rem 0 0 0.4rem;
}

.theme-option>div:nth-child(3) {
    border-radius: 0 0.4rem 0.4rem 0;
}

.theme-option:hover {
    transform: scale(1.01);
}

.theme-option.active {
    border: 0.3rem solid var(--custom-success, #e67e22);
}

.theme-name.active {
    font-weight: 800;
}

.theme-sub-title {
    font-size: 1.8rem;
    font-weight: 500;
}
</style>