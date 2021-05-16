import * as MutationTypes from './MutationTypes';
import Cookies from "js-cookie";
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
    },
    [MutationTypes.FETCH_USER_SUCCESS](state, user) {
        state.user = user.name;
    },
    [MutationTypes.FETCH_USER_FAILURE](state) {
        state.user = '';
        state.token = '';
    },
    [MutationTypes.UPDATE_USER](state, user) {
        state.user = user.name;
    }
};
const actions = {
    [MutationTypes.LOGIN]({commit}, response) {
        commit(MutationTypes.LOGIN, response);
    },
    [MutationTypes.LOGOUT]({commit}) {
        console.log('action_LOGOUT');
        commit(MutationTypes.LOGOUT);
    },
    [MutationTypes.FETCH_USER_SUCCESS]({commit}, user) {
        commit(MutationTypes.FETCH_USER_SUCCESS, user);
    },
    [MutationTypes.FETCH_USER_FAILURE]({commit}) {
        commit(MutationTypes.FETCH_USER_FAILURE);
    },
    [MutationTypes.FETCH_USER]({commit}) {
        axios.get('/api/auth/user')
            .then((response) => {
                console.log(response);
                if (response.data.meta.status === 'ok') {
                    commit(MutationTypes.FETCH_USER_SUCCESS, response.data.data.user);
                } else {
                    commit(MutationTypes.LOGOUT)
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
