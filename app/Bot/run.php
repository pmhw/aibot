<?php

// 测试数据 需要删除 
// 加载tp框架 
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../public/index.php';

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Coroutine;
use Swoole\Process;
use think\facade\Db;
use think\facade\Session;
use think\facade\Cache;



// 创建 Swoole HTTP 服务器
$server = new Server('0.0.0.0', 9501);

// 创建多个子进程
$processes = [];

for ($i = 0; $i < 30; $i++) { // 创建30个子进程
    $process = new Process(function (Process $worker) use ($processes) {
        while (true) {
            $data = $worker->read(); // 从主进程读取任务数据
            if ($data === false) {
                break;
            }
            $data = json_decode($data,true);
            
            // 方案二
            //include __DIR__ . '/worker.php'; // 包含处理消息的逻辑
            // handleMessages($data);
            

            // 方案一 
            handleMessage($data); // 异步处理消息的函数

        }
    });

    $server->addProcess($process);
    $processes[] = $process;
}

// 处理 Webhook 请求
$server->on('request', function (Request $request, Response $response) use ($processes) {
    print_r('接受到request请求');
    $response->end('true'); //  防止 tg 官方阻塞

    $body = $request->rawContent();
    $headers = $request->header;
    $getParams = $request->get ?? [];
    
    // 解析消息内容
    $data = json_decode($body, true);
    print_r($data);
    $data['botid']=$getParams['botid'];

    // $coroutines[] = Swoole\Coroutine::create(function () use ($data) {
    //     handleMessage($data); // 异步处理消息的函数
    // });
    // 随机选择一个子进程发送任务数据
    $randIndex = array_rand($processes);
    $data = json_encode($data,true);

    $processes[$randIndex]->write($data);
    // 响应请求
    $response->end('ok');
});

// 启动 HTTP 服务器
$server->start();

// 异步处理消息的函数
function handleMessage($data)
{
    $bjectClass = [];
    $path = app_path() . '/BotPlugin/';
    $BotPlugin = getDirContent($path);
    foreach ($BotPlugin as $key) {
        if (file_1($key) == 'php') {
            $name = file_0($key);
            if (!class_exists($name)) {
                include($path . $key);
            }
            if(empty($bjectClass[$name])){
                $className = '\\' . $name;
                $bjectClass[$name] = new $className; // 实例化类
            }
            if ($bjectClass[$name]->type == 0) {
                    $bjectClass[$name]->__entrance($data);
            }
        }
    }
}

