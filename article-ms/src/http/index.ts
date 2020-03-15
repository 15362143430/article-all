import axios from 'axios';
axios.defaults.baseURL = 'http://localhost:3001/';
// let instance = axios.create({
//     baseURL: 'http://localhost:3001/'
// });
let position = axios.create({
    baseURL: 'http://ip-api.com/json'
});
import qs from 'qs';

import {
    Loading,
    Message
} from 'element-ui'; //引入Loading服务
//开始加载动画
let loading: any;

function startLoading() {
    loading = Loading.service({
        lock: true, //是否锁定
        text: '拼命加载中...', //加载中需要显示的文字
        background: 'rgba(0,0,0,.7)', //背景颜色
    });
}
//结束加载动画
function endLoading() {
    loading.close();
}
//请求拦截
axios.interceptors.request.use(config => {
    startLoading(); //请求时的加载动画

    //设置请求头
    // if (localStorage.eleToken) {
    //     config.headers.Authorization = localStorage.eleToken;
    // }

    return config; //加载动画的时候把config return 回去
}, error => {
    return Promise.reject(error)
})
//响应拦截
axios.interceptors.response.use(response => {
    endLoading(); //结束加载动画
    return response; //结束时把response return回去
}, error => {
    //错误提醒
    endLoading() //如果错误也结束动画
    // Message.error(error.response.data)

    // //获取错误状态码
    // const { status } = error.response;
    // if (status == 401) {
    //     Message.error("token失效请重新登录");
    //     //清除token
    //     localStorage.removeItem("eleToken")
    //     router.push("/");
    // }

    return Promise.reject(error)
})



export function httpLogin(data = {}) {
    return axios.post('login', qs.stringify(data));
};

export function httpRegister(data = {}) {
    return axios.post('register', qs.stringify(data));
};

export function httpGET(url: string) {
    return axios.get(url);
};


export function getList(url: string, pageNum: number = 1, pageSize: number = 5, urlType: any = '') {
    if (urlType !== '') {
        return axios.get(`${url}/${pageNum}/${pageSize}/${urlType}`);
    }
    return axios.get(`${url}/${pageNum}/${pageSize}`);
};

export function httpDelete(that: any, url: string, params: any) {
    // data = qs.stringify(data);
    return new Promise((resolve) => {
        that.$confirm('此操作将永久删除, 是否继续?', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
        }).then(() => {
            resolve(axios.delete(`${url}/${params}`))
        }).catch(() => {
            that.$message({
                type: 'info',
                message: '已取消删除'
            });
        });
    })

}

export function httpPut(url: string, params: any) {
    return axios.put(url, params)
}

export function httpPost(url: string, params: any) {
    return axios.post(url, params)
}

export function httpPositon(){
    return position.get('');
}

