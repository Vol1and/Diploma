import Vue from 'vue'
import Vuex from 'vuex'
import producers from './modules/producers'
import pricetypes from './modules/pricetypes'
import nomenclature from './modules/nomenclature'
import agents from "./modules/agents";
import income from "./modules/income";
import storages from "./modules/storages";
import selling from "./modules/selling";
import cancellations from "./modules/cancellations";

Vue.use(Vuex)


// здесь инициализируется хранилище - из разных файлов в которых инициализируются модули хранилища
export default new Vuex.Store({
    modules: {
        producers,
        pricetypes,
        nomenclature,
        agents,
        income,
        storages,
        selling,
        cancellations
    },
})
