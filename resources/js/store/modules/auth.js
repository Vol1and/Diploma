import axios from "axios";

export default {
    namespaced: true,

    state: {
        userData: null,
        userRole: null
    },

    getters: {
        user: state => state.userData,

        role: state => state.userRole,
        isAuthenticated: state => state.userData != null
    },

    mutations: {
        setUserData(state, user) {
            state.userData = user;
        },
        setUserRole(state, role) {
            state.userRole = role;
        }
    },

    actions: {
        getUserData({commit}) {
            axios
                .get("/api/user")
                .then(response => {
                    commit("setUserData", response.data);
                })
                .catch(() => {
                    localStorage.removeItem("authToken");
                });
        },
        sendLoginRequest({commit}, data) {
            commit("setErrors", {}, {root: true});
            return axios
                .post("/api/login", data)
                .then(response => {
                    commit("setUserData", response.data.user);
                    commit("setUserRole", response.data.role);
                    localStorage.setItem("authToken", response.data.token);
                })
        },
        sendLogoutRequest({commit}) {
            axios.post("/api/logout").then(() => {
                commit("setUserData", null);
                commit("setUserRole", null);
                this.$store.dispatch("deleteWorkplace");
                localStorage.removeItem("authToken");
            });
        },
        sendVerifyResendRequest() {
            return axios.get("/api/email/resend");
        },
        sendVerifyRequest({dispatch}, hash) {
            return axios
                .get("/api/email/verify/" + hash)
                .then(() => {
                    dispatch("getUserData");
                });
        }
    }
};
