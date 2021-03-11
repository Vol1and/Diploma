import Vue from 'vue'
//npm-модуль с механикой раутинга
import VueRouter from 'vue-router'
import vue_shortkey from "vue-shortkey";
import ElementUI from 'element-ui';

import 'element-ui/lib/theme-chalk/index.css';
//import 'element-ui/lib/theme-chalk/reset.css'
import locale from 'element-ui/lib/locale/lang/ru-RU'
import route_file from './code/routes.js';
//импортируем хранилище из соответствующего модуля
import store from './store/index'


// Load the full build.
//var _ = require('lodash.');
//// Load the core build.
//var _ = require('lodash/core');
//// Load the FP build for immutable auto-curried iteratee-first data-last methods.
//var fp = require('lodash/fp');
//
//// Load method categories.
//var array = require('lodash/array');
//var object = require('lodash/fp/object');
//
//// Cherry-pick methods for smaller browserify/rollup/webpack bundles.
//var at = require('lodash/at');
//var curryN = require('lodash/fp/curryN');
//

require('./code/bootstrap');
window.Vue = require('vue');
require('./code/component_init')


require('./store')


Vue.use(VueRouter)

Vue.use(vue_shortkey)

Vue.use(ElementUI, {locale});

//Инициализация раутов

let routes = route_file.routes;


const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`,
    mode: 'history'
})

const app = new Vue({
    router,
    store: store
}).$mount('#app')


router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (isAuthenticated()) {
            next()
        } else {
            next({name: "login"}) // back to safety route //
        }
    } else {
        next()
    }
})


function isAuthenticated() {

    return app.$store.getters["auth/isAuthenticated"]
}
