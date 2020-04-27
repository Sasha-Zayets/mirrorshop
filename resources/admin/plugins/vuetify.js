// import 'font-awesome/css/font-awesome.min.css';
import 'vuetify/dist/vuetify.min.css';
import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

const opts = {
    icons: {
        iconfont: 'fab',
    },
    theme: {
        dark: false,
    },
};

export default new Vuetify(opts);