<?php

namespace app\controller\Admin;

//类库调用区域
use think\facade\View;
use think\facade\Config;
use think\facade\Db;
use think\facade\Session;
use think\facade\Request;

use tgbot\Botapi;   // 引入官方机器人库


class Base
{    
    
    
    public function __construct(){

        $request = request();
        $url = $request->pathinfo();

        // 验证权限
        $admin = Session::get('ect_admin');
        // dump($admin);
        // exit();

        // if(!$admin || $admin == null){
        //     if(trim($url) == "ect_admin"){
        //         header("Location: ect_login");
        //     }else{
        //         header("Location: 404.html");
        //     }
        //     exit(); 

        // }       
        
        $this->Bot = new Botapi;
        
        $this->TG_API = ($this->Bot)::TG_API;
    }
    
}