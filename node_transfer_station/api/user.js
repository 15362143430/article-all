const express = require('express');
const router = express.Router();
const transfer = require('../tool/transfer');

// 获取用户列表
router.get('/users/:pageNum/:pageSize', async (req, res) => {
    transfer('get', `users/${req.params.pageNum}/${req.params.pageSize}`, res);
});

// 搜索用户列表
router.get('/users/:pageNum/:pageSize/:name', async (req, res) => {
    transfer('get', `users/${req.params.pageNum}/${req.params.pageSize}/${req.params.name}`, res);
});

// 获取用户定位列表
router.get('/userPosition/:pageNum/:pageSize', async (req, res) => {
    transfer('get', `userPosition/${req.params.pageNum}/${req.params.pageSize}`, res);
});

// 删除视频
router.delete('/user/:id', async (req, res) => {
    transfer('delete', `user`, res, req.params.id);
})

// 用户登录
router.post('/login', async (req, res) => {
    // console.log(req.body)
    transfer('post', `login`, res, req.body);
})

// 获取用户信息
router.get('/user/:id', async (req, res) => {
    transfer('get', `user/${req.params.id}`, res);
})

// 编辑用户信息
router.put('/user', async (req, res) => {
    transfer('put', `user`, res, req.body);
})

module.exports = router;