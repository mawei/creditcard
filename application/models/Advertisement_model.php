<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AutoCodeIgniter.com
 *
 * 基于CodeIgniter核心模块自动生成程序
 *
 * 源项目		AutoCodeIgniter
 * 作者：		AutoCodeIgniter.com Dev Team
 * 版权：		Copyright (c) 2015 , AutoCodeIgniter com.
 * 项目名称：广告管理 MODEL
 * 版本号：1 
 * 最后生成时间：2016-11-29 11:42:42 
 */
class Advertisement_model extends Base_Model {
	
    var $page_size = 10;
    function __construct()
	{
    	$this->db_tablepre = 't_aci_';
    	$this->table_name = 'advertisement';
		parent::__construct();
	}
    
    /**
     * 初始化默认值
     * @return array
     */
    function default_info()
    {
    	return array(
		'advertisement_id'=>0,
		'title'=>'',
		'image'=>'',
		'href'=>'',
		'sort'=>'',
		'is_delete'=>'',
		);
    }
    
    /**
     * 安装SQL表
     * @return void
     */
    function init()
    {
    	$this->query("CREATE TABLE  IF NOT EXISTS `t_aci_advertisement`
(
`title` varchar(250) DEFAULT NULL COMMENT '名称',
`image` varchar(250) DEFAULT NULL COMMENT '广告配图',
`href` varchar(250) DEFAULT NULL COMMENT '链接地址',
`sort` int(11) DEFAULT '0' COMMENT '排序',
`is_delete` char(2) DEFAULT NULL COMMENT '是否有效',
`advertisement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
PRIMARY KEY (`advertisement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
");
    }
    
        }

// END advertisement_model class

/* End of file advertisement_model.php */
/* Location: ./advertisement_model.php */
?>