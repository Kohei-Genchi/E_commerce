import '../css/app.css'; // Import Tailwind CSS
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { createRouter, createWebHistory } from 'vue-router';
import App from './layouts/app.vue';
import axios from 'axios';



import Top from './components/Top.vue';
const pinia = createPinia();
const routes = [
    {
        path: '/',
        name: 'home',
        component: Top
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Create Vue application
const app = createApp(App);

// Use plugins
app.use(router);
app.use(pinia);  // Fixed spelling from 'pinja' to 'pinia'

// Configure axios
app.config.globalProperties.$axios = axios;

// Mount the application
app.mount('#app');
