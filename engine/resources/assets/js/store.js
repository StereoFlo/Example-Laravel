import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        workCount: 0
    },
    actions: {
        addCount({commit}, workCount) {
            commit('ADD_COUNT', workCount)
        }
    },
    mutations: {
        ADD_COUNT(state, workCount) {
            state.workCount = workCount;
        }
    },
    getters: {
        count(state) {
            return state.workCount;
        }
    },
    modules: {}
});

export default store;