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
        auth
    },
    state: {
        errors: []
    },

    getters: {
        errors: state => state.errors
    },

    //mutations: {
    //    setErrors(state, errors) {
    //        state.errors = errors;
    //    },
    //    setUser(state, username){
    //        state.user = username
    //    },
//
    //    LogOut(state){
    //        state.user = null
    //        state.posts = null
    //    },
    //},
    //actions: {
//
    //    async LogIn({commit}, User) {
    //        await axios.post('/api/login', User)
    //        await commit('setUser', User.get('username'))
    //    },
    //    async LogOut({commit}){
    //        let user = null
    //        commit('LogOut', user)
    //    }
    //},
    plugins: [createPersistedState()],

})


