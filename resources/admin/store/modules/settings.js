import axios from 'axios';
import { randomNumber, filterNumber } from '../../assets/js/helpers';
import { numberDefaultObject } from '../../assets/js/constants';

const state = {
  pageLoading: false,
  saveLoading: false,
  phones: [],
  email: '',
  location: {},
  schedule: {},
  socials: [
    {
      name: 'facebook',
      iconName: 'fab fa-facebook',
      link: '',
    },
    {
      name: 'instagram',
      iconName: 'fab fa-instagram',
      link: '',
    },
    {
      name: 'youtube',
      iconName: 'fab fa-youtube',
      link: '',
    }
  ]
}

let mutations = {
  setPhones(state, payload) {
    let numberArray = [];
    for(let i = 0; i < 4; i++) {
      if (payload[i] !== undefined) {
        numberArray.push(payload[i]);
      } else {
        const numberObject = Object.assign({}, numberDefaultObject);
        
        numberObject.id = randomNumber(1, 1000);
        numberArray.push(numberObject);
      }
    }

    state.phones = numberArray;
  },
  removePhone(state, value) {
    const newArray = state.phones.map((phone, index) => {
      if (index === value) {
        return numberDefaultObject;
      } else {
        return phone;
      }
    });

    state.phones = newArray;
  },
  setEmail(state, payload) {
    state.email = payload;
  },
  setLocation(state, payload) {
    state.location = payload.data;
  },
  setSocials(state, payload) {
    payload.forEach(item => {
      state.socials.forEach(stateSocial => {
        if(stateSocial.name == item.name) {
          stateSocial.link = item.link
        }
      })
    });
  },
  setSchedule(state, { data }) {
    state.schedule = data;
  },
  setPageLoading(state, value) {
    state.pageLoading = value;
  },
  setSaveLoading(state, value) {
    state.saveLoading = value;
  },
}

let actions = {
  async fetchSettings({ commit }) {
    commit('setPageLoading', true);
    try {
      const { data } = await axios.get('/api/admin/settings');

      commit('setPhones', data.phones);
      commit('setEmail', data.email.data[0]);
      commit('setLocation', data.location);
      commit('setSocials', data.socials);
      commit('setSchedule', data.schedule);

    } catch(error) {
      console.log(error);
    }
    commit('setPageLoading', false);
  },

  async saveSettings({ commit, state }) {
    commit('setSaveLoading', true);

    try {
      const  data  = await axios.post('/api/admin/settings', {
        email: state.email,
        phones: filterNumber(state.phones),
        location: state.location,
        socials: state.socials,
        schedule: state.schedule,
      });

      commit('setOptionShowMessage', {
        show: true,
        text: 'Налаштування збережено'
      });
    } catch(error) {
      if (error.response && error.response.status == 422) {
        const errors = error.response.data.errors;
        console.log(errors)
      }
      console.log(error);
    }
    commit('setSaveLoading', false);
  },
}

const getters = {
  pageLoading: state => state.pageLoading,
  saveLoading: state => state.saveLoading,
  phones: state => state.phones,
  email: state => state.email,
  location: state => state.location,
  socials: state => state.socials,
  schedule: state => state.schedule,
}

export default { state, mutations, actions, getters }
