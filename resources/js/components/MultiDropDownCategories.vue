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
      option_selected_cats: {},
      options_selected_cats: [],
      value: [],
    };
  },
  methods: {
     removeElement() {
      this.$forceUpdate();
    },
    selectionChange() {
      this.$forceUpdate();
    },
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
    //  console.log(value + id);
    }
  },
  mounted() {
    //console.log(this.$props);
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

    

      for (const property in this.selected_categories) {
      this.option_selected_cats["id"] = this.selected_categories[property]._id;
      this.option_selected_cats["breadcrumb"] = this.selected_categories[property].category_breadcrumbs.breadcrumb;
      this.options_selected_cats.push(this.option_selected_cats);
      this.option_selected_cats = [];
    }

    let selected_cats = [];
      this.options_selected_cats.forEach((category) => {
        selected_cats.push(category);
      });
    //console.log(this.options_selected_cats);
  //console.log(this.selected_categories);
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
