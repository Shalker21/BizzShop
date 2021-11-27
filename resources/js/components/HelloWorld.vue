<template>
  <div>
    <Multiselect
      v-model="value"   
      mode="tags"
      :searchable="true"
      :createTag="true"
      :options="options.map(type => type.category_breadcrumbs.breadcrumb)"
      class="multiselect-blue"
    />
  </div>
</template>

<script>
  import Multiselect from '@vueform/multiselect'

  export default {
    props : ['categories'],
    name: 'hello',
    components: {
      Multiselect,
    },
    data() {
      return {
        value: null,
        options: this.categories,
      }
    },
    mounted:function() {
        console.log(this.categories);
    }
  }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
