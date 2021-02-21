import * as types from "@/store/mutation-types";
import api from "@/services/api/adminRouters";
import { buildSuccess, handleError } from "@/utils/utils.js";

const getters = {
  routers: (state) => state.routers,
  totalRouters: (state) => state.totalRouters,
};

const actions = {
  getRouterFilters({ commit }, payload) {
    return new Promise((resolve, reject) => {
      api
        .getRouterFilters(payload)
        .then(({ data, status }) => {
          console.table(data.data.data);
          if (status === 200) {
            commit(types.ROUTERS, data.data.data ?? []);
            commit(types.TOTAL_ROUTERS, data.data.total ?? 0);
            resolve();
          }
        })
        .catch((error) => {
          handleError(error, commit, reject);
        });
    });
  },
  editRouter({ commit }, payload) {
    return new Promise((resolve, reject) => {
      const data = {
        sap_id: payload.sap_id,
        hostname: payload.hostname,
        loopback: payload.loopback,
        mac_address: payload.mac_address,
      };
      api
        .editRouter(payload.id, data)
        .then((response) => {
          if (response.status === 200) {
            buildSuccess(
              {
                msg: "common.UPDATED_SUCCESSFULLY",
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
  saveRouter({ commit }, payload) {
    return new Promise((resolve, reject) => {
      api
        .saveRouter(payload)
        .then((response) => {
          if (response.status === 201) {
            buildSuccess(
              {
                msg: "common.SAVED_SUCCESSFULLY",
              },
              commit,
              resolve
            );
          } else if (response.status === 422) {
            buildSuccess(
              {
                msg: "errors.SOMETHING_WENT_WRONG",
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
  deleteRouter({ commit }, payload) {
    return new Promise((resolve, reject) => {
      api
        .deleteRouter(payload)
        .then((response) => {
          if (response.status === 200) {
            buildSuccess(
              {
                msg: "common.DELETED_SUCCESSFULLY",
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
};

const mutations = {
  [types.ROUTERS](state, routers) {
    state.routers = routers;
  },
  [types.TOTAL_ROUTERS](state, value) {
    state.totalRouters = value;
  },
};

const state = {
  routers: [],
  totalRouters: 0,
};

export default {
  state,
  getters,
  actions,
  mutations,
};
