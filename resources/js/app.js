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
