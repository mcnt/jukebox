import axios from 'axios'

const API_URL = 'api'

class IndexService {
  get() {
    return axios.get(API_URL)
  }

  getId(id) {
    return axios.get(`${API_URL}/${id}`)
  }

  add(dados) {
    return axios.post(API_URL, dados)
  }

  update(id, dados) {
    return axios.put(`${API_URL}/${id}`, dados)
  }

  delete(id) {
    return axios.delete(`${API_URL}/${id}`)
  }
}

export default new IndexService()
