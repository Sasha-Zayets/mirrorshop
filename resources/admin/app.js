import Vue from 'vue';
import router from './router/index';
import store from './store/index';
import vuetify from './plugins/vuetify';

import App from './App';
new Vue({
    vuetify,
    store,
    router,
    render: h => h(App)
}).$mount('#app')
