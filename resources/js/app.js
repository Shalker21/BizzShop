import { createApp } from 'vue';
import categoryImagePreview from './components/categoryImagePreview.vue';

const app = createApp({});
app.component('category-image-preview', categoryImagePreview)
    .mount('#app');

require('./bootstrap');
