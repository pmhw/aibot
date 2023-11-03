<?php
// +----------------------------------------------------------------------
// | AiBot [ 管理端 - 机器人接口 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2023 telegram bot 领航员
// +----------------------------------------------------------------------
// | 定制联系：N79823 备注：电报定制 <不备注不通过>
// +----------------------------------------------------------------------
namespace app\controller\Admin;

use tgbot\Botapi; 
use think\facade\Config;
use think\facade\View;//视图类库
use think\facade\Request;
use think\facade\Cache;
use think\facade\Cookie;
use think\facade\Db;

class AdminBotApi extends Base
{
    public function index()
    {
        
        
    }
    
    /**
     * 添加机器人 
     * 
     * @param1 string $token 
     * 
     * token获取教程 https://core.telegram.org/bots#how-do-i-create-a-bot
     * 接口示例 ${url}/AdminBotApiAddBot?token=
    **/
    public function AddBot(){
        

        $token = input('get.token');
        
        if(!$token){json_exit(1,'令牌不存在');}
        
        $api = $this->TG_API . $token . '/';
        
        
        
        //dump($api);
        $getMe = geturl($api . 'getMe');
        //dump($getMe);
        if(!$getMe['ok']){
            json_exit(1,'密钥错误');
        }
        
        if(!empty($getMe['result']['id'])){
            $data['botid'] = $getMe['result']['id'];
            //dump($data);
        }
        
        if(!empty($getMe['result']['first_name'])){
            $data['first_name'] = $getMe['result']['first_name'];
            //dump($data);
        }
        
        if(!empty($getMe['result']['username'])){
            $data['botname'] = $getMe['result']['username'];
        }
        //测试链接
        $getUpdates = geturl($api . 'getUpdates');
        
        if(!$getUpdates['ok']){
            geturl($api . 'deleteWebhokk');
        }
        
        $ssl = 'https://';
        // if(!$ssl){
        //     json_exit(1,'请先配置 网站 SSL https');
        // }
        
        $setWebhook = geturl($api . 'setWebhook?url=' . $ssl . $_SERVER["SERVER_NAME"] .':443/hook?botid='.$getMe['result']['id']);
        //dump($setWebhook,$data);exit();
        
        if(!$setWebhook['ok']){
            json_exit(1,$setWebhook['description']);
        }
        
        
        $data['token'] = $token;
        
        $bot = Db::name('botlist')->where(['botid'=>$data['botid']])->find();
        
        if($bot){
            //修改密钥
          $update = Db::name('botlist')->where(['botid'=>$data['botid']])->update($data);
          if(!$update){
            json_exit(1,'令牌已存在，无需更新');  
          }
          json_exit(0,'更新令牌成功'); 
          
        }else{
          $data['time'] = time();
          $insert = Db::name('botlist')->insert($data);
          if(!$insert){
            json_exit(1,'添加失败');  
          }
          json_exit(0,'添加成功'); 
        }
    }
    
    
    /**
     * 获取机器人配置信息 
     * 
     * @param1 string $token 
     * 
     * token获取教程 https://core.telegram.org/bots#how-do-i-create-a-bot
     * 接口示例 ${url}/AdminBotApiAddBot?token=
    **/
    public function setWebhook(){
        
            
        $token = input('get.token');
        
        if(!$token){json_exit(1,'token不存在');}
        
        $api = $this->TG_API . $token . '/';
    
        //获取错误信息
        $getWebhookInfo =  geturl($api . 'getWebhookInfo?url=' . $ssl = 'https://' . $_SERVER["SERVER_NAME"] .'/hookapi');

        dump($getWebhookInfo['result']);
    }
    
    
}