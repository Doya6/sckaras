import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

//const url = "https://icanhazdadjoke.com";
//const headers = { Accept: "application/json"};

export default new Vuex.Store({
  state: {
   // message: 'Hello from Vuex',
    //noveMessage: []
  },
  mutations: { //syncronous
    //setMessage(state, payload) {
    //  state.message = payload;
    //  state.noveMessage.push(payload);
    //}
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
    //getMessage: state => state.message 
  },

    

});
