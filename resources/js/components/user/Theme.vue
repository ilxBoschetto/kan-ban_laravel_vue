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
import {currentTheme, generalThemes, lightThemes, darkThemes, setTheme} from '../../theme.js';
</script>
<style>

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