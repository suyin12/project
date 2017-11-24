<?php
namespace Home\Controller;
use Think\Controller;

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

class IndexController extends Controller {
    public function index()
    {
        $this->display('login2');
//        $this->sendMsg("13249459123","123456");//可以是
    }
    public function sendMsg($mobile,$code){

        require_once APP_PATH.'Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIZPejsG0hRohr";//自己替换自己的accessKeyId
        $accessKeySecret = "eo5qlhxgcc0VbUFQ2lViUaGP8ynRY8";//自己替换自己的accessKeySecret
        $templateParam = array("code"=>$code);           //模板变量替换
        $templateCode = "SMS_105365056";   //短信模板ID
        $signName = "世投邦"; //签名名称

        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名称
        $request->setSignName($signName);

        // 必填，设置模板CODE
        $request->setTemplateCode($templateCode);

        // 可选，设置模板参数
        if($templateParam) {
            $request->setTemplateParam(json_encode($templateParam));
        }

        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        dump($result);
        dump(json_encode($templateParam));
        return $result;
    }
    public function login(){

        $this->display();
    }

    public function verify(){
        $verify = new \Think\Verify();
        $verify->fontSize = 20;
        $verify->length   = 4;
        $verify->useNoise = false;
        $verify->useCurve = false;
        $verify->codeSet = '0123456789';
        $verify->imageW = 150;
        $verify->imageH = 38;
        //$Verify->expire = 600;
        $verify->entry();
    }
    public function check($id = ''){
        $code = $_POST['code'];
        $verify = new \Think\Verify();
        $this->ajaxReturn($verify->check($code,$id));
    }
}