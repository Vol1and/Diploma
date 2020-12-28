

require('./code/bootstrap');
window.Vue = require('vue');
require('./code/component_init')


require('./store')


//npm-модуль с механикой раутинга
import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.use(require('vue-shortkey'))

import VModal from 'vue-js-modal'
Vue.use(VModal, {dialog: true})


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
