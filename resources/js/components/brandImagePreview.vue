<template>
  <div class="grid grid-cols-2 gap-2">
    <div class="m-5" @click="selectImage">
      <img :src="previewImage" id="logoImg" style="width: 80px; height: auto" />
    </div>
    <div>
      <div class="flex items-center justify-center bg-grey-lighter">
        <label
          class="
            flex flex-col
            items-center
            bg-white
            text-blue-600
            rounded-lg
            shadow-lg
            my-2
            px-8
            py-2
            border border-blue
            cursor-pointer
            hover:text-blue-400
          "
        >
          <svg
            class="w-8 h-8"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
            />
          </svg>
          <span class="mt-2 text-base leading-normal"
            >Odaberi Sliku kategorije</span
          >
          <input
            @change="pickFile"
            ref="fileInput"
            type="file"
            class="hidden"
            name="brand_image"
          />  
        </label>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      previewImage: "https://via.placeholder.com/80x80?text=Placeholder+Image",
    };
  },
  methods: {
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile(e) {
      let image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        this.previewImage = e.target.result;
      };
    },
  },
  props: ["image_path"],
  mounted() {
    if (typeof this.image_path !== 'undefined' && this.image_path !== "") {
      this.previewImage =
        window.location.origin + "/storage/" + this.image_path;
    }
  },
};
</script>
 