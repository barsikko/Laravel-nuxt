import axios from 'axios'

export const state = () => ({
  news: []
})

export const getters = {
  news: state => state.news
}

export const mutations = {
  UPDATE_NEWS (state, news) {
    const elIndex = state.news.findIndex(el => el.id === news.id)
    state.news[elIndex] = news
  },

  DELETE_NEWS (state, news) {
    state.news = state.news.filter(el => el.id !== news.id)
  },

  FETCH_NEWS_SUCCESS (state, news) {
    state.news = news
  },

  CREATE_NEWS (state, news) {
    state.news.push(news)
  }
}

export const actions = {
  async fetchNews ({ commit }) {
    const { data } = await axios.get('/news')

    commit('FETCH_NEWS_SUCCESS', data.data)
  },

  async deleteNews ({ commit }, { news }) {
    await axios.delete('news/' + news.id)

    commit('DELETE_NEWS', news)
  },

  async updateNews ({ commit }, { news }) {
    const { data } = await axios.put('news/' + news.id, news)

    commit('UPDATE_NEWS', data.data)
  },

  async createNews ({ commit }, { news }) {
    const { data } = await axios.post('news', news)

    commit('CREATE_NEWS', data.data)
  }
}
