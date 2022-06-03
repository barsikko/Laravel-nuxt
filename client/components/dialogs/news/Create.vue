<template>
  <div class="modal-overlay">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="close">
          <img class="close-img" src="~/assets/close-96.svg" alt="" @click="$emit('close-modal')">
        </div>
        <div class="modal-body p-5">
          <form @submit.prevent="save()" >
            <div class="form-group">
              <label>Title</label>
              <input v-model="form.title" type="text" class="form-control" name="title">
            </div>

            <no-ssr>
              <label>Date</label>
              <date-picker format="MM/DD/YYYY h:i:s" v-model="form.pubDate" />
            </no-ssr>

            <ul class="d-grid gap-4 my-5 list-unstyled">
              <li class="d-flex gap-4">
                <div class="form-group">
                  <label>Image</label>
                  <nuxt-img
                    class="mb-3"
                    :src="form.image || '/news-default.png'"
                    sizes="sm:100vw md:50vw lg:400px" />
                  <div class="input-group-append">
                    <input type="text" class="form-control invisible" name="Image" v-model="form.image">
                    <GlobalImageUpload @file-uploaded="form.image = $event"/>
                  </div>
                </div>
              </li>
              <div class="form-group">
                <label>Content</label>
                <textarea v-model="form.content" type="text" class="form-control" name="content" />
              </div>
            </ul>
            <button class="btn btn-lg btn-primary mt-5 w-100">
              Save
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Create",
  data: () => ({
    form: {
      title: '',
      content: '',
      image: '',
      pubDate: new Date(),
    },
    loading: false,
  }),
  methods: {
    save() {
      this.loading = true

      this.form.pubDate = this.$moment(this.form.pubDate).format('YYYY/MM/DD HH:mm')

      this.$store.dispatch('news/createNews', { news: this.form })

      this.loading = false
    }
  }
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: center;
  background-color: #000000da;
  z-index: 1000;
}

.close {
  cursor: pointer;
  margin: 10px;
}

.close-img {
  width: 25px;
  float: right;
}

h6 {
  font-weight: 500;
  font-size: 28px;
  margin: 20px 0;
}

p {
  font-size: 16px;
  margin: 20px 0;
}

button {
  background-color: #ac003e;
  width: 150px;
  height: 40px;
  color: white;
  font-size: 14px;
  border-radius: 16px;
  margin-top: 50px;
}
</style>

