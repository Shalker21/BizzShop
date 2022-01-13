<template>
  <div>
    <Multiselect
      v-model="selectedCategories"
      mode="tags"
      track-by="id"
      label="breadcrumb"
      :options="options.map(o => Object.assign({},o,{value:o.id}))"
      :multiple="true"
      :taggable="true"
      placeholder="Odaberi opciju"
      :preselect-first="false"
    />
    <pre class="language-json"><code>{{ this.selectedCategories }}</code></pre>
    <input
      type="hidden"
      name="category_ids"
      :value="function_selectedCategories"
    />
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
  props: ['selectedcats', 'categories'],
  components: {
    Multiselect,
  },
  data() {
    return {
      selected_categories: [],
      selectedCategories: [],
      option: {},
      options: [],
    };
  },
  computed: {
    function_selectedCategories: function () {
      let selectedCategories = [];
      this.selectedCategories.forEach((category) => {
        selectedCategories.push(category);
      });

      return selectedCategories;
    },

    toggleSelected: function (value, id) {
      console.log(value + id);
    }
  },
  mounted() {
    
    for (const property in this.categories) {
      this.option["id"] = this.categories[property]._id;
      this.option["breadcrumb"] = this.categories[property].category_breadcrumbs.breadcrumb;
      this.options.push(this.option);
      this.option = [];
    }


    for (const property in this.selectedcats) {
      let obj = Object.assign({}, ...this.selectedcats[property]);
      this.selected_categories.push(obj);
    }
    console.log(this.options);
    console.log(this.selected_categories);
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
