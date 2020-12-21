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

//npm-модуль с механикой раутинга
import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.use(require('vue-shortkey'))


import VModal from 'vue-js-modal'
Vue.use(VModal, { dialog: true })


import NormativeInfo from "./components/Menu/NormativeInfo";

import ProducerIndex from "./components/Producer/Index";
import ProducerCreate from "./components/Producer/Create";
import ProducerEdit from "./components/Producer/Edit";


import PriceTypeIndex from "./components/PriceType/Index";
import PriceTypeCreate from "./components/PriceType/Create";
import PriceTypeEdit from "./components/PriceType/Edit";


import NomenclatureIndex from "./components/Nomenclature/Index";
import NomenclatureCreate from "./components/Nomenclature/Create";
import NomenclatureEdit from "./components/Nomenclature/Edit";

import CharacteristicForNomenclature from "./components/Characteristic/ForNomenclature";


import Home from "./components/Home";






//Инициализация компонентов
Vue.component('error-component', require('./components/Layouts/Error').default);

Vue.component('NormativeInfo',      NormativeInfo.default);

Vue.component('ProducerIndex',      ProducerIndex.default);
Vue.component('ProducerCreate',     ProducerCreate.default);
Vue.component('ProducerEdit',       ProducerEdit.default);
Vue.component('producer-choose-component',
    require('./components/Producer/Choose').default);

Vue.component('PriceTypeIndex',     PriceTypeIndex.default);
Vue.component('PriceTypeCreate',    PriceTypeCreate.default);
Vue.component('PriceTypeEdit',      PriceTypeEdit.default);
Vue.component('price-type-choose-component',
    require('./components/PriceType/Choose').default);

Vue.component('NomenclatureIndex',    NomenclatureIndex.default);
Vue.component('NomenclatureCreate',   NomenclatureCreate.default);
Vue.component('NomenclatureEdit',     NomenclatureEdit.default);

Vue.component('CharacteristicForNomenclature',     CharacteristicForNomenclature.default);

Vue.component('HomeComponent',      Home.default);



//Инициализация раутов

import route_file from './routes.js';

let routes = route_file.routes;



// Создаём экземпляр маршрутизатора и передаём маршруты в опции `routes`
const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`,
    mode: 'history'
})


const app = new Vue({
    router
}).$mount('#app')
