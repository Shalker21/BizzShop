<template>
  <div>
    <Multiselect
      v-model="selectedValues"
      mode="tags"
      :object="true"
      :options="options"
      :multiple="true"
      :taggable="true"
      placeholder="Odaberi opciju"
      label="value"
      track-by="_id"
      :preselect-first="false"
    />
    <input
      type="hidden"
      name="optionValue_ids"
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
