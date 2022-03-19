import { createApp } from 'vue';
import categoryImagePreview from './components/categoryImagePreview.vue';
import multidropdown_categories from './components/MultiDropDownCategories.vue';
import multidropdown_variants from './components/MultiDropDownVariants.vue';
import multidropdown_options from './components/MultiDropDownOptions.vue';
import multidropdown_option_values from './components/MultiDropDownOptionValues.vue';

const app = createApp({});
app.component('category-image-preview', categoryImagePreview)
    .component('multidropdown-categories', multidropdown_categories)
    .component('multidropdown-variants', multidropdown_variants)
    .component('multidropdown-options', multidropdown_options)
    .component('multidropdown-option-values', multidropdown_option_values)
    .mount('#app');

require('./bootstrap');
