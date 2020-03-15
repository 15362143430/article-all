const proxyMiddleWare = require('http-proxy-middleware');
const proxyPath = 'http://localhost:85/index.php/article'; //目标后端服务地址
// const proxyOption = {
//     target: proxyPath,
//     changeOrigoin: true
// };
// app.use(express.static('./public'));
exports.article = proxyMiddleWare('/article', { target: proxyPath });