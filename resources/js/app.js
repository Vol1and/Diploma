/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//npm-модуль с пагинацией
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

//npm-модуль с механикой раутинга
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import ProducerIndex from "./components/Producer/Index";
import ProducerCreate from "./components/Producer/Create";
import Home from "./components/Home";






//Инициализация компонентов
Vue.component('ProducerIndex', ProducerIndex.default);
Vue.component('ProducerCreate', ProducerCreate.default);
Vue.component('HomeComponent', Home.default);

//Инициализация раутов
const routes = [
    { path: '/producers',name: "producers.index", component: ProducerIndex },
    { path: '/producers/create',name: "producers.create", component: ProducerCreate },
    { path: '/',name: "home.index", component: Home }
]




// Создаём экземпляр маршрутизатора и передаём маршруты в опции `routes`
const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`,
    mode: 'history'
})


const app = new Vue({
    router
}).$mount('#app')
