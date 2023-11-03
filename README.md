## aibot 安装教程


> 该文档更新与 2023.11.3

![image](https://github.com/pmhw/aibot/assets/78243256/1c5fd274-7c0b-4829-a5b6-fa59cfd4be75)


Telegram 机器人开发框架 无需繁琐快速开发属于自己的电报机器人


![shell快捷安装](https://github.com/pmhw/aibot/assets/78243256/b858a34a-6646-43ce-ae68-f3a4a8ed9e18)


![控制台调试](https://github.com/pmhw/aibot/assets/78243256/8ba68c5a-35cc-4874-b610-e878b0276e76)
## 特性

* 基于PHP`8.0+` Thinkphp `8.2`重构
* 采用`Swoole`增加多线程处理
* 自动化`shell`脚本化安装


### 1.根目录执行该脚本

```shell

    curl -o aibot https://www.pmhapp.com/run.sh && chmod +x aibot && ./aibot

```

### 2.安装环境

```shell
    
    # 安装环境 自动执行代码加载
    aibot 1 
    
```
> 安装后请配置 Thinkphp 运行环境

1）设置运行目录 /public
2）设置伪静态 
```nginx
location / {
	if (!-e $request_filename){
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	}
}
```
3）设置反向代理 （记得放通 9501 端口哦）

> 代理目录 /hook  目标url http://您的ip:9501

```nginx
#手动配置脚本
location  ~* \.(gif|png|jpg|css|js|woff|woff2)$
{
    proxy_pass http://您的ip:9501;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header REMOTE-HOST $remote_addr;
    expires 12h;
}
location /hook
{
    proxy_pass http://您的ip:9501;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header REMOTE-HOST $remote_addr;
    
    add_header X-Cache $upstream_cache_status;
    
    #Set Nginx Cache
    
    	add_header Cache-Control no-cache;
}

```

### 3.下载插件导入（手动）

1）插件导入到 app/BotPlugin 文件内

2）创建数据库导入sql

3）并到插件中配置您的数据表

```php
    public $mysql = [
        // 数据库类型
        'type'        => 'mysql',
        // 数据库连接DSN配置
        'dsn'         => '',
        // 服务器地址
        'hostname'    => '127.0.0.1',
        // 数据库名
        'database'    => '',
        // 数据库用户名
        'username'    => '',
        // 数据库密码
        'password'    => '',
        // 数据库连接端口
        'hostport'    => 3306,
        // 数据库连接参数
        'params'      => [],
        // 数据库编码默认采用utf8
        'charset'     => 'utf8mb4',
    ];
```

### 4.启动运行程序

```shell
    #根目录终端执行
    aibot 3
```


> 至此您的程序已经正常运行起来

### 指令

```shell
    # 查看指令序号
    aibot 

```

```shell
    
    # 安装环境 
    aibot 1 

```

```shell

    aibot 2

```

```shell
    # 更新 
    curl -o aibot https://www.pmhapp.com/run.sh && chmod +x aibot && ./aibot update

```
