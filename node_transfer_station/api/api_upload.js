const proxyMiddleWare = require('http-proxy-middleware');

// 文章涉及文件接口
exports.article = proxyMiddleWare('/article', { target: 'http://localhost:85/index.php/article' });
// 视频涉及文件接口
exports.video = proxyMiddleWare('/video', { target: 'http://localhost:85/index.php/video' });
// 注册接口
exports.register = proxyMiddleWare('/register', { target: 'http://localhost:85/index.php/register' });
// 数据库接口
exports.database = proxyMiddleWare('/database', { target: 'http://localhost:85/index.php/database' });