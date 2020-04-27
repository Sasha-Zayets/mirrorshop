import axios from 'axios';
import Cookies from 'js-cookie'

axios.defaults.baseURL = process.env.APP_URL;

export const state = () => ({
    locale: 'ua',
    locales: [
        {
            title: 'ua',
            value: 'ua',
        },
        {
            title: 'ru',
            value: 'ru',
        }
    ],
    phoneList: [],
    socialLink: [],
    emailContact: '',
    address: '',
    workTime: [],
    sliders: [],
});

export const getters = {
    locale: state => state.locale,
    locales: state => state.locales,
    phoneList: state => state.phoneList,
    socialLink: state => state.socialLink,
    emailContact: state => state.emailContact,
    address: state => state.address,
    workTime: state => state.workTime,
    sliders: state=> state.sliders,
}

export const mutations = {
    SET_LOCALE (state, locale ) {
        state.locale = locale;
    },
    setPhoneList(state, payload) {
        state.phoneList = payload;
    },
    setSocialList(state, payload) {
        state.socialLink = payload;
    },
    setEmailContact(state, value) {
        state.emailContact = value;
    },
    setAddress(state, value) {
        state.address = value;
    },
    setWorkTime(state, payload) {
        state.workTime = payload;
    },
    setSliders(state, payload) {
        state.sliders = payload;
    }
}

export const actions = {
    async nuxtServerInit({ commit }) {
        try {
            const { data }  = await axios.get('/api/settings/');

            commit('setPhoneList', data.phones);
            commit('setSocialList', data.socials);
            commit('setEmailContact', data.email.data[0]);
            commit('setAddress', data.location.data);
            commit('setWorkTime', data.schedule.data);
        } catch (error) {
            console.log(error);
        }
    },
    async getSlides({ commit }) {
        try {
            const { data } = await axios.get('/api/sliders/');
            commit('setSliders', data.sliders);
        } catch(error) {
            console.log(error);
        }
    },
    setLocale ({ commit }, locale) {
        commit('SET_LOCALE', locale);
  
      Cookies.set('locale', locale, { expires: 365 })
    },
    async submitForm({}, {name, phone}) {
        try {
            const result = await axios.post('/api/submit-form', {
                name,
                phone
            });

            return result;
        } catch(error) {
            console.log(error);
        }
    }
}