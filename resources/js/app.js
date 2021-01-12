
import Vue from 'vue'
require('./code/bootstrap');
window.Vue = require('vue');
require('./code/component_init')


require('./store')


//npm-модуль с механикой раутинга
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import vue_shortkey from "vue-shortkey";
Vue.use(vue_shortkey)

import ElementUI from 'element-ui';

import 'element-ui/lib/theme-chalk/index.css';
//import 'element-ui/lib/theme-chalk/reset.css'

import locale from 'element-ui/lib/locale/lang/ru-RU'
Vue.use(ElementUI, {locale});

//Инициализация раутов

import route_file from './code/routes.js';

let routes = route_file.routes;



const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`,
    mode: 'history'
})
//импортируем хранилище из соответствующего модуля
import store from './store/index'

const app = new Vue({
    router,
    store: store
}).$mount('#app')
