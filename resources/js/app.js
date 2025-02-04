import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes.js';

// Fontawesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';
import axios from 'axios';

library.add(fas, far);

const app = createApp({});
const router = createRouter({
    routes: Routes,
    history: createWebHistory(),
});
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);

app.mount('#app');