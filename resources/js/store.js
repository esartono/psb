import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    /* Tahun Ajaran */
    tp: null,
  },
  mutations: {
    /* A fit-them-all commit */
    basic (state, payload) {
      state[payload.key] = payload.value
    },

    /* User */
    tp (state, payload) {
      if (payload.tp) {
        state.tp = payload.tp
      }
    },
  },
  actions: {

  }
})
