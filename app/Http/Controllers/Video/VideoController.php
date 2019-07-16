<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OSS\OssClient;
class VideoController extends Controller
{
    protected $acessKeyId = 'LTAIS2xiEheZN3tA';
    protected $accessKeySecret = 'mPGHt7m9LSQyQZHMnZH8vpMDLObnOC';
    protected $bucket = '1809a-vedio';
    public function oss1(){
        $client = new OssClient($this->acessKeyId, $this->accessKeySecret, env('ALI_OSS_ENDPOINT'));
        var_dump($client);
        echo '<hr>';
        $obj = '1809a_text'; //文件名
        $cont = 'Hello 1809a';
        $rs = $client->putObject($this->bucket, $obj, $cont);
        var_dump($rs);
    }
    public function oss2(){
        $client = new OssClient($this->acessKeyId, $this->accessKeySecret, env('ALI_OSS_ENDPOINT'));
        $obj=md5(time().mt_rand(1,999999)).'.jpg';
        $local_file='2019012207493551680.jpg';
        $rs=$client->uploadFile($this->bucket,$obj,$local_file);
        var_dump($rs);
    }




    /**oss事件推送异步回调*/
    public function ossNotify(){
        $json = file_get_contents("php://input");
        $log_str = date("Y-m-d H:i:s") . ' >>>>> ' .$json . "\n";
        file_put_contents("logs/oss.log",$log_str,FILE_APPEND);
    }

    public function test(){
        echo 111;
    }
}
