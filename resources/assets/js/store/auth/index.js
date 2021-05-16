import * as MutationTypes from './MutationTypes';
import axios from "axios";

const state = {
    user: JSON.parse(localStorage.getItem('user')),
    token: localStorage.getItem('auth_token')
};

const mutations = {
    [MutationTypes.LOGIN](state, response) {
        localStorage.setItem('auth_token', response.data.data.access_token);
        localStorage.setItem('user', JSON.stringify(response.data.data.user));
        state.token = response.data.data.access_token;
        state.user = response.data.data.user;
    },
    [MutationTypes.LOGOUT](state) {
        state.token = '';
        state.user = '';
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
    }
};
const actions = {
    [MutationTypes.LOGIN]({commit}, response) {
        commit(MutationTypes.LOGIN, response);
    },
    [MutationTypes.LOGOUT]({commit}, router) {
        axios.post('/api/auth/logout')
            .then((response) => {
                if (response.data.code === 200) {
                    commit(MutationTypes.LOGOUT);
                    router.router.push('/')
                } else {
                    alert("System error. Logout failed !");
                }
            });
    }
};
const getters = {
    authUser: state => {
        return state.user
    },
    authToken: state => state.token,
    isLoggedIn: state => {
        return state.token !== undefined && state.token !== "" && state.token !== null
    }
};
export default {
    state,
    mutations,
    actions,
    getters
}
