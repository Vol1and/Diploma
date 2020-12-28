import Vue from 'vue'
import Vuex from 'vuex'
import producers from './modules/producers'
import pricetypes from './modules/pricetypes'
import nomenclature from './modules/nomenclature'

Vue.use(Vuex)



// здесь инициализируется хранилище - из разных файлов в которых инициализируются модули хранилища
export default new Vuex.Store({
    modules: {
        producers,
        pricetypes,
        nomenclature
    },
})
