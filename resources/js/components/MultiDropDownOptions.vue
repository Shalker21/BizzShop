<template>
  <div>
    <Multiselect
      v-model="value"   
      mode="tags"
      :searchable="true"
      :createTag="true"
      :options="options.map(type => type.name)"
      class="multiselect-blue"
    />
  </div>
</template>

<script>
  import Multiselect from '@vueform/multiselect'

  export default {
    props : ['opt'],
    name: 'multidropdown-options',
    components: {
      Multiselect,
    },
    data() {
      return {
        value: null,
        options: this.opt,
      }
    },
  }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
