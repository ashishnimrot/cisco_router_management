import axios from 'axios'

export default {
  userSignUp(payload) {
    return axios.post('/auth/register', payload)
  }
}
