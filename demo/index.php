<?php
use usualtool\BtPanel\Bt;
$bt=new Bt();
//使用示例
/**
 * 系统相关信息
 * 
 * 系统信息
 * $data=$bt->System();
 * 磁盘信息
 * $data=$bt->Disk();
 * 实时状态
 * $data=$bt->State();
*/
/**
 * 获取相关数据
 * 
 * 操作日志
 * $data=$bt->Log();
 * 计划任务
 * $data=$bt->Cron();
 * 网站列表
 * $data=$bt->Site();
 * 域名列表
 * $data=$bt->Domain();
 * 网站备份列表
 * $data=$bt->SiteBackup();
 * 网站分类
 * $data=$bt->SiteCate();
 * PHP版本列表
 * $data=$bt->PhpCate();
*/
/**
 * 网站操作相关
 * 
 * 创建网站
 * $data=$bt->AddSite("text.xyz.com","/www/wwwroot/test","PHP","74","80","测试建立网站");
 * 停用网站
 * $data=$bt->StopSite(1,"text.xyz.com");
 * 启用网站
 * $data=$bt->StartSite(1,"text.xyz.com");
 * 删除网站
 * $data=$bt->DelSite(1,"text.xyz.com");
 * 创建网站备份
 * $data=$bt->AddSiteBackup(1);
 * 删除网站备份
 * $data=$bt->DelSiteBackup(1);
*/
print_r($data);