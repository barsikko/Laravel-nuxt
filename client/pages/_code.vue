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

    <DialogsNewsShow
      v-if="dialogs.showNews"
      :news="newsData"
      @close-modal="dialogs.showNews = false"
    />

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div v-for="cur_news in publishedNews" :key="cur_news.id" class="col mb-3">
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
                    <button v-if="user" type="button" class="btn btn-sm btn-outline-secondary" @click.prevent="showNewsDialog(cur_news)">
                      View
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
  name: 'IndexPage',

  data: () => ({
    dialogs: {
      showNews: false
    },
    newsData: null
  }),
  computed: {
    publishedNews () {
      return this.news.filter(el => new Date(el.pubDate).getTime() <= new Date().getTime())
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
    }
  }
})
</script>
