<template>
  <div>
    <Multiselect
      v-model="selectedValues"
      mode="tags"
      :object="true"
      :options="options"
      :multiple="true"
      :taggable="true"
      tag-placeholder="Add this as new tag"
      placeholder="Search or add a tag"
      label="value"
      track-by="_id"
      :preselect-first="false"
    >
    </Multiselect>
    <pre
      class="language-json"
    ><code>{{ this.selectedValues }}</code></pre>
    <input
      type="hidden"
      name="selectedValues"
      :value="function_selectedValues"
    />
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
  props: ["values"],
  components: {
    Multiselect,
  },
  data() {
    return {
      selectedValues: [],
      options: [],
    };
  },
  computed: {
    function_selectedValues: function () {
      let selectedValues = [];
      this.selectedValues.forEach((item) => {
        selectedValues.push(item._id);
      });
      return selectedValues;
    },
  },
  mounted() {
    var self = this;
    self.options = this.values;
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
