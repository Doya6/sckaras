import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const headers = { Accept: "application/json"};

export default new Vuex.Store({
  state: {
    userID: '',
    userLevel: ''
  },
  mutations: { //syncronous
    setUserID(state, payload) {
      state.userID = payload;
    },
    setUserLevel(state, payload) {
      state.userLevel = payload;
    }
  },
  actions: { //asyncronous
    //async setMessage(state) {
      //const joke = await fetch(url, { headers });
      //const j = await joke.json();
      //state.commit("setMessage", j.joke);
    //}
  },
  modules:{

  },
  getters: {
    getUserID: state => state.userID,
    getUserLevel: state => state.userLevel
  },

    

});
