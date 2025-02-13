import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import App from './components/App.vue';
const app = createApp(App);
app.mount('#app');
window.Alpine = Alpine;

Alpine.start();
