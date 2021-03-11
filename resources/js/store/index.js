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
import workplaces from "./modules/workplaces";
import auth from "./modules/auth";
import createPersistedState from "vuex-persistedstate";

import transfers from "./modules/transfers";

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
        cancellations,
        workplaces,
        auth,
        transfers
    },
    state: {
        errors: [],
        workplace: null
    },

    getters: {
        errors: state => state.errors,
        workplace: state => state.workplace,
    },

    mutations: {
        setErrors(state, errors) {
            state.errors = errors;
        },
        setWorkplace(state, workplace) {
            state.workplace = workplace;
        },
        deleteWorkplace(state) {
            state.workplace = null;
        }
    },
    actions: {
        setWorkplace(context,data) {
            return new Promise((resolve, reject) => {

                context.commit('setWorkplace', data.workplace);
                resolve();
            });

        },
        deleteWorkplace(context,data) {
            return new Promise((resolve, reject) => {

                context.commit('deleteWorkplace');
                resolve();
            });

        },
    },
    plugins: [createPersistedState()],

})


