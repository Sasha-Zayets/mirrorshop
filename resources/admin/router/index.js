import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

// import Layout
import Default from '../layouts/Default/Default';

// import components
import Home from '../pages/Home/Home';
import Settings from '../pages/Settings/Settings';
import Sliders from "../pages/Sliders/Sliders";


const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/wmpanel',
            component: Default,
            children: [
                {
                    path: '',
                    name: 'home',
                    component: Home
                },
                {
                  path: 'sliders',
                  name: 'sliders',
                  component: Sliders,
                },
                {
                    path: 'settings',
                    name: 'settings',
                    component: Settings,
                },
                {
                  path: '*',
                  redirect: {name: 'home'}
                }
            ]
        }
    ]
});

export default router;
