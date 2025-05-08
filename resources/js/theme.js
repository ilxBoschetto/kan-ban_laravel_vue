import { ref } from 'vue'

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

export { currentTheme, generalThemes, lightThemes, darkThemes, setTheme };