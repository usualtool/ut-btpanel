<?php
namespace usualtool\BtPanel;
class BtPanel{
    private $panelurl;
    private $panelkey;
    /**
     * 构造函数
     */
    public function __construct($panelurl='',$panelkey=''){
	    if(empty($panelurl) || empty($panelkey)):
            include 'Config.php';
            $this->panelurl=$config['panelurl'];
            $this->panelkey=$config['panelkey'];
        else:
            $this->panelurl=$panelurl;
            $this->panelkey=$panelkey;
        endif;
        $this->cookieFile = UTF_ROOT . '/log/' . md5($this->panelurl) . '.cookie';
    }
  	/**
     * 构造签名
     */
  	public function GetToken(){
  		$now_time = time();
    	$data = array(
			'request_token'=>md5($now_time.''.md5($this->panelkey)),
			'request_time'=>$now_time
		);
    	return $data;
    }
  	/**
     * 获取系统相关
     * GetSystemTotal/GetDiskInfo/GetNetWork
     */
  	public function GetSystem($action){
  	    $url=$this->panelurl."/system?action=".$action;
        $post=$this->GetToken();
        $response=$this->Post($url,$post);
    	return $response;
    }
    /**
     * 获取数据
     * logs/crontab/sites/domain/backup
     */
    public function GetData($table,$data=[]){
        $url = $this->panelurl."/data?action=getData";
        $post=$this->GetToken();
        $post["table"]=$table;
        if(!empty($data)):
            $post=array_merge($post,$data);
        endif;
        $response=$this->Post($url,$post);
        return $response;
    }
  	/**
     * 网站操作
     * get_site_types/GetPHPVersion
     * AddSite/DeleteSite
     * SiteStop/SiteStart/ToBackup/DelBackup
     */
  	public function Site($action,$data=[]){
  	    $url=$this->panelurl."/site?action=".$action;
        $post=$this->GetToken();
        if(!empty($data)):
            $post=array_merge($post,$data);
        endif;
        $response=$this->Post($url,$post);
    	return $response;
    }
    /**
     * 发起 POST 请求
     */
    public function Post($url,$data){
        $cookie_file=UTF_ROOT."/log/".md5($this->panelurl).".cookie";
        if(!file_exists($cookie_file)){
            $fp = fopen($cookie_file,'w+');
            fclose($fp);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($ch);
        if(curl_errno($ch)):
            $error = curl_error($ch);
            curl_close($ch);
            return false;
        endif;
        curl_close($ch);
        $data=json_decode($output,true);
        return $data;
    }
}
