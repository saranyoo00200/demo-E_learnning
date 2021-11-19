import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem("auth") || "",
        user_id: localStorage.getItem("user_id") || "",
        user_name: localStorage.getItem("user_name") || "",
        user_type: localStorage.getItem("user_type") || "",
        registerCourseId: ""
    },
    mutations: {
        setToken(state, token) {
            localStorage.setItem("auth", token);
            state.token = token;
        },
        clearToken(state) {
            localStorage.removeItem("auth");
            state.token = "";
        },
        addUser_id(state, Uid) {
            localStorage.setItem("user_id", Uid);
            state.user_id = Uid;
        },
        clearUser_id(state) {
            localStorage.removeItem("user_id");
            state.user_id = "";
        },
        addUser_name(state, Uname) {
            localStorage.setItem("user_name", Uname);
            state.user_name = Uname;
        },
        clearUser_name(state) {
            localStorage.removeItem("user_name");
            state.user_name = "";
        },
        addUser_user_type(state, user_type) {
            localStorage.setItem("user_type", user_type);
            state.user_type = user_type;
        },
        clearUser_user_type(state) {
            localStorage.removeItem("user_type");
            state.user_type = "";
        },
        addCourse_id(state, Cid) {
            state.registerCourseId = Cid;
        }
    }
});
