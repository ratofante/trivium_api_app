import Axios from 'axios'

Axios.defaults.withCredentials = true
Axios.defaults.withXSRFToken = true

const axios = Axios.create({
  baseURL: 'http://localhost:8000',
  timeout: 60000,
  withCredentials: true,
  xsrfCookieName: 'XSRF-TOKEN',
  xsrfHeaderName: 'X-XSRF-TOKEN',
  header: {
    Accept: 'applicaction/json'
  }
})

axios.interceptors.response.use(null, (err) => {
  const error = {
    status: err.response?.status,
    original: err,
    validation: {},
    message: null
  }

  switch (err.response?.status) {
    case 422:
      for (let field in err.response.data.errors) {
        error.validation[field] = err.response.data.errors[field][0]
      }
      break
    case 403:
      error.message = "Unauthorized action. You're not allowed to do that"
      break
    case 401:
      error.message = 'Please re-login'
      break
    default:
      error.message = 'Something went wrong. Please try again later. This is a generic error.'

      break
  }

  return Promise.reject(error)
})

export default axios
