<?php
// +----------------------------------------------------------------------
// | AiBot [ 管理端 - 系统相关接口 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2023 telegram bot 领航员
// +----------------------------------------------------------------------
// | 定制联系：N79823 备注：电报定制 <不备注不通过>
// +----------------------------------------------------------------------
namespace app\controller\Admin;


class AdminApi 
{
    public function index()
    {
        

    }
    
    /**
     * 管理端接口-设置是否开启调试模式
     * 
     * 接口示例：${URl}/AdminApiEnv/type/false
    **/
    public function env($type = "false")
    {

        // 指定配置文件的路径
        $configFilePath = app()->getRootPath() . '.env'; // 请替换为你的配置文件路径
        
        // 使用 parse_ini_file 读取配置文件
        $config = parse_ini_file($configFilePath);
        $config['APP_DEBUG'] = $type;
        // 调试模式开启后正常显示报错 调试关闭后防止telegram bot报错
        if($type == "false"){
             $config['exception_tmpl'] = app_path() . 'Bot/think_exception.tpl';
        }else{
            
            $config['exception_tmpl'] = app()->getThinkPath() . 'tpl/think_exception.tpl';
        }
       
        $configContent = '';
        foreach ($config as $key => $value) {
            $configContent .= "$key = \"$value\"\n";
        }

        file_put_contents($configFilePath,$configContent);
        if (isset($config['APP_DEBUG'])) {
          $appDebug = $config['APP_DEBUG'];
          echo 'APP_DEBUG value: ' . $appDebug;
        } else {
           echo 'APP_DEBUG is not defined in the configuration file.';
        }
    }
}
