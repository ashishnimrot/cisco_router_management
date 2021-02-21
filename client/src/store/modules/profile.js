import * as types from "@/store/mutation-types";
import api from "@/services/api/profile";
import { buildSuccess, handleError } from "@/utils/utils.js";

const getters = {
  profile: (state) => state.profile,
};

const actions = {
  changeMyPassword({ commit }, payload) {
    return new Promise((resolve, reject) => {
      commit(types.SHOW_LOADING, true);
      api
        .changeMyPassword(payload)
        .then((response) => {
          if (response.status === 200) {
            buildSuccess(
              {
                msg: "myProfile.PASSWORD_CHANGED",
              },
              commit,
              resolve
            );
          }
        })
        .catch((error) => {
          handleError(error, commit, reject);
        });
    });
  },
  getProfile({ commit }) {
    return new Promise((resolve, reject) => {
      commit(types.SHOW_LOADING, true);
      api
        .getProfile()
        .then((response) => {
          if (response.status === 200) {
            commit(types.FILL_PROFILE, response.data);
            buildSuccess(null, commit, resolve);
          }
        })
        .catch((error) => {
          handleError(error, commit, reject);
        });
    });
  },
  saveProfile({ commit }, payload) {
    return new Promise((resolve, reject) => {
      commit(types.SHOW_LOADING, true);
      api
        .saveProfile(payload)
        .then((response) => {
          if (response.status === 200) {
            commit(types.FILL_PROFILE, response.data);
            buildSuccess(
              {
                msg: "myProfile.PROFILE_SAVED_SUCCESSFULLY",
              },
              commit,
              resolve
            );
          }
        })
        .catch((error) => {
          handleError(error, commit, reject);
        });
    });
  },
  addProfileData({ commit }, data) {
    commit(types.ADD_PROFILE_DATA, data);
  },
};

const mutations = {
  [types.FILL_PROFILE](state, { data }) {
    state.profile.name = data.name;
    state.profile.email = data.email;
  },
  [types.ADD_PROFILE_DATA](state, data) {
    switch (data.key) {
      case "name":
        state.profile.name = data.value;
        break;
      case "email":
        state.profile.email = data.value;
        break;
      default:
        break;
    }
  },
};

const state = {
  profile: {
    name: "",
    email: "",
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
