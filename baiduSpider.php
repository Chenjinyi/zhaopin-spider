<?php
/**
 * Created by PhpStorm.
 * User: jinyichen
 * Date: 2018/4/27
 * Time: 下午9:45
 */

print_r("请输入城市:");
$city=urlencode(trim(fgets(STDIN)));
print_r('请输入职业:');
$query=urlencode(trim(fgets(STDIN)));


$url = "http://zhaopin.baidu.com/api/quanzhiasync?query=" . $query . "&sort_type=1&city=" . $city . "&detailmode=close&rn=100&pn=0";
$ch = curl_init();  //初始化
curl_setopt($ch, CURLOPT_URL, $url);//设置URL 地址
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Host:zhaopin.baidu.com",
    "Connection: keep-alive",
    "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
    "Upgrade-Insecure-Requests: 1",
    "DNT:1",
    "Accept-Language:zh-CN,zh;q=0.8",
    "User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36"
)); // 设置header

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//不返回数据

if (empty($result = curl_exec($ch))) {
    print_r('无法连接' . $url);
    die();
};//执行

$data = json_decode($result);
foreach ($data->data->main->data->disp_data as $row){
    @print_r($row->source."-".$row->officialname."-".$row->jobfirstclass."-".$row->salary.PHP_EOL);
//    TODO data save
}