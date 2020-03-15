const express = require('express');
const router = express.Router();
const transfer = require('../tool/transfer');
const toTree = require('../tool/common_methods').toTree; 

router.get('/menus',async (req,res)=>{
    let menu_res = await transfer('get_operation','menus',res);
    let menu_res_parse = JSON.parse(menu_res.text);
    // console.log(menu_res_parse)
    if(menu_res_parse.meta.status === 200){
        menu_res_parse.data = toTree(menu_res_parse.data);
        res.send(menu_res_parse);
    }else{
        res.send(menu_res_parse);
    }
})

router.get('/menus/:level',async (req,res)=>{
    let menu_res = await transfer('get_operation',`menus/${req.params.level}`,res);
    let menu_res_parse = JSON.parse(menu_res.text);
    // console.log(menu_res_parse)
    if(menu_res_parse.meta.status === 200){
        menu_res_parse.data = toTree(menu_res_parse.data);
        res.send(menu_res_parse);
    }else{
        res.send(menu_res_parse);
    }
})



module.exports = router;