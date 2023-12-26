import { boot } from 'quasar/wrappers'
import axios from 'axios'

const api = axios.create({ 
  baseURL: 'http://127.0.0.1:8000/api/' ,
  responseType: "json",
    responseEncoding: "utf8",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
    },
})

api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')

  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }

  return config
}, (err) => {
  return Promise.reject(err)
})


api.interceptors.response.use((response) => {
  return response
}, (error) => {
  if (error.response.status === 401) {
    window.location = '#/login'
  }

  return Promise.reject(error)
})

api.defaults.headers.common['Authorization'] =  true

export default boot(({ app }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  app.config.globalProperties.$axios = axios
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
})

export { axios, api }