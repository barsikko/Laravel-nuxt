<template>
  <label class="btn btn-primary">
    Upload <input type="file" hidden @change="upload($event.target.files)">
  </label>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ImageUpload',
  emits: ['file-uploaded'],
  methods: {
    async upload (files) {
      const file = files.item(0)

      const data = new FormData()
      data.append('image', file)

      const response = await axios.post('upload', data)

      this.$emit('file-uploaded', response.data.url)
    }
  }
}
</script>
