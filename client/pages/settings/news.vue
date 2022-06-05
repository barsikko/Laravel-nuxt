<template>
  <main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">
            Лента новостей
          </h1>
        </div>
      </div>
    </section>

    <div>
      <button v-if="isAdmin" type="button" class="btn btn-lg btn-primary" @click.prevent="createNewsDialog()">
        Create New
      </button>
    </div>

    <DialogsNewsCreate
      v-if="dialogs.createNews"
      @close-modal="dialogs.createNews = false"
    />
    <DialogsNewsShow
      v-if="dialogs.showNews"
      :news="newsData"
      @close-modal="dialogs.showNews = false"
    />
    <DialogsNewsEdit
      v-if="dialogs.editNews"
      :news="newsData"
      @close-modal="dialogs.editNews = false"
    />

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div v-for="cur_news in news" :key="cur_news.id" class="col mb-3">
            <p class="text-center font-weight-bold">
              {{ cur_news.title }}
            </p>
            <div class="card shadow-sm">
              <nuxt-img :src="cur_news.image || '/news-default.png'" sizes="sm:100vw md:50vw lg:400px" />
              <div class="card-body">
                <p class="card-text">
                  {{ cur_news.content }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" @click.prevent="showNewsDialog(cur_news)">
                      View
                    </button>
                    <button v-if="isAdmin" type="button" class="btn btn-sm btn-outline-secondary" @click.prevent="editNewsDialog(cur_news)">
                      Edit
                    </button>
                    <button v-if="isAdmin"
                            type="button"
                            class="btn btn-sm btn-outline-secondary"
                            :disabled="loading"
                            @click.prevent="deleteNews(cur_news)"
                    >
                      Delete
                    </button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import Vue from 'vue'
import { mapGetters } from 'vuex'

export default Vue.extend({
  name: 'News',

  data: () => ({
    dialogs: {
      showNews: false,
      editNews: false,
      createNews: false
    },
    newsData: null,
    loading: false
  }),
  computed: {
    isAdmin () {
      return this.user?.is_admin
    },
    ...mapGetters({
      user: 'auth/user',
      news: 'news/news'
    })
  },
  async mounted () {
    try {
      await this.$store.dispatch('news/fetchNews')
    } catch (e) {
      console.log(e)
    }
  },
  methods: {
    showNewsDialog (news) {
      this.dialogs.showNews = true
      this.newsData = news
    },
    editNewsDialog (news) {
      this.dialogs.editNews = true
      this.newsData = news
    },
    async deleteNews (news) {
      this.loading = true

      try {
        if (confirm('Are yuo sure you want to delete this record?')) {
          await this.$store.dispatch('news/deleteNews', { news })
        }
      } catch (e) {
        console.log(e.response.data)
      }

      this.loading = false
    },
    createNewsDialog () {
      this.dialogs.createNews = true
    }
  }
})
</script>
