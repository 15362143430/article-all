const express = require('express');
const router = express.Router();
const transfer = require('../tool/transfer');
const toTree = require('../tool/common_methods').toTree;


router.get('/rights/:pageNum/:pageSize', async (req, res) => {
    transfer('get', `rights/${req.params.pageNum}/${req.params.pageSize}`, res);
})

router.get('/roles', async (req, res) => {
    let role_data = await transfer('get_operation', 'roles', res);
    let role_res_parse = JSON.parse(role_data.text);
    // console.log(menu_res_parse);
    if (role_res_parse.meta.status === 200) {
        for (let i of role_res_parse.data) {
            i.children = toTree(i.children);
        }
        res.send(role_res_parse);
    } else {
        res.send(role_res_parse);
    }
})

router.get('/menus/:level', async (req, res) => {
    let menu_res = await transfer('get_operation', `menus/${req.params.level}`, res);
    let menu_res_parse = JSON.parse(menu_res.text);
    // console.log(menu_res_parse)
    if (menu_res_parse.meta.status === 200) {
        menu_res_parse.data = toTree(menu_res_parse.data);
        res.send(menu_res_parse);
    } else {
        res.send(menu_res_parse);
    }
})

// 编辑角色
router.put('/role', async (req, res) => {
    transfer('put', `role`, res, req.body);
})


// 获取角色信息
router.get('/role/:id', async (req, res) => {
    transfer('get', `role/${req.params.id}`, res);
})

// 获取角色选择框
router.get('/roleTypeSelect', async (req, res) => {
    transfer('get', `roleTypeSelect`, res);
})

// 获取角色选择框
router.put('/right', async (req, res) => {
    transfer('put', `right`, res, req.body);
})

// 删除权限
router.delete('/right/:role_id/:operation_id', async (req,res)=>{
    transfer('delete', `right`, res, `${req.params.role_id}/${req.params.operation_id}`);
})

// 添加角色
router.post('/role', async (req,res)=>{
    transfer('post', `role`, res, req.body);
})


module.exports = router;