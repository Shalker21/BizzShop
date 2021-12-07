<template>
  <div>
    <Multiselect
      v-model="value"   
      mode="tags"
      :searchable="true"
      :createTag="true"
      :options="options.map(function(key, value) {
        return key.option.name.concat(' => ', key.value);
      })"
      class="multiselect-blue"
    />
  </div>
</template>

<script>
  import Multiselect from '@vueform/multiselect'

  export default {
    props : ['values'],
    name: 'multidropdown-options',
    components: {
      Multiselect,
    },
    data() {
      return {
        value: null,
        options: this.values,
      }
    },
  }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
