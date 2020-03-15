const express = require('express');
const app = express();

var bodyparser = require('body-parser');
app.use(bodyparser.urlencoded({extende:true}));
app.use(bodyparser.json())

app.use(require('cors')());
app.use(express.json());

const common = require('./common');

// 不涉及文件的接口
app.use('/',common);
// 涉及文章文件接口
app.use(require('./api/api_upload').article);
// 涉及视频文件接口
app.use(require('./api/api_upload').video);
// 注册接口
app.use(require('./api/api_upload').register);
// 数据库接口
app.use(require('./api/api_upload').database);

app.listen(3001);
console.log('Express started on 127.0.0.1:3001');
