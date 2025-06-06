import axios from 'axios'

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
})

export const getAllEffects = () => api.get('/effects')
export const getEffect = (id) => api.get(`/effects/${id}`)
export const createEffect = (data) => api.post('/effects', data)
export const updateEffect = (id, data) => api.put(`/effects/${id}`, data)
export const deleteEffect = (id) => api.delete(`/effects/${id}`)
