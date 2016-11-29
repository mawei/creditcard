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
 * 项目名称：商户号 MODEL
 * 版本号：1 
 * 最后生成时间：2016-11-18 17:15:35 
 */
class Business_model extends Base_Model {
	
    var $page_size = 10;
    function __construct()
	{
    	$this->db_tablepre = 't_aci_';
    	$this->table_name = 'business';
		parent::__construct();
	}
    
    /**
     * 初始化默认值
     * @return array
     */
    function default_info()
    {
    	return array(
		'business_id'=>0,
		'business_code'=>'',
		'href_a'=>'',
		'salesman'=>'',
		'customer_telephone'=>'',
		'customer_create_time'=>'',
		'business_create_time'=>'',
		);
    }
    
    /**
     * 安装SQL表
     * @return void
     */
    function init()
    {
    	$this->query("CREATE TABLE  IF NOT EXISTS `t_aci_business`
(
`business_code` varchar(250) DEFAULT NULL COMMENT '商户号',
`href_a` varchar(250) DEFAULT NULL COMMENT '链接',
`salesman` varchar(250) DEFAULT NULL COMMENT '业务员号',
`customer_telephone` varchar(250) DEFAULT NULL COMMENT '客户手机号',
`customer_create_time` datetime DEFAULT NULL COMMENT '用户注册时间',
`business_create_time` datetime DEFAULT NULL COMMENT '商户导入时间',
`business_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
PRIMARY KEY (`business_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
");
    }
    
        }

// END business_model class

/* End of file business_model.php */
/* Location: ./business_model.php */
?>