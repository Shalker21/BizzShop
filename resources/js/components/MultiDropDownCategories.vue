<template>
  <div>
    <Multiselect
      v-model="selectedCategories"
      mode="multiple"
      :object="true"
      :options="options.map(type => type)"
      :multiple="true"
      :taggable="true"
      placeholder="Odaberi opciju"
      track-by="id"
      label="breadcrumb"
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
      option: [],
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
      this.option.id = this.categories[property]._id;
      this.option.breadcrumb = this.categories[property].category_breadcrumbs.breadcrumb;
      this.options.push(this.option);
      this.option = [];
    }
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
