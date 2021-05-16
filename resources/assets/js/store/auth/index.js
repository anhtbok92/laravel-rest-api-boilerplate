import * as MutationTypes from './MutationTypes';
import Cookies from "js-cookie";
import axios from "axios";

const state = {
    user: {
        name: ''
    },
    token: Cookies.get('auth_token')
};

const mutations = {
    [MutationTypes.LOGIN](state, response) {
        Cookies.set('auth_token', response.data.data.access_token);
        state.token = response.data.data.access_token;
        state.user.name = response.data.data.user.username;
    },
    [MutationTypes.LOGOUT](state) {
        state.token = '';
        state.user.name = '';
        Cookies.remove('auth_token')
    },
    [MutationTypes.FETCH_USER_SUCCESS](state, user) {
        state.user.name = user.name;
    },
    [MutationTypes.FETCH_USER_FAILURE](state) {
        state.user.name = '';
        state.token = '';
    },
    [MutationTypes.UPDATE_USER](state, user) {
        state.user.name = user.name;
    }
};
const actions = {
    [MutationTypes.LOGIN]({commit}, response) {
        commit(MutationTypes.LOGIN, response);
    },
    [MutationTypes.LOGOUT]({commit}) {
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
    authUser: state => state.user,
    authToken: state => state.token,
    isLoggedIn: state => state.token !== undefined
};
export default {
    state,
    mutations,
    actions,
    getters
}
