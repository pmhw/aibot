<?php
// 应用公共文件
const DppVerison = '1.0.0'; //库版本号 

/**
*获取文件名去除后缀
*
* 作者wx: N79823
* 官网：https://pmhapp.com
*
**/
function file_0($filename){
    $houzhui = substr(strrchr($filename, '.'), 1);
    $result = basename($filename,".".$houzhui);
    return $result;
}
/**
* 获取文件名后缀
*
* 作者wx: N79823
* 官网：https://pmhapp.com
*
**/
function file_1($file_name){
    $retval = "";
    $pt = strrpos ( $file_name , "." );
    if ( $pt ) $retval = substr ( $file_name , $pt +1, strlen ( $file_name ) - $pt );
    return ( $retval );
}

/**
* 获取文件下目录
*
* 作者wx: N79823
* 官网：https://pmhapp.com
*
**/
function getDirContent($path){
    if(!is_dir($path)){
        return false;
    }
    $arr = array();
    $data = scandir($path);
    foreach ($data as $value){
        if($value != '.' && $value != '..'){
            $arr[] = $value;
        }
    }
    return $arr;
}

/**
* 获取类calss 名
*
* 作者wx: N79823
* 官网：https://pmhapp.com
*
**/
function getClasName($class){
    return basename(str_replace('\\', '/', $class));
}
/**
 * json_exit @返回json数据
 * 
 * 作者qq32579135
 * 官网：https://pmhapp.com
 * 
 * $code @状态码
 * $msg @返回结果
**/
function json_exit($code = 0,$msg = 'ok',$value = ''){
    exit(json_encode(['code'=>$code,'msg'=>$msg,'value'=>$value],JSON_UNESCAPED_UNICODE));
}

// get请求方法封装 来源：https://www.runoob.com
function geturl($url){
    $headerArray = array("Content-type:application/json;","Accept:application/json");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output,true);
    return $output;
    }
    function posturl($url,$data){
    $data = json_encode($data);
    $headerArray =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return json_decode($output,true);
}