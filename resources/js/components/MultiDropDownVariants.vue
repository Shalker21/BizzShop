<template>
  <div>
    <Multiselect
      v-model="value"   
      mode="tags"
      :searchable="true"
      :createTag="true"
      :options="options.map(type => type.variant_translation.name)"
      class="multiselect-blue"
    />
  </div>
</template>

<script>
  import Multiselect from '@vueform/multiselect'

  export default {
    props : ['variants'],
    name: 'multidropdown-variants',
    components: {
      Multiselect,
    },
    data() {
      return {
        value: null,
        options: this.variants,
      }
    },
  }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
