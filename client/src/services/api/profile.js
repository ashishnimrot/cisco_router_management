import axios from "axios";

export default {
  getProfile() {
    return axios.get("/profile");
  },
  saveProfile(payload) {
    return axios.post("/profile", payload);
  },
};
