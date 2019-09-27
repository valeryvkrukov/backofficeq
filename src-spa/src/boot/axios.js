import axios from 'axios'
import { Cookies } from 'quasar'
import store from '../store'

export default async ({ Vue }) => {
  const pending = {}
  const removePending = (config, f) => {
    const url = config.url.replace(config.baseURL, '/')
    const flagUrl = url + '&' + config.method + '&' + JSON.stringify(config.params)
    if (flagUrl in pending) {
      if (f) {
        f()
      } else {
        delete pending[flagUrl]
      }
    } else {
      if (f) {
        pending[flagUrl] = f
      }
    }
  }
  Vue.prototype.$axios = axios

  if (Cookies.has('token')) {
    Vue.prototype.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + Cookies.get('token')
  }

  const baseURL = process.env.api
  if (typeof baseURL !== 'undefined') {
    Vue.prototype.$axios.defaults.baseURL = baseURL
  }
  Vue.prototype.$axios.interceptors.request.use(config => {
    config.cancelToken = new axios.CancelToken((c) => {
      removePending(config, c)
    })
    if (Cookies.has('token')) {
      config.headers['Authorization'] = 'Bearer ' + Cookies.get('token')
    }
    return config
  })
  Vue.prototype.$axios.interceptors.response.use(undefined, function (error) {
    return new Promise((resolve, reject) => {
      if (!axios.isCancel(error)) {
        if (error.response.status === 401) {
          store.dispatch('logout')
        }
        if (error.response.status === 403) {
          store.dispatch('forbidden')
        }
        removePending(error.config)
        return reject(error)
      } else {
        return resolve({})
      }
    })
  })
  Vue.prototype.$axios.clear = () => {
    Object.keys(pending).map(e => {
      if (pending[e]) {
        pending[e]()
        delete pending[e]
      }
    })
  }
}
