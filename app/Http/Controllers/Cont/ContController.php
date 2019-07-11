<?php

namespace App\Http\Controllers\Cont;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Model\VideoModel;
Use Illuminate\Support\Facades\DB;
use OSS\OssClient;
Use Illuminate\Support\Str;

class ContController extends Controller
{
    protected $acessKeyId = 'LTAIS2xiEheZN3tA';
    protected $accessKeySecret = 'mPGHt7m9LSQyQZHMnZH8vpMDLObnOC';
    protected $bucket = '1809a-vedio';
    //
    public function cont(){
        $data = DB::table('p_video')->get()->toArray();
        $path = [];
        foreach ($data as $k => $v){
            $path['path'] = $v->path;
        }
       // print_r($path);exit;
        $client = new OssClient($this->acessKeyId, $this->accessKeySecret, env('ALI_OSS_ENDPOINT'));
        $obj=md5(time().mt_rand(1,999999)).'.mp4';
        //print_r(storage_path('app/public'));exit;
        $local_file=storage_path('app/public/').$path['path'];
        $rs=$client->uploadFile($this->bucket,$obj,$local_file);
        var_dump($rs);
        unlink(storage_path('app/public/').$path['path']);
    }



    public function video(){
        $id = $_GET['id'];
        $v = VideoModel::where('vid',$id)->first()->toArray();
        //print_r($v);exit;
        $data = [
            'v'=>$v
        ];
        return view('video/video',$data);
    }















//$ossClient = new OssClient($this->acessKeyId,$this->accessKeySecret,env('ALI_OSS_ENDPOINT'));
//
//    //获取当前目录中的文件
//$file_path = storage_path('app/public/');
//$file_list = scandir($file_path);
//
//foreach ($file_list as $k=>$v){
//if ($v== '.' || $v=='..'){
//continue;
//}
//
//$file_name = Str::random(5). '.jpg';
//$local_file = $file_path . '/' .$v;
//
//echo "本地文件：".$local_file;echo '<br>';
//
//try{
//    $ossClient->uploadFile($this->Bucket,$file_name,$local_file);
//} catch (OssException $e){
//    printf(__FUNCTION__ . "：FAILED\n");
//    printf($e->getMessage(). "\n");
//    return;
//}
//
////上传成功后 删除本地文件
//echo $local_file . '上传成功';echo '<hr>';
//unlink($local_file);


}
