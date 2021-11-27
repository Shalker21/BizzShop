import { createApp } from 'vue';
import categoryImagePreview from './components/categoryImagePreview.vue';
import brandImagePreview from './components/brandImagePreview.vue';
import hello from './components/HelloWorld.vue';

const app = createApp({});
app.component('category-image-preview', categoryImagePreview)
    .component('brand-image-preview', brandImagePreview)
    .component('hello', hello)
    .mount('#app');

require('./bootstrap');
