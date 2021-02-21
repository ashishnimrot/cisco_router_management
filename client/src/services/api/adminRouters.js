import axios from "axios";

export default {
  getRouters(params) {
    return axios.get("/router", { params });
  },
  getRouterFilters(payload) {
    return axios.post("/router/filter", payload);
  },
  editRouter(id, payload) {
    return axios.patch(`/router/${id}`, payload);
  },
  saveRouter(payload) {
    return axios.post("/router/", payload);
  },
  deleteRouter(id) {
    return axios.delete(`/router/${id}`);
  },
};
