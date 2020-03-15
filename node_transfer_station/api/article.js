const express = require('express');
const router = express.Router();
const transfer = require('../tool/transfer');
const bodyParser = require('body-parser');
const fs = require('fs');

// 创建application/json 解析器


// 获取最新文章列表
router.get('/articles/:pageNum/:pageSize', async (req, res) => {
    transfer('get', `articles/${req.params.pageNum}/${req.params.pageSize}`, res);
});

// 根据类型获取文章列表
router.get('/articles/:pageNum/:pageSize/:type', async (req, res) => {
    transfer('get', `articles/${req.params.pageNum}/${req.params.pageSize}/${req.params.type}`, res);
});

// 根据类型获取文章列表
router.get('/articles/:pageNum/:pageSize/:type/:title', async (req, res) => {
    transfer('get', `articles/${req.params.pageNum}/${req.params.pageSize}/${req.params.type}/${req.params.title}`, res);
});

// 根据id获取文章详情
router.get('/article/:id', async (req, res) => {
    transfer('get', `article/${req.params.id}`, res);
});

// 根据id获取文章内容
router.get('/articlemd/:id', async (req, res) => {
    transfer('get', `articlemd/${req.params.id}`, res);
});

// 获取文章类型选择框
router.get('/articleTypeSelect', async (req, res) => {
    transfer('get', `/articleTypeSelect`, res);
});

// 根据id获取文章内容
// router.post('/article', upload.single('article_md'), async (req, res) => {
//     // console.log(fs.createReadStream(req.file.path));
//     const fileData = fs.readFileSync(req.file.path);
//     // console.log(fileData.toString('base64'));
//     const params = req.body;
//     params.article_md = fileData.toString('base64');
//     transfer('post', '/article', res, params);
// });

// router.post('/article', multipartyMiddleware, async (req, res) => {
//     const fileData = fs.readFileSync('./upload/2020-3-9/05d8aaa3bf41a0b08cc2dd382075a890.md');
//     console.log('data:application/octet-stream;base64,' + fileData.toString('base64'));
// });

//获取文章分类列表
router.get('/articlestype', async (req, res) => {
    transfer('get', `articlestype`, res);
});

//删除文章
router.delete('/article/:id', async (req, res) => {
    transfer('delete', `article`, res, req.params.id);
});

// 修改文章信息
router.put('/article', async (req,res)=>{
    // console.log(req.body)
    transfer('put', `article`, res, req.body);
})



module.exports = router;