// 使用了superagent来发起请求
const superagent = require('superagent');
const fs = require('fs');
const path = require('path');
const dir = path.resolve(__dirname, '../访问日志.md');

const baseUrl = 'http://localhost:85/index.php/';

const transfer = function (method, url, res, params = {}) {
    var date = DateShow();
    //向文件追加内容
    fs.appendFile(dir, `${date}---${baseUrl}${url}/${params}<br/>`, 'utf-8', function (err) {
        if (err) {
            console.log(err);
            return false;
        }
        // console.log('写入成功!!!');
    });
    switch (method) {
        case 'get_operation':
            return sreq = superagent.get(`${baseUrl}${url}`);
            break;
        case 'get':
            var sreq = superagent.get(`${baseUrl}${url}`);
            break;
        case 'post':
            var sreq = superagent.post(`${baseUrl}${url}`).send(params);
            break;
        case 'put':
            var sreq = superagent.put(`${baseUrl}${url}`).send(params);
            break;
        case 'delete':
            var sreq = superagent.del(`${baseUrl}${url}/${params}`);
            break;

    }
    // 查询本机ip，这里需要根据实际情况选择get还是post
    sreq.pipe(res);
    sreq.on('end', function () {
        console.log('done');
    })
}

function DateShow() {
    var date = new Date(); //实例一个时间对象；
    var year = date.getFullYear(); //获取系统的年；
    var month = date.getMonth() + 1; //获取系统月份，由于月份是从0开始计算，所以要加1
    var day = date.getDate();
    // 获取系统日
    var hour = date.getHours(); //获取系统时间
    var minute = date.getMinutes(); //分
    var second = date.getSeconds(); //秒
    return `${year}年${month}月${day}日${hour}:${minute}:${second}`
}

module.exports = transfer;