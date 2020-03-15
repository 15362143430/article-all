const express = require('express');
const router = express.Router();
const transfer = require('../tool/transfer');

//获取所有分类的视频列表
router.get('/videos', async (req, res) => {
    transfer('get', 'videos', res);
});

// 获取所有视频列表
router.get('/videosms/:pageNum/:pageSize', async (req, res) => {
    transfer('get', `videosms/${req.params.pageNum}/${req.params.pageSize}`, res);
});

//根据id获取视频详情
router.get('/video/:id', async (req, res) => {
    transfer('get', `video/${req.params.id}`, res);
});

//根据type获取类似视频列表
router.get('/videosbytype', async (req, res) => {
    transfer('get', `videosbytype?type=${req.query.type}`, res);
});

//获取视频分类列表
router.get('/videostype', async (req, res) => {
    transfer('get', `videostype`, res);
});

// 删除视频
router.delete('/video/:id', async (req, res) => {
    transfer('delete', `video`, res, req.params.id);
})

// 获取视频类型选择框
router.get('/videoTypeSelect', async (req,res) => {
    transfer('get', `videoTypeSelect`, res);
} )

// 修改视频信息
router.put('/video', async (req,res)=>{
    // console.log(req)
    transfer('put', `video`, res, req.body);
})
module.exports = router;