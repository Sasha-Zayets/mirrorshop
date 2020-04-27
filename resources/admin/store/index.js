import Vue from 'vue';
import Vuex from 'vuex';

// import module
import settings from './modules/settings';
import sliders from './modules/sliders';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
      settings,
      sliders
    },
    state: {
      showMessage: {
        show: false,
        type: 'success',
        text: 'Зміни збережено',
        timeout: 3000
      }
    },
    mutations: {
      setOptionShowMessage(state, payload) {
        const newOption = {
          ...state.showMessage,
          ...payload
        };

        state.showMessage = newOption;
      },
    },
    actions: {},
    getters: {
      showMessage: state => state.showMessage,
    }
});

export default store;
