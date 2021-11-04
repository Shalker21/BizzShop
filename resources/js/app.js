import { createApp } from 'vue';
import categoryImagePreview from './components/categoryImagePreview.vue';
import brandImagePreview from './components/brandImagePreview.vue';

const app = createApp({});
app.component('category-image-preview', categoryImagePreview)
    .component('brand-image-preview', brandImagePreview)
    .mount('#app');

require('./bootstrap');
