const proxyMiddleWare = require('http-proxy-middleware');
const proxyPath = 'http://localhost:85/index.php/video'; //目标后端服务地址
// const proxyOption = {
//     target: proxyPath,
//     changeOrigoin: true
// };
// app.use(express.static('./public'));
exports.video = proxyMiddleWare('/video', { target: proxyPath });