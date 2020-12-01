/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//npm-модуль с пагинацией
import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

//npm-модуль с механикой раутинга
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import ProducerIndex from "./components/Producer/Index.vue";







//Инициализация компонентов
Vue.component('home-component', require('./components/HomeComponent').default);
Vue.component('ProducerIndex', require('./components/Producer/Index').default);

//Инициализация раутов
const routes = [
    { path: '/producers',name: "producers.index", component: ProducerIndex }
]


// Создаём экземпляр маршрутизатора и передаём маршруты в опции `routes`
const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`,
    mode: 'history'
})


const app = new Vue({
    router
}).$mount('#app')
