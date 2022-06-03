<template>
  <div class="modal-overlay">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="close">
          <img class="close-img" src="~/assets/close-96.svg" alt="" @click.prevent="$emit('close-modal')">
        </div>
        <div class="modal-body p-5">
          <h2 class="fw-bold mb-0">
            {{ news.title }}
          </h2>

          <ul class="d-grid gap-4 my-5 list-unstyled">
            <li class="d-flex gap-4">
              <nuxt-img :src="news.image || '/news-default.png'" sizes="sm:100vw md:50vw lg:400px" />
            </li>
            <div>
              {{ news.content }}
            </div>
          </ul>
          <button
            type="button"
            class="btn btn-lg btn-primary mt-5 w-100"
            data-bs-dismiss="modal"
            @click="$emit('close-modal')">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Show',
  props: {
    news: {
      type: Object,
      required: true,
    },
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
