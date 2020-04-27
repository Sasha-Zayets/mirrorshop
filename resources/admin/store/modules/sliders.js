import axios from 'axios';
import { slideData } from '../../assets/js/slideData';

const state = {
    sliders: [],
    editSlide: {},
    newSlideImageName: {}
}
const getters = {
    sliders: state => state.sliders,
    editSlide: state => state.editSlide,
    newSlideImageName: state => state.newSlideImageName,
}

const mutations = {
    setSliders(state, payload) {
        state.sliders = payload;
    },
    addNewSlide(state, payload) {
        state.sliders.push(payload);
    },
    deleteSlide(state, id) {
        const newSlider = state.sliders.filter(slide => slide.id !== id);
        state.sliders = newSlider;
    },
    setEditSlide(state, payload) {
        state.editSlide = payload;
    },
    setNewInfoSlide(state, payload) {
        const id = payload.id;
        const newSlides = state.sliders.map(slide => {
            if (slide.id === id) {
                return payload;
            }
            return slide;
        })

        state.sliders = newSlides;
    },
    setNewSlideImageName(state, payload) {
        state.newSlideImageName = {
            ...state.newSlideImageName,
            ...payload
        }
    }
}

const actions = {
    async savePositionSlider({ commit }, payload) {
       try {
            const { data } = await axios.post('/api/admin/sliders/sort', {
                sliders: payload
            });

            commit('setSliders', payload);
       } catch(error) {
           console.log(error);
       }
    },
    async getSlideData({ commit }) {
        try {
            const { data } = await axios.get('/api/admin/sliders/');
            commit('setSliders', data.sliders);
        } catch(error) {
            console.log(error);
        }
    },
    saveInfoSlide({ commit }, payload) {
        commit('setNewInfoSlide', payload);
    },
    async saveSlide({ commit }, payload) {
        const result = await axios.post('/api/admin/sliders', {
            ...payload
        });
        
        commit('addNewSlide', payload);
        commit('setOptionShowMessage', {
            show: true,
            text: 'Слайд додано'
        });
    },
    async updateSlide({ commit }, payload) {
        try {
            const { data } = await axios.put(`/api/admin/sliders/${payload.id}`, {
                ...payload
            });

            if(data !== 'ok') {
                throw 'Оновити слайд не вдалось'
            }

            commit('setOptionShowMessage', {
                type: 'success',
                show: true,
                text: 'Слайд оновлено'
            });
        } catch(error) {
            commit('setOptionShowMessage', {
                type: 'error',
                show: true,
                text: error
            });
        }
    },
    async deleteSlide({ commit }, payload) {
        try {
            await axios.delete(`/api/admin/sliders/${payload.id}`, {
                slide: payload
            });
            
            commit('deleteSlide', payload.id);
            commit('setOptionShowMessage', {
                show: true,
                text: 'Слайд видалено'
            });
        } catch(error) {
            commit('setOptionShowMessage', {
                type: 'error',
                show: true,
                text: 'Слайд видалено'
            });
        }
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}