import { createApp } from 'vue'

require('./bootstrap');
import App from './App.vue';
import router from './router';

const app = createApp(App).use(router).mount('#app')