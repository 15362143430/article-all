import axios from 'axios';
axios.defaults.baseURL = "http://localhost:85/index.php/";

export function httpGet(url) {
    return axios.get(url);
}