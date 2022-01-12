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
  props: ["categories"],
  components: {
    Multiselect,
  },
  data() {
    return {
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
      console.log(selectedCategories);
      return selectedCategories;
    },
  },
  mounted() {
    for (const property in this.categories) {
      this.option["id"] = this.categories[property]._id;
      this.option["breadcrumb"] = this.categories[property].category_breadcrumbs.breadcrumb;
       console.log(this.option);
      this.options.push(this.option);
      this.option = [];
    }
    console.log(this.options);
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
