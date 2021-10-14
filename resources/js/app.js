import { createApp } from 'vue'
import HelloWorld from './components/HelloWorld.vue';

const app = createApp({});
app.component('hello-world', HelloWorld)
    .mount('#app');
    
require('./bootstrap');
