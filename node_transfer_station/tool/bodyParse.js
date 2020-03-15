const bodyParser = require('body-parser');

// 创建application/json 解析器
const jsonParser = bodyParser.json();

// 创建 application/x-www-form-urlencoded 解析器
const urlencodedParser = bodyParser.urlencoded({
    extended: false
});


