<?php
// +----------------------------------------------------------------------
// | AiBot [ 后台接口 - 路由 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2023 telegram bot 领航员
// +----------------------------------------------------------------------
// | 定制联系：N79823 备注：电报定制 <不备注不通过>
// +----------------------------------------------------------------------

use think\facade\Route;

Route::rule('AdminApi', '\app\controller\Admin\AdminApi@index');
Route::rule('AdminApiEnv', '\app\controller\Admin\AdminApi@env');


Route::rule('AdminBotApiAddBot', '\app\controller\Admin\AdminBotApi@AddBot');
Route::rule('AdminBotApiSetWebhook', '\app\controller\Admin\AdminBotApi@setWebhook');