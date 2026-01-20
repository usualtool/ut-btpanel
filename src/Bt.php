<?php
namespace usualtool\BtPanel;
use usualtool\BtPanel\BtPanel;
class Bt{
    public function __construct(){
	    $this->panel=new BtPanel();
    }
    //系统信息
    public function System(){
        $data=$this->panel->GetSystem("GetSystemTotal");
        return $data;
    }
    //磁盘信息
    public function Disk(){
        $data=$this->panel->GetSystem("GetDiskInfo");
        return $data;
    }
    //实时状态
    public function State(){
        $data=$this->panel->GetSystem("GetNetWork");
        return $data;
    }
    //操作日志
    public function Log(){
        $data=$this->panel->GetData("logs");
        return $data;
    }
    //计划任务
    public function Cron(){
        $data=$this->panel->GetData("crontab");
        return $data;
    }
    //网站列表
    public function Site($data=[]){
        if(!empty($data)):
            $data=$this->panel->GetData("sites",$data);
        else:
            $data=$this->panel->GetData("sites");
        endif;
        return $data;
    }
    //域名列表
    public function Domain(){
        $data=$this->panel->GetData("domain");
        return $data;
    }
    //备份列表
    public function SiteBackup(){
        $data=$this->panel->GetData("backup");
        return $data;
    }
    //网站分类
    public function SiteCate(){
        $data=$this->panel->Site("get_site_types");
        return $data;
    }
    //PHP版本列表
    public function PhpCate(){
        $data=$this->panel->Site("GetPHPVersion");
        return $data;
    }
    //创建网站
    public function AddSite($domain,$path,$phptype,$phpver,$port,$ps){
        $data=[];
        $data["webname"]=json_encode(array("domain"=>$domain,"domainlist"=>[],"count"=>0));
        $data["path"]=$path;
        $data["type_id"]=0;
        $data["type"]=$phptype;
        $data["version"]=$phpver;
        $data["port"]=$port;
        $data["ps"]=$port;
        $data["ftp"]=0;
        $data["sql"]=0;
        $data=$this->panel->Site("AddSite",$data);
        return $data;
    }
    //停用网站
    public function StopSite($id,$name){
        $data=[];
        $data["id"]=$id;
        $data["webname"]=$name;
        $data=$this->panel->Site("SiteStop",$data);
        return $data;
    }
    //启用网站
    public function StartSite($id,$name){
        $data=[];
        $data["id"]=$id;
        $data["webname"]=$name;
        $data=$this->panel->Site("SiteStart",$data);
        return $data;
    }
    //删除网站
    public function DelSite($id,$name){
        $data=[];
        $data["id"]=$id;
        $data["webname"]=$name;
        $data=$this->panel->Site("DeleteSite",$data);
        return $data;
    }
    //创建网站备份
    public function AddSiteBackup($id){
        $data=[];
        $data["id"]=$id;
        $data=$this->panel->Site("ToBackup",$data);
        return $data;
    }
    //删除网站备份
    public function DelSiteBackup($id){
        $data=[];
        $data["id"]=$id;
        $data=$this->panel->Site("ToBackup",$data);
        return $data;
    }
}