const express = require('express');
const router = express.Router();

const article = require('./api/article');
const video = require('./api/video');
const menu = require('./api/menu');
const power = require('./api/power');
const user = require('./api/user');

// 文章接口路由
router.use('',article);
// 视频接口路由
router.use('',video);
// 菜单接口路由
router.use('',menu);
// 权限接口路由
router.use('',power);
// 用户接口路由
router.use('',user);


module.exports = router;