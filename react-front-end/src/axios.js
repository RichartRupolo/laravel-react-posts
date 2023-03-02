import axios from "axios";

const axiosClient = axios.create({
  baseURL: `http://localhost:8091/api`,
});

axiosClient.interceptors.request.use((config) => {

  config.headers.Authorization = `Bearer ${localStorage.getItem('TOKEN')}`
console.log(config.headers.Authorization);
  
  return config
});

axiosClient.interceptors.response.use(response => {
  return response;
}, error => {
  if (error.response && error.response.status === 401) {
    localStorage.removeItem('TOKEN')
    window.location.reload();
    return error;
  }
  throw error;
})
export default axiosClient;