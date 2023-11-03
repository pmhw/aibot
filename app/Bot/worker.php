<?php
if (!function_exists('handleMessages')) {
    function handleMessages($data)
    {
        // 处理消息的逻辑
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
}
